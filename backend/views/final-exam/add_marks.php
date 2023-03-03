<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\models\ClassInfo;
use backend\models\ClassSubject;
use backend\models\ClassStudent;
use backend\models\Subject;
use backend\models\AcedemicYear;
use backend\models\Section;
use backend\models\AddClass;
use backend\models\AddExam;
use backend\models\FinalExam;
use common\models\User;
use backend\models\SchoolList;
use backend\models\AddStudent;
use backend\models\AddGrades;
use backend\models\FinalExamGrading;
use backend\models\newStaffdata; 
use backend\models\FinalExamSubjects;
use backend\models\AnnouncementsTeacher;
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\FinalExam_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
$this->title = 'Manage Exams Marks';
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
.text_one_new{
	font-weight : 500;
	font-size : 11px;
}
</style>
<?php
	$acadyears = array();
	$getacadid = '';
    if (Yii::$app->user->identity->role_id == 1) {
        $saddfsd = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->all();
    } else {
		$saddfsd = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->all();
    }
    foreach ($saddfsd as $dfsdfsdfg) {
		$getacadid = $dfsdfsdfg->id;
        $rol_idssdfds = $dfsdfsdfg->id;
        $rol_dfifds = $dfsdfsdfg->from;
        $rol_idssddfds = $dfsdfsdfg->to;
		$acadyears[$rol_idssdfds] = $rol_dfifds . ' - ' . $rol_idssddfds;
    }
	
	
	$getexamclassnamesm = FinalExam::find()->where(['id'=>$id])->andwhere(['=','academic_year',$getacadid])->one();


		$class_id = $getexamclassnamesm['class_id'];
		$section_id = $getexamclassnamesm['section_id'];
		$exam_id = $getexamclassnamesm['id'];
		
		if (Yii::$app->user->identity->role_id == 1) {
			$main_class = ClassInfo::find()->where(['class_name'=>$class_id])->andwhere(['class_section'=>$section_id])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['=', 'academic_year', $getacadid])->one();
		} else {
			$main_class = ClassInfo::find()->where(['class_name'=>$class_id])->andwhere(['class_section'=>$section_id])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['=', 'academic_year', $getacadid])->one();
			
		}
		
   if (Yii::$app->user->identity->role_id == 1) {
        $grading = AddGrades::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->all();
    } else {
		$grading = AddGrades::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
		
		/* echo $id."<br/>". $class_id."<br/>".$section_id."<br/>".$exam_id ;
		
		die; */
	
	$sd_marks = $getexamclassnamesm['marks_in'];
	if($sd_marks == '0'){
		$checkmarks = 'In Marks';
		$mds = "Marks";
	}else{
		$checkmarks = "In Grades";
		$mds = "Grades";
	}
	$max_marks='';
?>
<div class="succeed_messages">
	<div id="w1-success" class="alert-success alert fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

	<i class="icon fa fa-check"></i><?php echo $mds; ?> has been Updated.

	</div>
</div>
<div class="class-subject-view">
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
             <div class="box-header">
              <h3 class="box-title"><?php 
			  $getclassname = ClassInfo::find()->where(['class_name'=>$class_id])->one();
			  $adgetd = AddClass::find()->where(['id'=>$getclassname['class_name']])->one
			  ();
			  
			 $mitzersd =  AddExam::find()->where(['id'=>$getexamclassnamesm['exam_id']])->one();
				
					$nersect = Section::find()->where(['id'=>$section_id])->one();
			  
				echo "<span style='font-size:16px;'><b>Exam Name :</b> ".ucfirst($mitzersd['exam_name'])." <span style='margin-left: 12px;'><b>Class:</b> ".  ucfirst($adgetd['class_name'])." ".ucfirst($nersect['section_name'])."</span></span>"; ?></h3>
            </div>
			<input type="hidden" class="numbers_in_hidden" id="numbers_in" Value="<?php echo $sd_marks; ?>">
			<div class="box-body">
				<table id="example1" class="table table-bordered mytable">
				<thead>
				  <th>Name</th>
				  <?php if(Yii::$app->user->identity->role_id == 5) {
					  
				  $getsubjctss = ClassSubject::find()->where(['class_id'=>$main_class->id])->andwhere(['Assigned_teacher_id'=>Yii::$app->user->getId()])->all();
				  }
				  else { 
					   $getsubjctss = FinalExamSubjects::find()->where(['final_exam_id'=>$exam_id])->all();
					  
				  }
				  $miklod = 0;
				  foreach($getsubjctss as $subjectings){
					   
						if(Yii::$app->user->identity->role_id == 5){
								$finlsumjects = FinalExamSubjects::find()->where(['final_exam_id'=>$exam_id])->andwhere(['Assigned_teacher_id'=>Yii::$app->user->getId()])->andwhere(['subject_id'=>$subjectings->subject_id]);
								$getsubjctsscounts = $finlsumjects->count();
								$milokeronem = $finlsumjects->one();
								if($sd_marks == '0'){
									$max_marks = "Max. Marks : ".$milokeronem['maximum_marks'];
								}
							}
							
							else {
								$max_marks = "Max. Marks : ".$subjectings->maximum_marks;
								$getsubjctsscounts = 1;
							}
							
					  if($getsubjctsscounts > 0){
					  $subject_name = Subject::find()->where(['id'=>$subjectings->subject_id])->one();
					  echo "<th>".$subject_name['subject_name'] ."<p class='text_one'>".$checkmarks."</p>"."<p class='text_one_new'>".$max_marks."</p></th>";
					  $miklod++;
					  }
				   }
				   
				  ?>
					<?php if(Yii::$app->user->identity->role_id == 5 && $miklod>0) { ?>
				  <th>Actions</th>
					<?php } ?>
				  				</thead>
				<tbody>
				
				<?php
				
				 if (Yii::$app->user->identity->role_id == 1) {
				$maximatch = ClassInfo::find()->where(['class_name'=>$class_id])->andwhere(['class_section'=>$section_id])->andWhere(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['=', 'academic_year', $getacadid])->groupBy('class_name')->all();
				} else { 
					$maximatch = ClassInfo::find()->where(['class_name'=>$class_id])->andwhere(['class_section'=>$section_id])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['=', 'academic_year', $getacadid])->groupBy('class_name')->all();
				}
				
				foreach ($maximatch as $maximatchs){
				$getstudents = ClassStudent::find()->where(['class_id'=>$maximatchs->id])->all();
				$i = 0; 
				foreach ($getstudents as $studentlisting){ 
				$miklors = AddStudent::find()->where(['user_id'=>$studentlisting->student_id])->andwhere(['=','status','10'])->one();
					  if(!empty($miklors)){
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
						$lokio = 0;
						foreach($getsubjctss as $subjectings){
							
							if(Yii::$app->user->identity->role_id == 5){
								$finlsumjects = FinalExamSubjects::find()->where(['final_exam_id'=>$exam_id])->andwhere(['Assigned_teacher_id'=>Yii::$app->user->getId()])->andwhere(['subject_id'=>$subjectings->subject_id]);
								$getsubjctsscounts = $finlsumjects->count();
								$milokeronem = $finlsumjects->one();
								if($sd_marks == '0'){
									$max_marks = $milokeronem['maximum_marks'];
								}
							}else {
								$getsubjctsscounts = 1;
							}
							if($getsubjctsscounts > 0){
							
							$getval = FinalExamGrading::find()->where(['final_exam_id'=>$exam_id])->andwhere(['class_id'=>$class_id])->andwhere(['section_id'=>$section_id])->andwhere(['subject_id'=>$subjectings->subject_id])->andwhere(['student_id'=>$studentlisting['student_id']])->one();
							
						?>
						<td>
							<input type="hidden" class="exam_hidden" id="exam_iid" Value="<?php echo $exam_id; ?>">
							<input type="hidden" class="class_hidden" id="class_iid" Value="<?php echo $class_id; ?>">
							<input type="hidden" class="section_hidden" id="section_iid" Value="<?php echo $section_id; ?>"> 
							<input type="hidden" class="student_hidden" id="student_iid" Value="<?php echo $studentlisting['student_id']; ?>">
							<input type="hidden" class="maxmarks_hidden" id="max_markss_iid_<?php echo $subjectings->id; ?>" Value="<?php echo $max_marks; ?>">
							
						<?php 
						if($sd_marks == '0'){ ?>
						<div class="show_marks"> <?php if(!empty($getval['marks'])){
							echo $getval['marks']; 
						} else {
							echo "NA";
						} ?></div>
						<div class="next_level">
							<input type="text" id="first_subject_<?php echo $subjectings->subject_id;?>"name="fist_subject" class="second_show minersw" value="<?php echo $getval['marks']; ?>"></td>
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
					<?php 
						foreach($grading as $grademangr){
							
							if($getval['grade'] == $grademangr->grade_name){
								$mitrolp = "selected='selected'";
							}
							else{
								$mitrolp = "";
							} 
					?>
					<option value="<?php echo $grademangr->grade_name; ?>"  <?php echo $mitrolp; ?>><?php echo $grademangr->grade_name; ?></option>
					
						<?php } ?>
					
					
					</select>
							</div>
						<?php }
						?>
						
							<?php $lokio++;}
							} 
						
						?>
						<?php if(Yii::$app->user->identity->role_id == 5 && $lokio > 0) { ?>
						<td>
						<a class="btn btn-info update_once" id="edit_marks_<?php echo $i; ?>" href="#">Update</a>&nbsp;
							<a class="btn btn-info new_save_buttons" id="edit_marks_<?php echo $i; ?>" href="#">Save</a>
							<a class="btn btn-default cancel_once" id="cancel_marks_<?php echo $i; ?>" href="#">Cancel</a>
						</td>
						<?php } ?>
						
					</tr>
					
					
				<?php	} }
				}
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

$this->registerJs("$('#example1').dataTable( {
  'ordering': false
} );
  
");

$this->registerJsFile('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile('/js/edit_final_marks.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
 ?>
</div>