<?php
$exam = new stdClass();
$exam->course = 2;
$exam->name = "desde código";
$exam->intro = "";
$exam->introformat = 1;
$exam->grade = 7.00;
$exam->grademin = 1.00;
$exam->custommarks = "";
$exam->anonymous = 0;
$exam->regraderestrictdates = 0;
$exam->regradesopendate = time();
$exam->regradesclosedate = time();
$exam->peervisibility = 0;
$exam->heartbeatenabled = 1;
$exam->downloadrubricpdf = 1;
$exam->totalpages = 0;
$exam->adjustslope = 0;
$exam->adjustslopegrade = 0.0;
$exam->adjustslopescore = 0.00000;
$exam->linkrubric = 0;
$exam->markingduedate = time();
$exam->type = 1;
$exam->qualitycontrol = 0;
$exam->timecreated =time();
$exam->timemodified = 0;
$exam->collaborativefeatures = 0;
$exam->justiceperception = 0;
$exam->agreementflexibility = 0;
$exam->firststagedate = time();
$exam->secondstagedate = time();
$exam->enablescan = 0;
$exam->enableosm = 0;
$exam->digitizingdate = 0;
$exam->digitizingnotified = 0;
$exam->answerkeyfile = "";
$exam->parent = "";
$exam->copiedfromparent = 0;
$exam->keywords = "keyword1,keyword2,sentence1";

$fs = get_file_storage();

// Prepare file record object
$fileinfo = array(
		'component' => 'mod_mymodule',     // usually = table name
		'filearea' => 'myarea',     // usually = table name
		'itemid' => 0,               // usually = ID of row in table
		'contextid' => $context->id, // ID of context
		'filepath' => '/',           // any path beginning and ending in /
		'filename' => 'myfile.txt'); // any filename

// Get file
$file = $fs->get_file($fileinfo['contextid'], $fileinfo['component'], $fileinfo['filearea'],
		$fileinfo['itemid'], $fileinfo['filepath'], $fileinfo['filename']);

// Read contents
if ($file) {
	$contents = $file->get_content();
} else {
	// file doesn't exist - do something
}
