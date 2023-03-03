	<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\models\Subject;
use backend\models\AcedemicYear;
use backend\models\Section;
use backend\models\AddExam;
use backend\models\FinalExam;
use common\models\User;
use backend\models\SchoolList;
use backend\models\newStaffdata; 
use backend\models\FinalExamSubjects;
use backend\models\FinalExamGrading;
use backend\models\AnnouncementsTeacher;
use backend\models\Assignmentclasses;
use backend\models\AnnouncementsParent;
use backend\models\ClassStudent;
use backend\models\ClassSubject;
use backend\models\ClassInfo;
use backend\models\InhouseTest;
use backend\models\InhouseTestGrading;
use backend\models\InhouseTestSubjects;
use backend\models\AddTest;
use yii\helpers\Url;

?>

<table class="table table-striped ">
				    <thead>
				 <?php
					if(isset($exmserch_id) && !empty($exmserch_id)){
						$getexam_name = InhouseTest::find()->where(['id'=>$exmserch_id])->one();
						$getexmnmer = AddTest::find()->where(['id'=>$getexam_name['exam_id']])->one();
						
					?>	
					  <!--tr>
						  <th>Test Name : <?php //echo $getexmnmer['test_name']; ?></th>
						 
					    </tr-->
					<?php }
						?>
					    <tr>
						  <th>Subject</th>
						  <th>Teacher</th>
						  <th>Test Date</th>
						  <th>Max. Marks</th>
						  <th>Obt. Marks</th>
					    </tr>
						
				    </thead>
				    <tbody>
				<?php
					if(isset($exmserch_id) && !empty($exmserch_id)){
						$getexam_nameerss = InhouseTest::find()->where(['id'=>$exmserch_id])->one();
				
				$getexam_nameers = InhouseTest::find()->where(['exam_id'=>$getexam_nameerss['exam_id']])->andwhere(['class_id'=>$getexam_nameerss['class_id']])->andwhere(['section_id'=>$getexam_nameerss['section_id']])->andwhere(['school_id'=>$getexam_nameerss['school_id']])->andwhere(['academic_year'=>$getexam_nameerss['academic_year']])->orderBy(['id' => SORT_DESC])->all();
				foreach($getexam_nameers as $testerexms){ 
							$gtalsd = InhouseTestSubjects::find()->where(['inhouse_test_id'=>$testerexms->id])->all();
							
							foreach($gtalsd as $mikltor){
							
						?>
					<tr>
						<td><?php $subjct = Subject::find()->where(['id' => $mikltor->subject_id])->one();
						echo ucfirst($subjct['subject_name']);
						?></td>
						
						<td><?php $newStaffdata = newStaffdata::find()->where(['user_id' => $mikltor->Assigned_teacher_id])->one();
						echo ucfirst($newStaffdata['fname']) . " " .ucfirst($newStaffdata['lname']);  
						?></td>
						<td><?php 
						
						if($mikltor->exam_date != ''){
										$newDatesds = date("d-M-Y", strtotime($mikltor->exam_date));
									}
									else {
										$newDatesds = 'NA';
									}
									
									echo $newDatesds;
						
						?></td>
						<td> <?php echo $mikltor->maximum_marks; ?> </td>
						  <td>
							<?php  
								
								
								$getstudent_marks = InhouseTestGrading::find()->where(['inhouse_test_id'=>$testerexms->id])->andwhere(['=','student_id',$student])->andwhere(['=','subject_id',$mikltor->subject_id])->one();
								
									if($getstudent_marks['marks'] != ''){
										echo $getstudent_marks['marks']; 
									} else {
										echo "NA";
									}
							
							
							?>
						  </td>
					</tr>
				<?php } }  } else {
								?>
					<tr>
						<td colspan="4" style="text-align: center;"> Please select Test First. </td>
					</tr> 

						<?php	} ?>
				    </tbody>
				
					
			    </table>

