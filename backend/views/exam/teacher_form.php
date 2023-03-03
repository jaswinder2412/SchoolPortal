<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ClassInfo;
use backend\models\ClassSubject;
use backend\models\AcedemicYear;
use backend\models\Section;
use backend\models\Subject;
use backend\models\AddClass;
/* @var $this yii\web\View */
/* @var $model backend\models\Exam */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->title = 'Create Exam';
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-create">

<div class="exam-form">
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

	$meteo = array();
    if (Yii::$app->user->identity->role_id == 1) {
        $saddfs = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['=', 'academic_year', $getacadid])->groupBy('class_name')->all();
    } else { 
        $saddfs = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['=', 'academic_year', $getacadid])->groupBy('class_name')->all();
    }
    foreach ($saddfs as $dfsdfsdfg) {
        $rol_idsfds = $dfsdfsdfg->id;
        $rol_ifds = $dfsdfsdfg->class_name;
		$goclass = AddClass::find()->where(['id'=>$rol_ifds])->one();
        $meteo[$goclass['id']] = $goclass['class_name'];
    }
	
	$setcion = array();
	if (Yii::$app->user->identity->role_id == 1) {
        $secting = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['=', 'academic_year', $getacadid])->all();
    } else { 
        $secting = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['=', 'academic_year', $getacadid])->all();
    }

    foreach ($secting as $sections) {
        $section_id = $sections->id;
		$stcn_nam = $sections->class_section;
		$getnameofsection = Section::find()->Where(['=', 'id', $stcn_nam])->one();
        $section_name = $getnameofsection['section_name'];
		$mysect_id = $getnameofsection['id'];
        $setcion[$mysect_id] = $section_name;
    }
	
	$getmysubejct = array();
	$gtsubjctsl = ClassSubject::find()->where(['Assigned_teacher_id'=>Yii::$app->user->getId()])->groupBy(['subject_id'])->all();
   foreach ($gtsubjctsl as $subgctsd) {
       $subhcjt_id = $subgctsd->subject_id;
	   $getingsubjsct = Subject::find()->where(['id'=>$subhcjt_id])->one();
	   $getmysubejct[$subhcjt_id] =  $getingsubjsct['subject_name'];
    }
?>
    <?php $form = ActiveForm::begin(); 
	if(empty($acadyears)){ ?>
		<div id="w1-error" class="alert-error alert fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-time"></i>Please add active Academic Year.</div>
	<?php	} ?>
	<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Exam Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					  <?= $form->field($model_second, 'subject_id',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($getmysubejct,['prompt' => 'Please Select']); ?>
				</div>
				
				<div class="form-group">
					  <div class="apnd_classing"></div>
				</div>
				
			  </div>
	      </div>
	</div> 
	
	<div class="row"></div>
	<div class="row"></div>
	<?php	if(!empty($acadyears)){ ?>
		<div class="form-group">
        <?php //echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'examclassin']) ?>		
		<?= Html::a('Cancel', ['exam/teacher_examindex'], ['class' => 'btn btn-default tenmarleft']) ?>
		</div>

	<?php } ?>	
	  
    <?php ActiveForm::end(); ?>

</div>
</div>
<?php

$this->registerJs("  $( function() {
    $( '#exam-exam_date' ).datepicker({
    minDate: 0,
});
  } );
  
");


$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/teacher_exam.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
 ?>