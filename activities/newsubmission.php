<?php

require_once (dirname (dirname ( dirname ( dirname ( __FILE__ ) ) ) ). '/config.php');
global $CFG,$DB,$USER;
require_once($CFG->dirroot.'/mod/emarking/lib.php');
require_once("locallib.php");
require_once($CFG->dirroot.'/enrol/manual/locallib.php');
require_once($CFG->dirroot.'/lib/accesslib.php');

$activityid = required_param('id', PARAM_INT);
$courseid = required_param('course', PARAM_INT);
$askMarking = optional_param('askMarking',0, PARAM_INT);
$printteaching = optional_param('printteaching',0, PARAM_INT);

$submissiontype = optional_param('submissiontype',1, PARAM_INT);
require_login($courseid);
$sections = new stdClass ();
$sections->instructions=1;
$sections->planification=1;
$sections->editing=1;
$sections->writing=1;
$sections->teaching=$printteaching == 0 ? 0 : 1;

if(!$activity=$DB->get_record('emarking_activities',array('id'=>$activityid))) {
    print_error("Invalid activity");
}
if(!$activityRubric=$DB->get_record('emarking_rubrics',array('id'=>$activity->rubricid))) {
    print_error("Activity doesn't have a rubric created");
}

$pdf=emarking_get_pdf_activity($activity,false,$sections);
$itemid=$pdf['itemid'];
$numpages=$pdf['numpages'];
$filedata=$pdf['filedata'];

$emarking = new stdClass();
$emarking->course = $courseid;
$emarking->name = $pdf['activitytitle'];
$emarking->intro = "";
$emarking->custommarks = "";
$emarking->markingduedate = time();
$emarking->type = 1;
$emarking->grade = 7.0;
$emarking->grademin = 1.0;
$emarking->keywords = "keyword1,keyword2,sentence1";
$emarking->exam=0;
$emarking->visible=1;
$emarking->visibleold=1;
// $emarking->uploadtype=$submissiontype == 2 ? EMARKING_UPLOAD_FILE : EMARKING_UPLOAD_QR;
$emarking->uploadtype=$submissiontype;
$emarking->changelog = 10;

$data=emarking_create_activity_instance($emarking,$courseid,$itemid,$numpages,$filedata);
$contextmodule = context_module::instance($data['cmid']);
$coursecontext = context_course::instance($courseid, MUST_EXIST);


$gradingArea = new stdClass();
$gradingArea->contextid=$contextmodule->id;
$gradingArea->component='mod_emarking';
$gradingArea->areaname='attempt';
$gradingArea->activemethod='rubric';
$areaid = $DB->insert_record('grading_areas', $gradingArea);

$rubric=new stdClass ();
$rubric->areaid=$areaid;
$rubric->method='rubric';
$rubric->name=$activityRubric->name;
$rubric->description=$activityRubric->description;
$rubric->descriptionformat=1;
$rubric->status=20;
$rubric->usercreated=$USER->id;
$rubric->usermodified=$USER->id;
$rubric->timecreated=time();
$rubric->timemodified=time();
$rubric->options='{"sortlevelsasc":"1","alwaysshowdefinition":"1","showdescriptionteacher":"1","showdescriptionstudent":"1","showscoreteacher":"1","showscorestudent":"1","enableremarks":"1","showremarksstudent":"1"}';

$insertRubric = $DB->insert_record('grading_definitions', $rubric);

$rubricCriterias= $DB->get_records('emarking_rubrics_criteria',array('rubricid'=>$activity->rubricid));
$criteriacount=1;
foreach ($rubricCriterias as $rubricCriteria){
	
	$criteria=new stdClass ();
	$criteria->definitionid=$insertRubric;
	$criteria->sortorder=$criteriacount;
	$criteria->description=$rubricCriteria->description;
	$criteria->descriptionformat=0;
	
	$insertRubricCriteria = $DB->insert_record('gradingform_rubric_criteria', $criteria);
	$rubricCriteriaLevels= $DB->get_records('emarking_rubrics_levels',array('criterionid'=>$rubricCriteria->id));

	foreach($rubricCriteriaLevels as $rubricCriteriaLevel){
		
		$level=new stdClass ();
		$level->criterionid=$insertRubricCriteria;
		$level->score=$rubricCriteriaLevel->score;
		$level->definition=$rubricCriteriaLevel->definition;
		$level->definitionformat=0;
		$insertRubricCriteriaLevels = $DB->insert_record('gradingform_rubric_levels', $level);
		
	}
	$criteriacount++;
}
if($askMarking==1){
$sql="select rs.userid, rs.contextid, em.count as totalmarking
FROM mdl_role_assignments as rs
INNER JOIN mdl_role as r on (r.id=rs.roleid)
LEFT JOIN (select count(*) as count, marker from  mdl_emarking_markers group by marker) as em on rs.userid=em.marker
WHERE r.shortname=?
ORDER BY totalmarking ASC
LIMIT 1";
$result = $DB->get_record_sql($sql, array('corrector'));
$marker = new stdClass();
$marker->emarking=$data['cmid'];
$marker->marker =0;
$marker->qualitycontrol=0;
$DB->insert_record('emarking_markers', $marker);
}

$emarking_activity = new stdClass();
$emarking_activity->emarkingid = $data['id'];
$emarking_activity->activityid = $activityid;
$emarking_activity->printrubric = 0;
$emarking_activity->printteaching = $printteaching;
$emarking_activity->onlinerewrite = 0;
$emarking_activity->uploadingtype = $submissiontype;

$emarking_activity->id = $DB->insert_record('emarking_used_activities', $emarking_activity);

$forkUrl = new moodle_url($CFG->wwwroot.'/mod/emarking/view.php', array('id' => $data['cmid']));
redirect($forkUrl, 0);
