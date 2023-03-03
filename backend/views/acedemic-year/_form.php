<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AcedemicYear */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acedemic-year-form">
<?php 
$meteo = ['' => 'Please Select', '1' => 'Active', '0' => 'Inactive'];
?>
    <?php $form = ActiveForm::begin(
			[
			    'id' => 'form-terms',
				'options' => ['enctype' => 'multipart/form-data'],
				'enableAjaxValidation' => true,
				'enableClientValidation' => true,
			]);  ?> 
	<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Academic Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					    <?= $form->field($model, 'academic_name',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->textinput() ?>
				</div>
				<div class="form-group">
					    <?= $form->field($model, 'from',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textinput() ?>
				</div>
				<div class="form-group">
					  <?= $form->field($model, 'to',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textinput() ?>
				</div>  
				<div class="form-group">
					  <?= $form->field($model, 'status',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-plus-square"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteo) ?>
				</div>
				
			  </div>
	      </div>
		
		
		 <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('Cancel', ['acedemic-year/index'], ['class' => 'btn btn-default']) ?>
    </div>
	</div>
    <?php ActiveForm::end(); ?>

</div>
