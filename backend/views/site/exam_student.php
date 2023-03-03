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
use backend\models\AddClass;
use yii\helpers\Url;	

?>

<table class="table table-striped ">
				    <thead>
				 <?php
					if(isset($exmserch_id) && !empty($exmserch_id)){
						$getexam_name = FinalExam::find()->where(['id'=>$exmserch_id])->one();
						$getexmnmer = AddExam::find()->where(['id'=>$getexam_name['exam_id']])->one();
						
					?>	
					  <!--tr>
						  <th>Exam Name : <?php //echo $getexmnmer['exam_name']; ?></th>
						 
					    </tr-->
					<?php }
						?>
					    <tr>
						  <th>Subject</th> 
						  <th>Teacher</th>
						  <?php  if($getexam_name['marks_in'] == '0'){  ?> <th>Maximum Marks</th>		<?php } ?>	
						  <th>Marks </th>
					    </tr>
						
				    </thead>
				    <tbody>
				<?php
					if(isset($exmserch_id) && !empty($exmserch_id)){
						
							$gtalsd = FinalExamSubjects::find()->where(['final_exam_id'=>$exmserch_id])->all();
							
							foreach($gtalsd as $mikltor){
							
						?>
					<tr>
						<td><?php $subjct = Subject::find()->where(['id' => $mikltor->subject_id])->one();
						echo ucfirst($subjct['subject_name']);
						?></td>
						
						<td><?php $newStaffdata = newStaffdata::find()->where(['user_id' => $mikltor->Assigned_teacher_id])->one();
						echo ucfirst($newStaffdata['fname']) . " " .ucfirst($newStaffdata['lname']); 
						?></td>
					
						<?php  if($getexam_name['marks_in'] == '0'){  ?> 	<td> <?php echo $mikltor->maximum_marks; ?> </td> <?php } ?>	
					
						  <td>
							<?php 
								
								
								$getstudent_marks = FinalExamGrading::find()->where(['final_exam_id'=>$exmserch_id])->andwhere(['=','student_id',$student])->andwhere(['=','subject_id',$mikltor->subject_id])->one();
								
								if($getexam_name['marks_in'] == '0'){
									if($getstudent_marks['marks'] != ''){
										echo $getstudent_marks['marks']; 
									} else {
										echo "NA";
									}
							}else {
								if($getstudent_marks['grade'] != ''){
										echo $getstudent_marks['grade']; 
									} else {
										echo "NA";
									}
							}
							?>
						  </td>
					</tr>
							<?php }  } else {
								?>
					<tr>
						<td colspan="4" style="text-align: center;"> Please select Exam First. </td>
					</tr> 

						<?php	} ?>
				    </tbody>
				
					
			    </table>

