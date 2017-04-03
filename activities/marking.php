<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package   mod_emarking
 * @copyright 2017 Francisco Ralph fco.ralph@gmail.com
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once (dirname (dirname ( dirname ( dirname ( __FILE__ ) ) ) ). '/config.php');

global $PAGE, $DB, $USER, $CFG;
require_once($CFG->dirroot . '/mod/emarking/locallib.php');

$id = required_param('id', PARAM_INT);
$tab= optional_param('tab',1, PARAM_INT);
list($cm, $emarking, $course, $context) = emarking_get_cm_course_instance();
$markingUrl=new moodle_url($CFG->wwwroot.'/mod/emarking/activities/marking.php',array('id'=>$id,'tab'=>1));
$downloadUrl=new moodle_url($CFG->wwwroot.'/mod/emarking/activities/marking.php',array('id'=>$id,'tab'=>2));
$uploadUrl=new moodle_url($CFG->wwwroot.'/mod/emarking/activities/marking.php',array('id'=>$id,'tab'=>3));
$reportsUrl=new moodle_url($CFG->wwwroot.'/mod/emarking/activities/marking.php',array('id'=>$id,'tab'=>4));

$PAGE->set_context(context_system::instance());
$url = new moodle_url($CFG->wwwroot.'/mod/emarking/activities/index.php');
$PAGE->set_url($url);
$PAGE->set_title('escribiendo');
$disabled=null;
$totalsubmissions = $DB->count_records_sql(
		"
                SELECT COUNT(DISTINCT s.id) AS total
                FROM {emarking_submission} s
                INNER JOIN {emarking_draft} d
                    ON (s.emarking = :emarking AND d.status >= " .
		EMARKING_STATUS_PUBLISHED . " AND d.submissionid = s.id AND d.grade > 0 AND d.qualitycontrol=0)
                ", array(
                		'emarking' => $emarking->id));
		if (! $totalsubmissions || $totalsubmissions == 0) {
			$disabled='class="disabled disabledTab"';
			$reportsUrl='#';
		}
//print the header

?>

<div class="container" style="padding-top: 150px;padding-bottom: 100px;">
	<div class="row">
		<h2></h2>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<ul class="nav nav-tabs active_tab">
						
						
<?php 
switch ($tab) {
	case 1 :
?>
						<li class="active"><a href="<?= $markingUrl ?>">Información del curso</a></li>
						<li><a href="<?= $downloadUrl ?>">Descargar</a></li>
						<li><a href="<?= $uploadUrl ?>">Digitalizar</a></li>
						<li <?= $disabled ?>><a href="<?= $reportsUrl ?>" >Reportes</a></li>
						</ul>
						<?php 
		include  $CFG->dirroot . '/mod/emarking/view.php';		
		break;
	case 2:
?>
						<li><a href="<?= $markingUrl ?>">Información del curso</a></li>
						<li class="active"><a href="<?= $downloadUrl ?>">Descargar</a></li>
						<li><a href="<?= $uploadUrl ?>">Digitalizar</a></li>
						<li <?= $disabled ?>><a href="<?= $reportsUrl ?>">Reportes</a></li>
						</ul>
						<?php 
		include  $CFG->dirroot . '/mod/emarking/print/exam.php';
		break;
	case 3:
?>
						<li><a href="<?= $markingUrl ?>">Información del curso</a></li>
						<li><a href="<?= $downloadUrl ?>">Descargar</a></li>
						<li class="active"><a href="<?= $uploadUrl ?>">Digitalizar</a></li>
						<li <?= $disabled ?>><a href="<?= $reportsUrl ?>">Reportes</a></li>
						</ul>
						
						<?php 
		include  $CFG->dirroot . '/mod/emarking/print/uploadanswers.php';
		break;
		case 4:
			?>
								<li><a href="<?= $markingUrl ?>">Información del curso</a></li>
								<li><a href="<?= $downloadUrl ?>">Descargar</a></li>
								<li><a href="<?= $uploadUrl ?>">Digitalizar</a></li>
								<li class="active"><a href="<?= $reportsUrl ?>">Reportes</a></li>
								</ul>
								<?php 
				include  $CFG->dirroot . '/mod/emarking/reports/feedback.php';
				break;
	 case 5 :
					?>
										<li><a href="<?= $markingUrl ?>">Información del curso</a></li>
										<li><a href="<?= $downloadUrl ?>">Descargar</a></li>
										<li><a href="<?= $uploadUrl ?>">Digitalizar</a></li>
										<li <?= $disabled ?>><a href="<?= $reportsUrl ?>" >Reportes</a></li>
										</ul>
										<?php 
				include  $CFG->dirroot . '/mod/emarking/marking/publish.php';
				break;
}
?>						
						
						
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
//print the footer
include 'views/headermoodle.php';
include 'views/footer.html';
?>


