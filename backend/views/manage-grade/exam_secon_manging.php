<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\newStaffdata;
use backend\models\AddStudent;
use backend\models\Subject;
use backend\models\AcedemicYear;
use common\models\User;
use backend\models\AddClass; 
use backend\models\ClassInfo; 
use backend\models\ClassStudent; 
use backend\models\ClassSubject; 
use backend\models\ExamClass; 
use backend\models\Exam; 
use backend\models\Section; 
use backend\models\ManageGrade; 

/* @var $this yii\web\View */
/* @var $model backend\models\ClassInfo */
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
$this->title = 'View Details';
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['manage-grade/teacher_index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
label{
	font-weight :500 !important;
}
.mytable th:last-child {
    min-width: auto !important;
	width: auto !important;
}
.mytable td:last-child {
    min-width: auto !important; 
	width: auto !important;
}
.text_one{
	font-weight : 500;
	font-size : 13px;
}
</style>
<?php 
if(isset($_GET['id'])){
		$class_id = $_GET['id'];
		$exam_id = $_GET['exam_id'];	
	$marksin = Exam::find()->where(['id'=>$exam_id])->one();
	$sd_marks = $marksin['marks'];
	if($sd_marks == '0'){
		$checkmarks = 'In Marks';
		$mds = "Marks";
	}else{
		$checkmarks = "In Grades";
		$mds = "Grades";
	}
?>
<div class="succeed_messages">
	<div id="w1-success" class="alert-success alert fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>

	<i class="icon fa fa-check"></i><?php echo $mds; ?> has been Updated.

	</div>
</div>
<div class="class-subject-view">
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
             <div class="box-header">
              <h3 class="box-title"><?php 
			  $getclassname = ClassInfo::find()->where(['id'=>$class_id])->one();
			  $adgetd = AddClass::find()->where(['id'=>$getclassname['class_name']])->one();
				echo ucfirst($adgetd['class_name']); ?></h3>
            </div>
			<div class="box-body">
				<table class="table table-bordered mytable">
				<thead>
				  <th>Name</th>
				  <?php 
				  $getsubjctss = ClassSubject::find()->where(['class_id'=>$class_id])->andwhere(['Assigned_teacher_id'=>Yii::$app->user->getId()])->all();
				 
				  foreach($getsubjctss as $subjectings){
				  $subject_name = Subject::find()->where(['id'=>$subjectings->subject_id])->one();
				  echo "<th>".$subject_name->subject_name ."<p class='text_one'>".$checkmarks."</p>". '</th>';
				  }
				  ?>
				  <th>Actions</th>
				</thead>
				<tbody>
				<input type="hidden" class="numbers_in_hidden" id="numbers_in" Value="<?php echo $sd_marks; ?>">
				<?php
				$getstudents = ClassStudent::find()->where(['class_id'=>$class_id])->all();
				$i = 0; 
				foreach ($getstudents as $studentlisting){ 
				$i++;
				?>
					
					<tr>
						<td>
						<?php 
						
					   $user_statusQuery = User::find()->select(['email'])->where(['id'=>$studentlisting['student_id']])->one();
						$student_getsd = AddStudent::find()->where(['user_id'=>$studentlisting['student_id']])->one();
						
						 if($student_getsd['image'] != ''){
						$hdsd = $student_getsd['image'];
					   } else {
						   $hdsd = 'dummy-profile.png';
					   }
					echo "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','class' => 'bord_img'])  
						. "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $student_getsd['first_name']  ." ". $student_getsd['last_name']  . " <p class='schl_para'>" . $user_statusQuery->email . "<p></span></div>";
					
						?>
						
						</td>
						<?php 
						foreach($getsubjctss as $subjectings){
							$getval = ManageGrade::find()->where(['exam_id'=>$exam_id])->andwhere(['class_id'=>$class_id])->andwhere(['subject_id'=>$subjectings->subject_id])->andwhere(['student_id'=>$studentlisting['student_id']])->one();
						?>
						<td>
							<input type="hidden" class="exam_hidden" id="exam_iid" Value="<?php echo $exam_id; ?>">
							<input type="hidden" class="class_hidden" id="class_iid" Value="<?php echo $class_id; ?>">
							<input type="hidden" class="student_hidden" id="student_iid" Value="<?php echo $studentlisting['student_id']; ?>">
							
						<?php 
						if($sd_marks == '0'){ ?>
						<div class="show_marks"> <?php if(!empty($getval['marks'])){
							echo $getval['marks']; 
						} else {
							echo "NA";
						} ?></div>
						<div class="next_level">
							<input type="text" id="first_subject_<?php echo $subjectings->subject_id;?>"name="fist_subject" class="second_show" value="<?php echo $getval['marks']; ?>"></td>
						</div>
						<?php }
						else{ ?>
						<div class="show_marks"> <?php if(!empty($getval['grade'])){
							echo $getval['grade']; 
						} else {
							echo "NA";
						} ?></div>
							<div class="next_level">
					<select id="first_select_<?php echo $subjectings->subject_id;?>" class="second_select_show" name="first_grade_subject">
								
					<option value="">Please Select</option>
					<option value="A+" <?php if($getval['grade']=="A+") { echo "selected"; }?> >A+</option>
					<option value="A" <?php if($getval['grade']=="A") { echo "selected"; }?>>A</option>
					<option value="A-" <?php if($getval['grade']=="A-") { echo "selected"; }?>>A-</option>
					<option value="B+" <?php if($getval['grade']=="B+") { echo "selected"; }?>>B+</option>
					<option value="B" <?php if($getval['grade']=="B") { echo "selected"; }?>>B</option>
					<option value="B-" <?php if($getval['grade']=="B-") { echo "selected"; }?>>B-</option>
					<option value="C+" <?php if($getval['grade']=="C+") { echo "selected"; }?>>C+</option>
					<option value="C" <?php if($getval['grade']=="C") { echo "selected"; }?>>C</option>
					<option value="C-" <?php if($getval['grade']=="C-") { echo "selected"; }?>>C-</option>
					</select>
							</div>
						<?php }
						?>
						
						<?php } ?>
						<td>
						
						<a class="btn btn-info update_once" id="edit_marks_<?php echo $i; ?>" href="#">Update</a>&nbsp;
							<a class="btn btn-info new_save_buttons" id="edit_marks_<?php echo $i; ?>" href="#">Save</a>
							<a class="btn btn-default cancel_once" id="cancel_marks_<?php echo $i; ?>" href="#">Cancel</a>
						</td>
					</tr>
					
					
			<?php	}
				 ?>
					
					
						
				</tbody>
				 </table>

				 </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<?php
}

$this->registerJsFile('/js/edit_marks.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
 ?>
</div>


