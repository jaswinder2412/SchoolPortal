<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AcedemicYear;
/* @var $this yii\web\View */
/* @var $model backend\models\Subject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subject-form">
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
$meteo = ['' => 'Please Select', 'Broad' => 'Broad', 'James' => 'James', 'Erick' => 'Erick', 'Niclos' => 'Niclos', 'Fredo' => 'Fredo', 'Mart' => 'Mart', 'John' => 'John', 'Silvester' => 'Silvester', 'Mickey' => 'Mickey', 'Patrick' => 'Patrick']; 

$meteo1 = ['' => 'Please Select', 'Pre-Nursery' => 'Pre-Nursery', 'Nursery' => 'Nursery', 'L.K.G' => 'L.K.G', 'U.K.G' => 'U.K.G', 'First' => 'First', 'Second' => 'Second', 'Third' => 'Third', 'Fourth' => 'Fourth', 'Fifth' => 'Fifth', 'Sixth' => 'Sixth'];  ?>


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
	
<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Subject Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					 <?= $form->field($model, 'subject_name')->textinput() ?>
				</div>
				
				<div class="form-group">
					 <?= $form->field($model, 'subject_description')->textarea(['rows' => 3]) ?>
				</div>
			  </div>
	      </div>
		
	<?php if(!empty($acadyears)){ ?>		
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			<?= Html::a('Cancel', ['subject/index'], ['class' => 'btn btn-default']) ?>
		</div>
	</div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>
