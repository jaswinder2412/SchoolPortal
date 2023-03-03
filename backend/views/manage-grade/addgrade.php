<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ManageGrade */

$this->title = 'Add Grade';
$this->params['breadcrumbs'][] = ['label' => 'Manage Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.table td:last-child {
	min-width : 50% !important;
}
</style>
<div class="manage-grade-create">
      <div class="row">
        <div class="col-xs-12">
        

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Grade</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body"> 


    <h2>Roll Number : 2</h2>
<?php $meteo = ['' => 'Please Select', 'A+' => 'A+', 'A' => 'A',  'A-' => 'A-', 'B+' => 'B+', 'B' => 'B','B-' => 'B-','c+' => 'c+', 'c' => 'c', ]; 
$meteo1 = ['' => 'Please Select', 'Pass' => 'Pass', 'Fail' => 'Fail',];

$meteo2 = ['' => 'Please Select', '60' => '60', '50' => '50','40' => '40', '30' => '30','20' => '20', '10' => '10',]; ?>

 <?php $form = ActiveForm::begin(); ?>
    <!--p>
        <a class="btn btn-primary" href="/adminlte/frontend/web/showlist/update/3">Update Grade</a>        <a class="btn btn-danger" href="/adminlte/frontend/web/showlist/delete/3" data-confirm="Are you sure you want to delete this item?" data-method="post">Delete</a>    </p-->

<table id="w0" class="table table-striped table-bordered detail-view">
<tr><th>Image</th><td><span><img src="http://beta.brstdev.com/ptp/backend/web/images/1.png" alt=""></span></td></tr>
<tr><th>First Name</th><td>James</td></tr>
<tr><th>Last name</th><td>Salvic</td></tr>
<tr><th>Subject</th><td><b>Marks and Grades</b></td></tr>
<tr><th>English</th><td><label> Grades : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo); ?><br/>
					<label> Marks : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo2); ?>
					
					</td></tr>
<tr><th>Hindi</th><td><label> Grades : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo); ?><br/>
					<label> Marks : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo2); ?>
					
					</td></tr>
<tr><th>Mathematics</th><td><label> Grades : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo); ?><br/>
					<label> Marks : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo2); ?>
					
					</td></tr>
<tr><th>Science</th><td><label> Grades : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo); ?><br/>
					<label> Marks : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo2); ?>
					
					</td></tr>
<tr><th>Social Studies</th><td><label> Grades : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo); ?><br/>
					<label> Marks : </label><?= $form->field($model, 'grade',[
                        'template' => '<div class="input-group" style="width: 69%;"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->dropdownList($meteo2); ?>
					
					</td></tr>
</table>
</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  
  <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Update Grade' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	   <?php ActiveForm::end(); ?>
</div>