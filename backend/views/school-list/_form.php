<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SchoolList;
/* @var $this yii\web\View */
/* @var $model backend\models\SchoolList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-list-form">
<?php 
$meteo = ['' => 'Please Select', '10' => 'Active', '0' => 'Inactive'];
?>
    <?php $form = ActiveForm::begin([
			    'id' => 'form-terms',
				'options' => ['enctype' => 'multipart/form-data'],
				'enableAjaxValidation' => true,
				'enableClientValidation' => true,
			]); ?>
	
	<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">School Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					  <?= $form->field($model, 'school_name',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-bank"></i></div>{input}</div>{hint}{error}'
                    ])->textinput() ?>
				</div>
				
				<div class="form-group">
					 <?= $form->field($model, 'school_location',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-map-marker"></i></div>{input}</div>{hint}{error}'
                    ])->textinput() ?>
				</div>
				
				<div class="form-group">
					<?= $form->field($model, 'number_of_student',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-group"></i></div>{input}</div>{hint}{error}'
                    ])->textinput() ?>
				</div>
				<div class="form-group">
				 
					<?= $form->field($model, 'phone_number',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-phone"></i></div>{input}</div>{hint}{error}'
                    ])->textinput() ?>
				</div>
				
				<?php
						if(isset($_GET['id'])){
							$mid = $_GET['id'];
							?> 
							
							<?php
							$mypicture = SchoolList::find()->select(['school_logo'])->where(['id'=>$mid])->one();
							if ($mypicture->school_logo != ''){
								echo Html::img(Yii::getAlias('@base').'/uploads/'.$mypicture->school_logo,['width' => '120px' , 'id' => 'my_mix']); ?>
							
								<a href="#" class="my_mix_2" style="font-size:25px;" id='dele_img'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								
							<div class="form-group mydelete_imaging">
								  <?= $form->field($model, 'school_logo')->fileInput() ?>
							</div>
						<?php	}
						
							else{ ?>
								<div class="form-group">
					  <?= $form->field($model, 'school_logo')->fileInput() ?>
					  <span style="font-size : 11px;"> Max Image size 10MB.</span>
				</div>
						<?php 	}
							
							
						} else {
				
				?>	<div class="form-group">
					  <?= $form->field($model, 'school_logo')->fileInput() ?>
					  <span style="font-size : 11px;"> Max Image size 10MB.</span>
					</div>
				
				
						<?php } ?>
						<div class="form-group">
					 <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
					 <span style="font-size : 11px;"> Max Image size 10MB.</span>
				</div>
			  </div>
	      </div>
</div>
<div class="col-md-6">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Portal Information</h3>
            </div>
              <div class="box-body">
				<div class="form-group">
					<?= $form->field($model_second, 'email',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-envelope"></i></div>{input}</div>{hint}{error}'
                    ])->textInput(['maxlength' => true,'class' => 'form-control']) ?>
				</div>
				<?php if(isset($model->id)){ ?>
				<div class="hiden_pass_shown" ><b>Password : </b><?php echo "   ".$model_second->hidden_password; ?></div>
				<?php } ?>
				<div class="form-group">
				<button type="button" id="new_gen_pas" class="btn btn-block btn-warning hrfpnt">Generate Password</button>
				<button type="button" id="new_gen_pas_upd" class="btn btn-block btn-warning hrfpnt">ReGenerate Password</button>
				</div>
				<div class="form-group spaning_passsd">
				<span>Please generate Password Here!</span>
				</div>
				
				<div class="form-group passing_quote">
				<label>Password</label>
				<table class="table table-bordered"><tbody><tr>
				<td class="hlf_width"><p id="showing_pass_main_twoo">**********</p><p id="showing_pass_main"></p> </td>
				<td class="hlf_width"><button type="button" id="myclicking_fr_show" class="btn btn-default hlf_width_float"><i  class="fa fa-check-circle" aria-hidden="true"></i> Show</button>
				<button type="button" id="myclicking_fr_copy" class="btn  btn-default hlf_width_float"><i  class="fa fa-files-o" aria-hidden="true"></i> Copy</button> </td>
				</tr></tbody></table>
				 
				</div>
				
				<div class="form-group main_pass">
					<?= $form->field($model_second, 'password',[
                        'template' => '<label> Password </label><div class="input-group"><div class="input-group-addon"><i class="fa fa-lock"></i></div>{input}</div>{hint}{error}'
                    ])->passwordInput() ?>
				</div> 
				<div class="form-group show_check">
				<?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password', 'label' => 'Show Password']); ?>
				</div>
				<div class="form-group hide_confirm">
					 <?= $form->field($model_second, 'password_repeat',[
                        'template' => '<label> Confirm Password </label><div class="input-group"><div class="input-group-addon"><i class="fa fa-lock"></i></div>{input}</div>{hint}{error}'
                    ])->passwordInput() ?>
				</div>
				<div class="form-group">
				<?= $form->field($model_second, 'hidden_password')->hiddenInput(['value'=>''])->label(false); ?> 
				</div>
				
			  </div>
		  </div>
		  
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Principal Information</h3>
            </div>
              <div class="box-body">
				<div class="form-group">
					<?= $form->field($model, 'first_name',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->textInput(['maxlength' => true,'class' => 'form-control']) ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'last_name',[
                        'template' => '<label> Last Name </label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div> 
				
				<?php
					if(isset($model->id) && !empty($model->image)){
						echo Html::img(Yii::getAlias('@base').'/uploads/'.$model->image,['width' => '120px' , 'id' => 'my_mix_second']); 
						?>
					<a href="#" class="my_mix_two" style="font-size:25px;" id='dele_img_prince'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								
							<div class="form-group mydelete_imaging_princ">
								  <?= $form->field($model, 'image')->fileInput() ?>
								  <span style="font-size : 11px;"> Max Image size 10MB.</span>
							</div>
				<?php	} else {	?>
				<div class="form-group">
					  <?= $form->field($model, 'image')->fileInput() ?>
					  <span style="font-size : 11px;"> Max Image size 10MB.</span>
				</div>
				<?php } ?>
			  </div>
		  </div>
</div>
<div class="row">
<div class="col-md-6 ">
	
</div>
</div>


<div class="col-md-6 mar-left-non">
	  <div class="box box-danger"> 
            <div class="box-header with-border">
              <h3 class="box-title">Status</h3>
            </div>
              <div class="box-body">
				<div class="form-group">
					<?= $form->field($model, 'status',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteo) ?>
				</div>
				
				
				
			  </div>
		  </div>
</div>

<div class="row">
<div class="col-md-6 ">
	 
</div>
</div>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'school_sub']) ?>
			<?= Html::a('Cancel', ['school-list/index'], ['class' => 'btn btn-default']) ?>
		</div>
	

    <?php ActiveForm::end(); ?>

</div>
