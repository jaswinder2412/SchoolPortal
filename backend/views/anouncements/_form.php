<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\newStaffdata;
use backend\models\AcedemicYear;
use common\models\User;
use backend\models\AnouncementTeachersUserids;
/* @var $this yii\web\View */
/* @var $model backend\models\Anouncements */
/* @var $form yii\widgets\ActiveForm */
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
	$mateods = array();
    if (Yii::$app->user->identity->role_id == 1) {
    $myroling = User::find()->where(['role_id' => '5'])->orwhere(['role_id' => '3'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
    }
    else{
    $myroling = User::find()->where(['role_id' => '5'])->orwhere(['role_id' => '3'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
    foreach ($myroling as $rolig) {
            $rol_ids = $rolig->id;
            $myrolinsdsg = newStaffdata::find()->where(['user_id' => $rol_ids])->one();
            $midst = $myrolinsdsg['user_id'];
            $mateods[$midst] = $myrolinsdsg['fname'] . " " . $myrolinsdsg['lname'];
        }
		
	$mateods2 = array();
    if (Yii::$app->user->identity->role_id == 1) {
    $myroling2 = User::find()->where(['role_id' => '3'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
    }
    else{
    $myroling2 = User::find()->where(['role_id' => '3'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
    foreach ($myroling2 as $rolig2) {
            $rol_ids2 = $rolig2->id;
            $myrolinsdsg2 = newStaffdata::find()->where(['user_id' => $rol_ids2])->one();
            $midst2 = $myrolinsdsg2['user_id'];
            $mateods2[$midst2] = $myrolinsdsg2['fname'] . " " . $myrolinsdsg2['lname'];
        }
		
	$mateods3 = array();
    if (Yii::$app->user->identity->role_id == 1) {
    $myroling3 = User::find()->where(['role_id' => '5'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
    }
    else{
    $myroling3 = User::find()->where(['role_id' => '5'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
    foreach ($myroling3 as $rolig3) {
            $rol_ids3 = $rolig3->id;
            $myrolinsdsg3 = newStaffdata::find()->where(['user_id' => $rol_ids3])->one();
            $midst3 = $myrolinsdsg3['user_id'];
            $mateods3[$midst3] = $myrolinsdsg3['fname'] . " " . $myrolinsdsg3['lname'];
        }
		
	$meteo1 = ['' => 'Please Select', '1' => 'Active', '0' => 'Inactive'];
	
?>

<div class="anouncements-form">

    <?php $form = ActiveForm::begin([
			    'id' => 'form-terms',
				'options' => ['enctype' => 'multipart/form-data'],
				'enableAjaxValidation' => true,
				'enableClientValidation' => true,
			]);
	if(empty($acadyears)){ ?>
		<div id="w1-error" class="alert-error alert fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-time"></i>Please add active Academic Year.</div>
	<?php	}
	
	?>
		
		
	<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Announcements Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					 <?= $form->field($model, 'anouncement_title',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-bullhorn"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					 <?= $form->field($model, 'start_date',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>

				<div class="form-group">
					 <?= $form->field($model, 'end_date',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>

				<div class="form-group">
					<?= $form->field($model, 'status')->dropdownList($meteo1) ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'anouncement_description')->textarea(['rows' => 2]) ?>
				</div>
				
			  </div>
	      </div>
		  </div>
		  	<div class="col-md-6">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h3 class="box-title">Announcements To</h3>
					</div>
					<div class="box-body">
						<div class="anounceerroing">
							<span>* This field is required.</span>
						</div>
					  <ul class="nav nav-pills">
						<li class="active"><a data-toggle="pill" href="#menu1">Co-ordinators</a></li>
						<li><a data-toggle="pill" href="#menu2">Teachers</a></li>
						<li><a data-toggle="pill" href="#home">All</a></li>
					  </ul>
		<div class="tab-content">
			<div id="home" class="tab-pane fade">
				<div class="framins3">
					<div class="form-group">
						<div class="form-group field-announcementsteacher-announcements_to has-success">
					<label class="control-label" for="announcementsteacher-announcements_to"></label>
					
						<div class="col-md-12 anouncmnt_als">
						 <?php  
							$chd = "";
						 if(isset($model->id)){
								if($model->announcements_to != ''){
									$formerss = explode(',',$model->announcements_to);
									if(in_array('0',$formerss)){
										$chd = "checked='true'";
									}
									else {
										$chd = "";
									}
										}
								 } ?>           
							<input type="checkbox" id="checkboxig" class="uniqueyval"  name="AnnouncementsTeacher[announcements_to][]" value="0" <?php echo $chd; ?> >Select All Co-ordinator and Teachers.	
						</div>	
							
						<div class="help-block"></div>
						</div>					
					</div>
				</div>
			</div>
			<div id="menu1" class="tab-pane fade in active">
				<div class="framins">
					<div class="form-group">
						<div class="form-group field-announcementsteacher-announcements_to has-success">
							<label class="control-label" for="announcementsteacher-announcements_to"></label>
							
							<select id="announcementsteacher-announcements_to_second" class="form-control uniqueyval" name="AnnouncementsTeacher[announcements_to][]" multiple="multiple" size="4" aria-invalid="false">
							<?php
							if(isset($model->id)){
								$miklorik = array();
								$molking = AnouncementTeachersUserids::find()->where(['=','announcement_id',$model->id])->all();
								foreach($molking as $myloplr){
									$miklorik[] = $myloplr->teacher_id;
								}
								if(!empty($molking)){
																		
									foreach ($mateods2 as $keys => $sdds) {
									if(in_array($keys,$miklorik)){
										$checks = 'selected = "selected"';
									}
									else{
										$checks = '';
									}
									echo "<option value='" . $keys . "' ".$checks.">" . $sdds . "</option>";
								
									}
								}
								else {
									foreach ($mateods2 as $keys => $sdds) {
								echo "<option value='" . $keys . "'>" . $sdds . "</option>";
								}
								}	
								
							}
							else{
								foreach ($mateods2 as $keys => $sdds) {
								echo "<option value='" . $keys . "'>" . $sdds . "</option>";
								
							}
							}
							

								?>
							</select>
							<div class="help-block"></div>
							<button class='btn btn-default all_select' id='select-all_anounce_second'>Select all</button> 
						<button class="btn btn-default del_select pull-right" id='deselect-all_anounce_second'>Deselect all</button>
						</div>					
					</div>
				</div>
			</div>
			<div id="menu2" class="tab-pane fade">
				<div class="framins">
					<div class="form-group">
						<div class="form-group field-announcementsteacher-announcements_to has-success">
							<label class="control-label" for="announcementsteacher-announcements_to"></label>
						<select id="announcementsteacher-announcements_to_third" class="form-control uniqueyval" name="AnnouncementsTeacher[announcements_to][]" multiple="multiple" size="4" aria-invalid="false">
							<?php
							if(isset($model->id)){
								$mikloriks = array();
								$molkings = AnouncementTeachersUserids::find()->where(['=','announcement_id',$model->id])->all();
								foreach($molkings as $myloplrs){
									$mikloriks[] = $myloplrs->teacher_id;
								}
								if(!empty($molkings)){
									foreach ($mateods3 as $keyj => $sddj) {
									if(in_array($keyj,$mikloriks)){
										$checkj = 'selected = "selected"';
									}
									else{
										$checkj = '';
									}
									echo "<option value='" . $keyj . "' ".$checkj.">" . $sddj . "</option>";
								
									}
								
								}
								else {
									foreach ($mateods3 as $keyj => $sddj) {
								echo "<option value='" . $keyj . "'>" . $sddj . "</option>";
								}
								}	
								
							}
							else{
								foreach ($mateods3 as $keyj => $sddj) {
								echo "<option value='" . $keyj . "'>" . $sddj . "</option>";
								
							}
							}
							?>
							</select>
							<div class="help-block"></div>
							<button class='btn btn-default all_select' id='select-all_anounce_third'>Select all</button> 
						<button class="btn btn-default del_select pull-right" id='deselect-all_anounce_third'>Deselect all</button>
						</div>					
					</div>
				</div>
			</div>
		</div>
					</div>
				</div>
			</div>
		  <div class="row"></div><div class="row"></div>
		  <?php	if(!empty($acadyears)){ 
		  if (Yii::$app->user->identity->role_id == 1) {
    $myanouncecount = User::find()->where(['role_id' => '5'])->orwhere(['role_id' => '3'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->count();
    }
    else{
    $myanouncecount = User::find()->where(['role_id' => '5'])->orwhere(['role_id' => '3'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->count();
    } if($myanouncecount != '0') {
		
	?>
	
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id' => 'hermiyni']) ?>
				<?= Html::a('Cancel', ['anouncements/index'], ['class' => 'btn btn-default']) ?>
			</div>
		
		  <?php }  } ActiveForm::end(); ?>

</div>
