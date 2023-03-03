<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ManageGrade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manage-grade-form">
<?php
$meteo = ['' => 'Please Select', 'Pre-Nursery' => 'Pre-Nursery', 'Nursery' => 'Nursery', 'L.K.G' => 'L.K.G', 'U.K.G' => 'U.K.G', 'First' => 'First', 'Second' => 'Second', 'Third' => 'Third', 'Fourth' => 'Fourth', 'Fifth' => 'Fifth', 'Sixth' => 'Sixth']; 
$meteo1 = ['' => 'Please Select', 'Science' => 'Science', 'English' => 'English', 'Social Studies' => 'Social Studies', 'Mathematics' => 'Mathematics', ]; ?>
    <?php $form = ActiveForm::begin(); ?>
	<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Manage Grade</h3>
            </div>
           
				<div class="box-body">
				<div class="form-group">
					  <?= $form->field($model, 'class_name')->dropdownList($meteo, ['multiple' => 'multiple']); ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'grade',[
                        'template' => '<label>Exam Name</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->textInput(); ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'subject')->dropdownList($meteo1, ['multiple' => 'multiple']); ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'student',[
                        'template' => '<label>No. Of Students</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->textInput(); ?>
				</div>
				
			  </div>
	      </div>
		
		 <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

		
	</div>
    
    <?php ActiveForm::end(); ?>

</div>

