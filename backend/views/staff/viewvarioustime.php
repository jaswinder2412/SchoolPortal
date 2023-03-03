<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\models\AnnouncementsTeacher;
use backend\models\AnouncementTeachersUserids;
use backend\models\ClassteacherSubject;
use backend\models\ClassInfo;
use backend\models\AddClass;
use backend\models\Subject;
use backend\models\AcedemicYear;
use backend\models\Section;
use backend\models\Timetable;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Staff_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$fullnames = $model->fname." ".$model->lname."'s ";
$this->title = $fullnames.'Timetable';
$this->params['breadcrumbs'][] = $this->title;
$getclasses = array();
$getsubjgtc = array();
$getsectionsd = array();
 if (Yii::$app->user->identity->role_id == 1) {
		$acdminer = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
	} else {
		$acdminer = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
	}
 $modelss = ClassteacherSubject::find()->where(['Assigned_teacher_id'=>$model->user_id])->andwhere(['=','academic_year',$acdminer['id']])->groupby(['class_id'])->all();
	 foreach($modelss as $class_student) {
		 $model_student = ClassInfo::find()->where(['id'=> $class_student->class_id])->one();
		 $getclass_name = AddClass::find()->where(['id'=>$model_student['class_name']])->one();
		 $getingsecocn = Section::find()->where(['id'=>$model_student->class_section])->one();
		 $getclasses[$getclass_name['id']] = $getclass_name['class_name'];
		 $getsectionsd[$getingsecocn['id']] = $getingsecocn['section_name'];
		 
	 }
	 
	 foreach($modelss as $subjdcts){
		 $model_subjict = Subject::find()->where(['id'=> $subjdcts->subject_id])->one();
		 $getsubjgtc[$model_subjict['id']] = $model_subjict['subject_name'];
	 }
	 
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


?>
<style>
 .hint { display: none; }
.field:hover .hint { display: inline; }
.table td:last-child {
    min-width: auto !important;
}
</style>
<div class="staff-index">
 <?php 
	if(isset($academics_set) && !empty($academics_set)){
		$presnt_acad = $academics_set;
		$academine = $academics_set;
		$keysacad = $academics_set;
		/* echo $presnt_acad;
		die; */
	}else {
		if (Yii::$app->user->identity->role_id == 1) {
        $presnt_acadi = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
		$presnt_acad = $presnt_acadi['id'];
		$academine = $presnt_acadi['id'];
		$keysacad = $presnt_acadi['id'];
		} else {
			$presnt_acadi = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			$presnt_acad = $presnt_acadi['id'];
			$academine = $presnt_acadi['id'];
			$keysacad = $presnt_acadi['id'];
		}
	}
	
	

