<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClassSubject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="class-subject-form">
<?php 

				$meteo1 = ['' => 'Please Select', 'Science' => 'Science', 'English' => 'English', 'Social Studies' => 'Social Studies', 'Mathematics' => 'Mathematics', ];
				$meteo2 = ['' => 'Please Select', '2001' => '2001', '2002' => '2002', '2003' => '2003','2004' => '2004', '2005' => '2005', '2006' => '2006', '2007' => '2007', '2008' => '2008', '2009' => '2009','2010' => '2010', '2011' => '2011', '2012' => '2012', '2013' => '2013', '2014' => '2015', '2016' => '2016','2017' => '2017'];
				$meteo3 = ['' => 'Please Select', 'James' => 'James', 'Steve' => 'Steve', 'Henry' => 'Henry',  'Patrick' => 'Patrick', 'Reo' => 'Reo', ];
				$meteo4 = ['' => 'Please Select', 'Nursery' => 'Nursery', 'L.K.G' => 'L.K.G', 'U.K.G' => 'U.K.G',  'First' => 'First', 'Second' => 'Second', ];

?>
    <?php $form = ActiveForm::begin(); ?>
	
	
		<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					<?= $form->field($model, 'class_id',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteo4) ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'subject_id',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteo1) ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'Assigned_teacher_id',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteo3) ?>
				</div>
				<div class="form-group">
					<div class="form-group field-acadic_year">
						<label class="control-label" for="academic_year">Academic Year</label>
						<select id="newsata-academic_year" class="form-control" name="d[academic_year]">
						<option value="">Please Select</option>
						<option value="2001">2001</option>
						<option value="2002">2002</option>
						<option value="2003">2003</option>
						<option value="2004">2004</option>
						<option value="2005">2005</option>
						<option value="2006">2006</option>
						<option value="2007">2007</option>
						<option value="2008">2008</option>
						<option value="2009">2009</option>
						<option value="2010">2010</option>
						<option value="2011">2011</option>
						<option value="2012">2012</option>
						<option value="2013">2013</option>
						<option value="2014">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						</select>

						<div class="help-block"></div>
						</div>
				</div>
				
		</div>
	  </div>
	  <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('cancel', ['class-subject/index'], ['class' => 'btn btn-default']) ?>
    </div>
	</div>


    

    <?php ActiveForm::end(); ?>

</div>
