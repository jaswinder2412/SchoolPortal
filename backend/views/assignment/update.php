<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ClassInfo;
use backend\models\ClassStudent;
use backend\models\AcedemicYear;
use backend\models\Section;
use backend\models\AddClass;
use backend\models\AddStudent;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\Anouncements */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerCssFile('/css/multi-select.css');
$this->registerCssFile('/css/multi-select.dev.css');
$this->registerCssFile('/css/multi-select.dist.css');
$this->title = 'Update Parent Announcements';
$this->params['breadcrumbs'][] = ['label' => 'Announcements', 'url' => ['student_index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anouncements-create">
<?php 

	$acadyears = array();
	$getisd = '';
    if (Yii::$app->user->identity->role_id == 1) {
        $saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->all();
    } else {
        $saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->all();
    }
    foreach ($saddfs as $dfsdfsdfg) {
        $rol_idsfds = $dfsdfsdfg->id;
		$getisd = $dfsdfsdfg->id;
        $rol_ifds = $dfsdfsdfg->from;
        $rol_idsdfds = $dfsdfsdfg->to;
		$acadyears[$rol_idsfds] = $rol_ifds . ' - ' . $rol_idsdfds;
    }
	
	$mateods = array();
    if (Yii::$app->user->identity->role_id == 1) {
    $myroling = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['=', 'academic_year', $getisd])->all();
    }
    else{
    $myroling = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['=', 'academic_year', $getisd])->all();
    }
	
    foreach ($myroling as $rolig) {
            $rol_ids = $rolig->id;
			$goclass = AddClass::find()->where(['id'=>$rolig->class_name])->one();
			$class_is = $goclass->id;
            $mateods[$class_is] = $goclass['class_name'];
	}
	
	 if (Yii::$app->user->identity->role_id == 1) {
			$value = Yii::$app->user->getId();
	 }
	 else{
		 $value = Yii::$app->user->identity->school_id;
	 }
	
	$meteo2 = array();
    if (Yii::$app->user->identity->role_id == 1) {
    $sectings = Section::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->all();
    }
    else{
    $sectings = Section::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
	$meteo2[0] = 'All Sections';
    foreach ($sectings as $sectionsd) {
            $sectionsd_id = $sectionsd->id;
            $meteo2[$sectionsd_id] = $sectionsd->section_name;
        }
		
		
		$statud = ['' => 'Please Select', '1' => 'Active', '0' => 'Inactive'];
?>

    <?php $form = ActiveForm::begin(); ?>
		
		
	<div class="col-md-6 mar-left-non">
		<div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Class Information</h3>
            </div>
			<div class="box-body">
			<?php if(Yii::$app->user->identity->role_id == '5'){ ?>
			
				<div class="form-group">
			 <div class="form-group field-assignmentclasses-class_id">
				<label>Select Class</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					<select id="assignmentclasses-class_id" class="form-control" name="Assignmentclasses[class_id]" disabled="disabled">
						<?php 
						$goting = explode(',',$model->class_id);
							foreach($mateods as $key => $vlues){
								if(in_array($key,$goting)){
									$gets = "selected='selected'";
								}else {
									$gets = "";
								}
								echo "<option value='".$key."' ".$gets.">".$vlues."</option>";
							}
						
						?>
					</select>
				</div>
				<div class="help-block"></div>
			 </div>				
			</div>
			
			<?php } else { ?>
			<div class="form-group">
			 <div class="form-group field-assignmentclasses-class_id">
				<label>Select Class</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					<select id="assignmentclasses-class_id" class="form-control" name="Assignmentclasses[class_id]" multiple="multiple" disabled="disabled">
						<?php 
						$goting = explode(',',$model->class_id);
							foreach($mateods as $key => $vlues){
								if(in_array($key,$goting)){
									$gets = "selected='selected'";
								}else {
									$gets = "";
								}
								echo "<option value='".$key."' ".$gets.">".$vlues."</option>";
							}
						?>
					</select>
				</div>
				<div class="help-block"></div>
			 </div>				
			</div>
				<div class="form-group">
					
					 <?php
						$goting_two = explode(',',$model->class_id);
						if(in_array('0',$goting_two)){
							$newchk = 'checked="checked"';
						} else {
							$newchk = '';
						}
						echo '<input type="checkbox" disabled="disabled" '.$newchk.' >'.' All Classes';
					  ?>
				</div>
			<?php } ?>
				<div class="form-group">
					 <?= $form->field($model, 'section',[
                        'template' => '<label>Select Section</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteo2,['disabled' => 'disabled']); ?>
				</div>
				<div class="form-group">
					 <?= $form->field($model, 'Academic_year_id',[
                        'template' => '<label>Academic Year</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($acadyears,['disabled' => 'disabled']); ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'status')->dropdownList($statud) ?>
				</div>
				<div class="form-group">
					 <?= $form->field($model, 'school_id')->hiddenInput(['value'=> $value])->label(false); ?>
				</div>
				
				
				
			</div>
		</div>    
	</div>
	<div class="col-md-6">
			<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Assignment</h3>
            </div>
			<div class="box-body">
				<div class="form-group">
					 <?= $form->field($model, 'anouncement_title',[
                        'template' => '<label>Assignment Title</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-bullhorn"></i></div>{input}</div>{hint}{error}'
                    ])->textInput(); ?>
				</div>
				<div class="form-group">
				<?= $form->field($model, 'anouncement_description')->widget(CKEditor::className(), [
					'options' => ['rows' => 6],
					'preset' => 'basic'
				]) ?>
				</div>
				
				<div class="form-group" style="min-height : 50px;">
					<?php if($model->fileupload != ''){ ?>
						<label id="htyldsd"> File </label>
						<div class="htyls">
						
							<div class="col-md-10">
								<a href="<?php echo Yii::$app->homeUrl .'upload_file/'.$model->fileupload; ?>" download>Click here to download file.</a>
							</div>
							<div class="col-md-2">
								<a href="#" class="my_mix_2" style="font-size:18px;" id='dele_img'><i class="fa fa-times" aria-hidden="true"></i></a>
							</div>
						</div>
						<div class="htyls_second">
						<?= $form->field($model, 'fileupload')->fileInput() ?>
					<span style="font-size : 11px;"> Max Image size 10MB.</span>
						</div>
					<?php }else{?>
						<?= $form->field($model, 'fileupload')->fileInput() ?>
					<span style="font-size : 11px;"> Max Image size 10MB.</span>
					<?php } ?>
					
				</div>
			</div>
		</div>   	
	</div>
	
	<?php if (Yii::$app->user->identity->role_id == 5) {
		
		$calssdew = "margin_upgoin_second";
		
	}else {
		$calssdew = "margin_upgoin";
	}

	?>
	

	<div class="row"></div>
		<div class="col-md-6 mar-left-non <?php echo $calssdew; ?>">
		<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Select Student</h3>
            </div>
			<div class="box-body">
			<?php 
			 $classdin = ClassInfo::find()->where(['class_name' => $model->class_id])->AndWhere(['=', 'school_id', $model->school_id])->AndWhere(['=', 'class_section', $model->section])->AndWhere(['=', 'academic_year', $model->Academic_year_id])->one(); 
	 $checkisd = explode(',',$model->class_id);
	 if(!empty($classdin['id'])){
		 
	 
	 $studentsd = ClassStudent::find()->where(['class_id' => $classdin['id']])->all();
	 
	 $vldsi = explode(',',$model->student_id);
	 
	 ?>
	 
 <div class="form-group">
	 <div class="form-group field-assignmentclasses-student_id">
	
		<select id="assignmentclasses-student_id" class="form-control" name="Assignmentclasses[student_id][]"  multiple="multiple" readonly="true">
		<?php foreach($studentsd as $mystudent){ 
			 $getstud = AddStudent::find()->where(['user_id' => $mystudent->student_id])->andwhere(['=','status','10'])->one();
			 if(!empty($getstud)){
			 if(in_array($getstud['user_id'],$vldsi)){
				 $check = "selected='selected'";
			 }
			 else{
				 $check = "";
			 }
				echo "<option value='".$getstud['user_id']."' ".$check.">".$getstud['first_name']." ".$getstud['last_name']."  </option>";
			 }
		} ?>
		
		</select>
		
		<div class="help-block"></div>
		
		<button class='btn btn-default all_select' id='select-all'>Select all</button> 
		<button class="btn btn-default del_select pull-right" id='deselect-all'>Deselect all</button>
	 </div>		
		<span class="first_type_error" style="color : red;">* Please select Atleast one Student </span>
 </div>
	 <?php } else if(in_array('0',$checkisd)){
				echo "All classes and all section selected.";
	 } 
	 
	else if((!in_array('0',$checkisd)) && (count($checkisd) >= 1)) {
			echo "All sections selected."; 
	 }
		
	 ?>
			</div>
        </div>
		</div>
		
		<div class="row"></div><div class="row"></div>
		<div class="form-group submit_button">
			<?php  echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=> 'gangores']); ?>
			<?= Html::a('Cancel', ['assignment/index'], ['class' => 'btn btn-default tenmarleft']) ?>
		</div>
    <?php ActiveForm::end(); ?>
		 
</div>
<?php
$mids = $model->id;


$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/jquery.multi-select.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/jquery.quicksearch.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

	$this->registerJs("
	jQuery('.htyls_second').hide();
	jQuery('#dele_img').click(function(){
		$.ajax({
		type :'POST',
        data: {id:". $mids ." },
        url:'/assignment/deletefiles',
        success: function(response){
            console.log(response); 
				jQuery('.htyls_second').show();
				jQuery('.htyls').hide(); jQuery('#htyldsd').hide(); 
        }
    });
	
	})");

$this->registerJsFile('/js/assignment_update.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
?>