?>

		<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box box-primary">
           
              <table id="" class="table box-body table-bordered timetable">
                <thead>
					<tr>
					  <th valign="middle"><img style="width: 35%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/6.png"> 
					  <br/><b>Days</b></th>
					  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q5.png"> 
					  <br/>1st</th>
					  <th valign="middle">
					  <img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q4.png"> 
					  <br/>2nd</th> 
					  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q3.png"> 
					  <br/>3rd</th>
					  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q6.png"> 
					  <br/>4th</th>
					  <th valign="middle">
					  <img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q5.png"> 
					  <br/>
					  5th</th>
					  <th valign="middle"><img style="width: 30%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q3.png"> 
					  <br/>6th</th>
					  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q2.png"> 
					  <br/>7th</th>
					  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q1.png"> 
					  <br/>8th</th>
					  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q5.png"> 
					  <br/>9th</th>
					</tr>
                </thead>
                <tbody>
					<?php $x = 8;
							for($x = 1; $x < 7; $x++) { ?>
					<tr>
					  <td valign="middle">
					  <img style="width: 35%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/<?php echo $x; ?>.png"> 
					  <br/><b>
					  <?php if($x == '1'){ echo "Monday";}
							else if($x == '2'){ echo "Tuesday";}
							else if($x == '3'){ echo "Wednesday";}
							else if($x == '4'){ echo "Thursday";}
							else if($x == '5'){ echo "Friday";}
							else if($x == '6'){ echo "Saturday";}

					  ?></b></td>
					  
					  <td class="field" id="data_<?php echo $x; ?>_1" valign="middle">
						
						
						<?php $timnames = Timetable::find()->where(['day_id'=>$x])->andwhere(['=','lecture_id','1'])->andwhere(['=','teacher_id',$model->user_id])->andwhere(['=','academic_year',$presnt_acad])->one(); 
						
						?>
						
						<br/><?php
						if(($timnames['lecturestatus'] == 1) || ($timnames['lecturestatus'] == '')){ ?>
						<?php $classnmas = AddClass::find()->where(['id'=>$timnames['class_id']])->one();
						$sectings = Section::find()->where(['id'=>$timnames['section_id']])->one();
						$subjectingsd = Subject::find()->where(['id'=>$timnames['subject_id']])->one();
						echo ucfirst($classnmas['class_name'])." - ".ucfirst($sectings['section_name']); ?> <br/> <?php echo ucfirst($subjectingsd['subject_name']); ?>
						<?php	} else { ?>
						<br/><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
						<br/><span style="color : red;">Free Lecture</span>
						<?php } ?>
					  </td>
					  
					  <td id="data_<?php echo $x; ?>_2" class="field" valign="middle">
					  
					  
						<?php $timnames = Timetable::find()->where(['day_id'=>$x])->andwhere(['=','lecture_id','2'])->andwhere(['=','teacher_id',$model->user_id])->andwhere(['=','academic_year',$presnt_acad])->one();
						
						?>
						<br/><?php
						if(($timnames['lecturestatus'] == 1) || ($timnames['lecturestatus'] == '')){ ?>
						<?php $classnmas = AddClass::find()->where(['id'=>$timnames['class_id']])->one();
						$sectings = Section::find()->where(['id'=>$timnames['section_id']])->one();
						$subjectingsd = Subject::find()->where(['id'=>$timnames['subject_id']])->one();
						echo ucfirst($classnmas['class_name'])." - ".ucfirst($sectings['section_name']); ?> <br/> <?php echo ucfirst($subjectingsd['subject_name']); ?>
						<?php	} else { ?>
						<br/><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
						<br/><span style="color : red;">Free Lecture</span>
						<?php } ?>
					  </td>
					  
					  <td id="data_<?php echo $x; ?>_3" class="field" valign="middle">
					
						<?php $timnames = Timetable::find()->where(['day_id'=>$x])->andwhere(['=','lecture_id','3'])->andwhere(['=','teacher_id',$model->user_id])->andwhere(['=','academic_year',$presnt_acad])->one();
						
						?>
						<br/><?php
						if(($timnames['lecturestatus'] == 1) || ($timnames['lecturestatus'] == '')){ ?>
						<?php $classnmas = AddClass::find()->where(['id'=>$timnames['class_id']])->one();
						$sectings = Section::find()->where(['id'=>$timnames['section_id']])->one();
						$subjectingsd = Subject::find()->where(['id'=>$timnames['subject_id']])->one();
						echo ucfirst($classnmas['class_name'])." - ".ucfirst($sectings['section_name']); ?> <br/> <?php echo ucfirst($subjectingsd['subject_name']); ?>
						<?php	} else { ?>
						<br/><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
						<br/><span style="color : red;">Free Lecture</span>
						<?php } ?>
					  </td>
					  
					  <td id="data_<?php echo $x; ?>_4" class="field" valign="middle">
					  
						<?php $timnames = Timetable::find()->where(['day_id'=>$x])->andwhere(['=','lecture_id','4'])->andwhere(['=','teacher_id',$model->user_id])->andwhere(['=','academic_year',$presnt_acad])->one();
						
						?>
						<br/><?php
						if(($timnames['lecturestatus'] == 1) || ($timnames['lecturestatus'] == '')){ ?>
						<?php $classnmas = AddClass::find()->where(['id'=>$timnames['class_id']])->one();
						$sectings = Section::find()->where(['id'=>$timnames['section_id']])->one();
						$subjectingsd = Subject::find()->where(['id'=>$timnames['subject_id']])->one();
						echo ucfirst($classnmas['class_name'])." - ".ucfirst($sectings['section_name']); ?> <br/> <?php echo ucfirst($subjectingsd['subject_name']); ?>
						<?php	} else { ?>
						<br/><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
						<br/><span style="color : red;">Free Lecture</span>
						<?php } ?>
					  </td>
					  
					  <td id="data_<?php echo $x; ?>_5" class="field" valign="middle">
					 
						<?php $timnames = Timetable::find()->where(['day_id'=>$x])->andwhere(['=','lecture_id','5'])->andwhere(['=','teacher_id',$model->user_id])->andwhere(['=','academic_year',$presnt_acad])->one();
						
						?>
						<br/><?php
						if(($timnames['lecturestatus'] == 1) || ($timnames['lecturestatus'] == '')){ ?>
						<?php $classnmas = AddClass::find()->where(['id'=>$timnames['class_id']])->one();
						$sectings = Section::find()->where(['id'=>$timnames['section_id']])->one();
						$subjectingsd = Subject::find()->where(['id'=>$timnames['subject_id']])->one();
						echo ucfirst($classnmas['class_name'])." - ".ucfirst($sectings['section_name']); ?> <br/> <?php echo ucfirst($subjectingsd['subject_name']); ?>
						<?php	}  else if($timnames['lunchbreak'] == 1){ ?>
							Lunch Break 
							<input type="hidden" class="newbrks" name="breaktime" id="breakcheck_5" value="1">
						<?php } else { ?>
						<br/><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
						<br/><span style="color : red;">Free Lecture</span>
						<?php } ?>
					  </td>
					  
					  <td id="data_<?php echo $x; ?>_6" class="field" valign="middle">
					
					  
						<?php $timnames = Timetable::find()->where(['day_id'=>$x])->andwhere(['=','lecture_id','6'])->andwhere(['=','teacher_id',$model->user_id])->andwhere(['=','academic_year',$presnt_acad])->one();
						
						?>
						<br/><?php
						if(($timnames['lecturestatus'] == 1) || ($timnames['lecturestatus'] == '')){ ?>
						<?php $classnmas = AddClass::find()->where(['id'=>$timnames['class_id']])->one();
						$sectings = Section::find()->where(['id'=>$timnames['section_id']])->one();
						$subjectingsd = Subject::find()->where(['id'=>$timnames['subject_id']])->one();
						echo ucfirst($classnmas['class_name'])." - ".ucfirst($sectings['section_name']); ?> <br/> <?php echo ucfirst($subjectingsd['subject_name']); ?>
						<?php	} else if($timnames['lunchbreak'] == 1){?>
							Lunch Break 
							<input type="hidden" class="newbrks" name="breaktime" id="breakcheck_6" value="1">
						<?php } else {  ?>
						<br/><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
						<br/><span style="color : red;">Free Lecture</span>
						<?php } ?>
					  </td>
					  
					  <td class="field" id="data_<?php echo $x; ?>_7" valign="middle">
					
						<?php $timnames = Timetable::find()->where(['day_id'=>$x])->andwhere(['=','lecture_id','7'])->andwhere(['=','teacher_id',$model->user_id])->andwhere(['=','academic_year',$presnt_acad])->one();
						
						?>
						<br/><?php
						if(($timnames['lecturestatus'] == 1) || ($timnames['lecturestatus'] == '')){ ?>
						<?php $classnmas = AddClass::find()->where(['id'=>$timnames['class_id']])->one();
						$sectings = Section::find()->where(['id'=>$timnames['section_id']])->one();
						$subjectingsd = Subject::find()->where(['id'=>$timnames['subject_id']])->one();
						echo ucfirst($classnmas['class_name'])." - ".ucfirst($sectings['section_name']); ?> <br/> <?php echo ucfirst($subjectingsd['subject_name']); ?>
						<?php	}  else if($timnames['lunchbreak'] == 1){ ?>
							Lunch Break 
							<input type="hidden" class="newbrks" name="breaktime" id="breakcheck_7" value="1">
						<?php }   else { ?>
						<br/><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
						<br/><span style="color : red;">Free Lecture</span>
						<?php } ?>
					  </td>
					  
					  <td class="field" id="data_<?php echo $x; ?>_8" valign="middle">
				
						<?php $timnames = Timetable::find()->where(['day_id'=>$x])->andwhere(['=','lecture_id','8'])->andwhere(['=','teacher_id',$model->user_id])->andwhere(['=','academic_year',$presnt_acad])->one();
						
						?>
						<br/><?php
						if(($timnames['lecturestatus'] == 1) || ($timnames['lecturestatus'] == '')){ ?>
						<?php $classnmas = AddClass::find()->where(['id'=>$timnames['class_id']])->one();
						$sectings = Section::find()->where(['id'=>$timnames['section_id']])->one();
						$subjectingsd = Subject::find()->where(['id'=>$timnames['subject_id']])->one();
						echo ucfirst($classnmas['class_name'])." - ".ucfirst($sectings['section_name']); ?> <br/> <?php echo ucfirst($subjectingsd['subject_name']); ?>
						<?php	} else { ?>
						<br/><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
						<br/><span style="color : red;">Free Lecture</span>
						<?php } ?>
					  </td>
					  
					  <td class="field" id="data_<?php echo $x; ?>_9" valign="middle">
					
						<?php $timnames = Timetable::find()->where(['day_id'=>$x])->andwhere(['=','lecture_id','9'])->andwhere(['=','teacher_id',$model->user_id])->andwhere(['=','academic_year',$presnt_acad])->one();
						
						?>
						<br/><?php
						if(($timnames['lecturestatus'] == 1) || ($timnames['lecturestatus'] == '')){ ?>
						<?php $classnmas = AddClass::find()->where(['id'=>$timnames['class_id']])->one();
						$sectings = Section::find()->where(['id'=>$timnames['section_id']])->one();
						$subjectingsd = Subject::find()->where(['id'=>$timnames['subject_id']])->one();
						echo ucfirst($classnmas['class_name'])." - ".ucfirst($sectings['section_name']); ?> <br/> <?php echo ucfirst($subjectingsd['subject_name']); ?>
						<?php	} else { ?>
						<br/><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
						<br/><span style="color : red;">Free Lecture</span>
						<?php } ?>
					  </td>
					  
					</tr>
					<?php	}	?>
                </tbody>
              </table>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->			  <!-- Modal -->
			 
</div>

</div>
<?php

$this->registerJs("
$('#mybuttons').click(function(){
	var rel = $(this).attr('rel');
	
	
	$.ajax({
				type :'POST',
				data: {announceid: rel},
				url:'".Yii::getAlias('@base')."/anouncements/announcement_seen',
				success: function(response){
					
					console.log(response);
					
					}
	});
	
});
  
");

$this->registerJsFile(''.Yii::getAlias('@base').'/js/timetable.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile(''.Yii::getAlias('@base').'/js/dashboard_request.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

?>