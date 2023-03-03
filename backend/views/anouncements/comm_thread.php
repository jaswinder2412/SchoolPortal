<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ClassInfo;
use common\models\User;
use backend\models\AcedemicYear;
use backend\models\Section;
use backend\models\AddClass;
use backend\models\ClassSubject;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\Anouncements */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerCssFile('/css/multi-select.css');
$this->registerCssFile('/css/multi-select.dev.css');
$this->registerCssFile('/css/multi-select.dist.css');
$this->title = 'Parent/Teacher Communication Thread';
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
	
	
	if (Yii::$app->user->identity->role_id != 5){
		$mateods = array();
    if (Yii::$app->user->identity->role_id == 1) {
    $myroling = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['=', 'academic_year', $getisd])->all();
    }
    else if (Yii::$app->user->identity->role_id != 5){
    $myroling = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['=', 'academic_year', $getisd])->all();
    }
	
    foreach ($myroling as $rolig) {
            $rol_ids = $rolig->id;
			$goclass = AddClass::find()->where(['id'=>$rolig->class_name])->one();
			$class_is = $goclass->id;
            $mateods[$class_is] = ucfirst($goclass['class_name']);
	}
	
	
	$meteo2 = array();
    if (Yii::$app->user->identity->role_id == 1) {
    $sectings = Section::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->all();
    }
    else{
    $sectings = Section::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
	if(Yii::$app->user->identity->role_id != '5'){ $meteo2[0] = 'All Sections'; }
    foreach ($sectings as $sectionsd) {
            $sectionsd_id = $sectionsd->id;
            $meteo2[$sectionsd_id] = ucfirst($sectionsd->section_name);
        }
		
	
	}else {
		
		$mateods = array();
		$meteo2 = array();
		$getclass_ids = ClassSubject::find()->where(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$getisd])->andwhere(['=','Assigned_teacher_id',Yii::$app->user->identity->id])->groupBy(['class_id'])->all();
		
		foreach ($getclass_ids as $rolig) {
				$myrolings = ClassInfo::find()->Where(['=','id',$rolig->class_id])->andWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['=', 'academic_year', $getisd])->one();
				$rol_ids = $rolig->id;
				$goclass = AddClass::find()->where(['id'=>$myrolings['class_name']])->one();
				$seciokng = Section::find()->Where(['=', 'id', $myrolings['class_section']])->one();
				$class_is = $goclass->id;
			 	$mateods[$class_is] = ucfirst($goclass['class_name']);
				 $sectionsd_id = $seciokng->id;
				$meteo2[$sectionsd_id] = ucfirst($seciokng->section_name);
		}
		
	}
	
	 if (Yii::$app->user->identity->role_id == 1) {
			$value = Yii::$app->user->getId();
	 }
	 else{
		 $value = Yii::$app->user->identity->school_id;
	 }
	 
	 
	
		
		$statud = ['' => 'Please Select', '1' => 'Active', '0' => 'Inactive'];
?>

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
	<?php	} ?>
		
	<div class="col-md-6 mar-left-non">
		<div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Class Information</h3>
            </div>
			<div class="box-body">
				<?php if(Yii::$app->user->identity->role_id == '5'){ ?>
				<div class="form-group">
					 <?= $form->field($model, 'class_id[]',[
                        'template' => '<label>Select Class</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($mateods,['prompt' => 'Please Select']); ?> 
				</div>
				<?php } else {?>
				<div class="form-group">
					 <?= $form->field($model, 'class_id',[
                        'template' => '<label>Select Class</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($mateods,['multiple' => 'multiple']); ?>
				</div>
				<div class="form-group ">
				
				<input type="checkbox" value = "0" name="AnnouncementsParent[class_id][]" id="checked_announce"><a href="#" id="markerDiv"> All Classes
				</a>
				</div>
				<?php } ?>
				<input type="hidden" name="myrole" id="getin_rolsd" value="<?php echo Yii::$app->user->identity->role_id; ?>">
				<div class="form-group">
					 <?= $form->field($model, 'section',[
                        'template' => '<label>Select Section</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteo2,['prompt' => 'Please Select']); ?>
				</div>
				<div class="form-group">
					 <?= $form->field($model, 'Academic_year_id',[
                        'template' => '<label>Academic Year</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($acadyears,['readonly' => true]); ?>
				</div>
				<div class="form-group">
					 <?= $form->field($model, 'school_id')->hiddenInput(['value'=> $value])->label(false); ?>
				</div>
			</div>
		</div>    
			<div class="row"></div>	<div class="row"></div>
				<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Select Student</h3>
            </div>
			<div class="box-body apnd_student">
			</div>
        </div>
		
	</div>
	<div class="col-md-6">
			<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Announcement</h3>
            </div>
			<div class="box-body">
				<div class="form-group">
					 <?= $form->field($model, 'anouncement_title',[
                        'template' => '<label>Announcement Title</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-bullhorn"></i></div>{input}</div>{hint}{error}'
                    ])->textInput($mateods,['prompt' => 'Please Select']); ?>
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
				
					<?= $form->field($model, 'anouncement_description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
				</div>
					 <div class="form-group">
					<?= $form->field($model, 'status')->dropdownList($statud) ?>
				</div>				
			</div>
		</div>   	
	</div>

		
		<div class="row"></div><div class="row"></div>
		 <?php	if(!empty($acadyears)){ 
	if (Yii::$app->user->identity->role_id == 1) {
    $myanouncecount = User::find()->where(['role_id' => '6'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->count();
    }
    else{
    $myanouncecount = User::find()->where(['role_id' => '6'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->count();
    } if($myanouncecount != '0') {
		
	?>
		<div class="form-group submit_button">
	<?php if (Yii::$app->user->identity->role_id == 1) {
    $myrolingcount = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['=', 'academic_year', $getisd])->count();
    }
    else if (Yii::$app->user->identity->role_id = 5){
    $myrolingcount = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['=', 'academic_year', $getisd])->count();
    }
	
	if ($myrolingcount > 0) {
	
	?>
			<?php  echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>			
			<?= Html::a('Cancel', ['anouncements/student_index'], ['class' => 'btn btn-default tenmarleft']) ?>
	<?php } ?>
		</div>
    <?php }  } ActiveForm::end(); ?>
		
</div>
<?php

$this->registerJs("  $( function() {
    $( '#announcementsparent-start_date' ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
  
");
$this->registerJs("  $( function() {
    $( '#announcementsparent-end_date' ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
  
");
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/jquery.multi-select.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/jquery.quicksearch.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/anouncement_parent.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
?>
