<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\newStaffdata;
use backend\models\AcedemicYear;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model backend\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">
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
				$mateods = array();
				if(isset($model->id)){
					if(Yii::$app->user->identity->role_id == 1){
						$myroling = User::find()->where(['role_id'=> '3'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['!=', 'id', $model->id])->all();
					}else{
						$myroling = User::find()->where(['role_id'=> '3'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['!=', 'id', $model->id])->all();
					}
					
	
				foreach ($myroling as $rolig){
					$rol_ids = $rolig->id;
					$myrolinsdsg = newStaffdata::find()->where(['user_id'=> $rol_ids])->one();
					$gtrids = $myrolinsdsg['user_id'];
					$mateods[$gtrids] = $myrolinsdsg['fname'];
				}
				}else{
					if(Yii::$app->user->identity->role_id == 1){
						$myroling = User::find()->where(['role_id'=> '3'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
					}else{
						$myroling = User::find()->where(['role_id'=> '3'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
					}
					
				foreach ($myroling as $rolig){
					$rol_ids = $rolig->id;
					$myrolinsdsg = newStaffdata::find()->where(['user_id'=> $rol_ids])->one();
					$gtrids = $myrolinsdsg['user_id'];
					$mateods[$gtrids] = $myrolinsdsg['fname'];
				}
				}
				
				
				$meteobg = ['' => 'Please Select', 'A+' => 'A+', 'O+' => 'O+', 'B+' => 'B+','AB+' => 'AB+', 'A-' => 'A-', 'O-' => 'O-', 'B-' => 'B-', 'AB-' => 'AB-'];
				
				$stuer = ['' => 'Please Select', '10' => 'Active', '0' => 'Inactive'];
				if(Yii::$app->user->identity->role_id == 2){
					$meteo = ['' => 'Please Select', '3' => 'Co-ordinators', '4' => 'Office staff', '5' => 'Teachers'];
				
				}else if (Yii::$app->user->identity->role_id == 3){
					$meteo = ['' => 'Please Select', '5' => 'Teachers'];
				}
				else if (Yii::$app->user->identity->role_id == 4){
					$meteo = ['' => 'Please Select', '5' => 'Teachers'];
				}
				else{
					$meteo = ['' => 'Please Select', '2' => 'Vice Principal', '3' => 'Co-ordinators', '4' => 'Office staff', '5' => 'Teachers'];
				}
				
				$meteo3 = ['' => 'Please Select', 'James' => 'James', 'Steve' => 'Steve', 'Henry' => 'Henry',  'Patrick' => 'Patrick', 'Reo' => 'Reo', ];
				
            ?>
    <?php $form = ActiveForm::begin(
			[
			    'id' => 'form-terms',
				'options' => ['enctype' => 'multipart/form-data'],
				'enableAjaxValidation' => true,
				'enableClientValidation' => true,
			]); 
	?>
		<?php if(empty($acadyears)){ ?>
		<div id="w1-error" class="alert-error alert fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-time"></i>Please add active Academic Year.</div>
	<?php	} ?>
	<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					<?= $form->field($model, 'fname',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'lname',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div> 
				<div class="form-group">
					<?= $form->field($model, 'dob',[
                        'template' => '{label}<div class="input-group whiteback"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textInput(['readOnly'=> true]) ?>
				</div>
				
				<div class="form-group">
					<?= $form->field($model, 'gender',[
                        'template' => '{label}<div class="input-group">{input}</div>{hint}{error}'
                    ])->radioList(array('0'=>'Male','1'=>'Female'),['class'=>'minimal']);  ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'qualification',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				
				<div class="form-group">
					<?= $form->field($model, 'date_of_joining',[
                        'template' => '{label}<div class="input-group whiteback"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textInput(['readOnly'=> true]) ?>
				</div>
				
				<div class="form-group">
					<?= $form->field($model, 'phone_number',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-phone"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				
				<div class="form-group">
					<?= $form->field($model, 'blood_group',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-tint"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteobg) ?>
				</div>
				
				<div class="form-group">
					<?= $form->field($model, 'emergency_contact',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-phone"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				
				<div class="form-group">
					<?= $form->field($model, 'specializatin',[
                        'template' => '<label>Specialization</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'address')->textarea(['rows' => '2']) ?>
				</div>
				
					
				<?php
				
						if(isset($model->id)){
							$mid = $model->id;
							?> 
							
							<?php
							$mypicture = newStaffdata::find()->select(['image'])->where(['id'=>$mid])->one();
							if ($mypicture->image != ''){
								echo Html::img(Yii::getAlias('@base').'/uploads/'.$mypicture->image,['width' => '120px' , 'id' => 'my_mix']); ?>
							
								<a href="#" class="my_mix_2" style="font-size:25px;" id='dele_img'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								
									<div class="form-group mydelete_imaging">
								  <?= $form->field($model, 'image')->fileInput() ?>
								  <span style="font-size : 11px;"> Max Image size 10MB.</span>
							</div>
						<?php	}
						
							else{ ?>
								<div class="form-group">
					  <?= $form->field($model, 'image')->fileInput() ?>
					  <span style="font-size : 11px;"> Max Image size 10MB.</span>
				</div>
						<?php 	}
							
							
						} else {
				
				?>		<div class="form-group">
					  <?= $form->field($model, 'image')->fileInput() ?>
					  <span style="font-size : 11px;"> Max Image size 10MB.</span>
				</div>
				
				
						<?php } ?>
						
		</div>
	  </div>
	</div>
	<div class="col-md-6 ">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Management Role</h3>
            </div>
			<div class="box-body">
				<div class="form-group">
					<?= $form->field($model_second, 'role_id',[
                        'template' => '<label>Designation</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteo) ?>
				</div>
				<div class="form-group mycordinator">
					<?= $form->field($model, 'co_ordinator_id',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($mateods,['prompt'=>'Please Select']) ?>
				<span class="cordi_requ" style="color : red;"> Co-Ordinator is required. </span>
				</div>
				
			</div>
		   </div>
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
				
			  </div>
		  </div>
		
	  <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Status</h3>
            </div>
              <div class="box-body">
				<div class="form-group">
					<?= $form->field($model, 'status',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($stuer) ?>
				</div>
				
				
				
			  </div>
		  </div>

	</div>
	<div class="row">
    <div class="col-md-6 ">
        
   </div>
</div>
<div class="col-md-6 mar-left-non">
        
		</div>
<div class="row">
    <div class="col-md-6 ">
        
   </div>
</div>
		<?php if(!empty($acadyears)){ ?>
<div class="row">
    <div class="col-md-6 ">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id' => 'school_sub']) ?>
		<span class="cancel_btn">
        <?= Html::a('Cancel', ['staff/index'], ['class' => 'btn btn-default']) ?>
		</span>
   </div>
</div>
		<?php } ?>
    <?php ActiveForm::end(); ?>
	
</div>
