<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AcedemicYear;
/* @var $this yii\web\View */
/* @var $model backend\models\AddExam */
/* @var $form yii\widgets\ActiveForm */
?>



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
	?>

    <?php $form = ActiveForm::begin(
			[
			    'id' => 'form-terms',
				'options' => ['enctype' => 'multipart/form-data'],
				'enableAjaxValidation' => true,
				'enableClientValidation' => true,
			]); ?>
	
		<?php if(empty($acadyears)){ ?>
		<div id="w1-error" class="alert-error alert fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-time"></i>Please add active Academic Year.</div>
	<?php	} ?>
	
<div class="add-class-form">
<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Exam Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					  <?= $form->field($model, 'exam_name')->textInput() ?>
				</div>
				
			  </div>
	      </div>
		
	<?php if(!empty($acadyears)){ ?>		
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			<?= Html::a('Cancel', ['add-exam/index'], ['class' => 'btn btn-default']) ?>
		</div>
	</div>
   

    <?php } ActiveForm::end(); ?>

</div>


