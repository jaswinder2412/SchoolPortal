<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AddStudent;
use backend\models\AcedemicYear;
use backend\models\ClassInfo;
use backend\models\ClassStudent;
use backend\models\AddClass;
use backend\models\Section;
/* @var $this yii\web\View */
/* @var $model backend\models\AddStudent */
/* @var $form yii\widgets\ActiveForm */

use budyaga\cropper\Widget;
use yii\helpers\Url;
?>

<div class="new-user-form">
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
	
	 if (Yii::$app->user->identity->role_id == 1) {
			$newscholingds = Yii::$app->user->getId();
		} else { 
			$newscholingds = Yii::$app->user->identity->school_id;
		}
		$academicyeargeting = $getacadid;
		$scholorid = $newscholingds;
	$class_counting = ClassInfo::find()->where(['=','school_id',$scholorid])->andwhere(['=','academic_year',$academicyeargeting])->count();
	
	if(isset($model->id)){
		
		$student_isd = $model->user_id;
		
		
		$getpresecnt_class = ClassStudent::find()->where(['student_id'=>$student_isd])->andwhere(['=','Academic_year_id',$academicyeargeting])->andwhere(['=','school_id',$scholorid])->one();
		
		$getclsdnmr = ClassInfo::find()->where(['=','id',$getpresecnt_class['class_id']])->andwhere(['=','school_id',$scholorid])->andwhere(['=','academic_year',$academicyeargeting])->one();
		
	
		
		$class_nams = $getclsdnmr['class_name'];
		$class_sectonsd = $getclsdnmr['class_section'];
		
		$sectionprinting = array();		
		$getingsection_new = ClassInfo::find()->where(['class_name'=>$class_nams])->andwhere(['=','academic_year',$academicyeargeting])->groupBy(['class_section'])->all(); 
		
		foreach($getingsection_new as $sectionwisendr) {
			$getsections_namea = Section::find()->where(['id'=>$sectionwisendr->class_section])->one();
			$sectionprinting[$getsections_namea['id']] = $getsections_namea['section_name'];
			
		}
		
	}
	
	$meteobg = ['' => 'Please Select', 'A+' => 'A+', 'O+' => 'O+', 'B+' => 'B+','AB+' => 'AB+', 'A-' => 'A-', 'O-' => 'O-', 'B-' => 'B-', 'AB-' => 'AB-'];
	$stuer = ['' => 'Please Select', '10' => 'Active', '0' => 'Inactive'];

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
					<?= $form->field($model, 'first_name',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'last_name',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'dob',[
                        'template' => '{label}<div class="input-group whiteback"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textInput(['readOnly'=> true]) ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'gender')->radioList(array('0'=>'Male','1'=>'Female'));  ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'blood_group',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-heartbeat"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($meteobg) ?>
				</div>
				<?php
				
						if(isset($model->id)){
							$mid = $model->id;
							?> 
							
							<?php
							$mypicture = AddStudent::find()->select(['image'])->where(['id'=>$mid])->one();
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
						} else { ?>	
								<div class="form-group">
									<?= $form->field($model, 'image')->fileInput() ?>
									<span style="font-size : 11px;"> Max Image size 10MB.</span>
								</div>				
						<?php } ?>
				
			  </div>
		  </div>
		  		<div class="row"></div>
<div class="box box-success">
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
		  
		  		  <div class="row">
			
		</div>
		    <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Status</h3>
            </div>
              <div class="box-body">
				<div class="form-group">
					<?= $form->field($model, 'status',[
                        'template' => '<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($stuer) ?>
				</div>
			  </div>
		  </div>
		  
		</div>
		<div class="col-md-6">
        
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Family Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					<?= $form->field($model, 'father_name',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'mother_name',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'father_ph_no',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-phone"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					 <?= $form->field($model, 'mother_phone_no',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-phone"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					<?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
				</div>
				
			  </div>
		  </div>
		  <div class="row">
			
		</div>
		<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Academic Information</h3>
			 
            </div>
              <div class="box-body">
				<div class="form-group">
					<?= $form->field($model, 'admission_number',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<?php 
					if($class_counting == '0'){
						$mitroklerschand = 'style="display : none;"';
					} else {						
						$mitroklerschand = '';
					}
				?>
				<div class="addition_clsdd" <?php echo $mitroklerschand; ?>>
				
					<div class="col-md-6">
					<?php if(!isset($model->id)){ ?>
						<div class="form-group">
							<?= $form->field($model_thirds, 'class_id',[
								'template' => '<label>Class</label>{input}{hint}{error}'
							])->dropDownList($meteo,['prompt'=>'Please Select']) ?>
						</div>
					<?php } else{ ?>
						<div class="form-group field-classassignedstudent-class_id ">
						<label>Class</label>
						<select id="classassignedstudent-class_id" class="form-control" name="ClassAssignedStudent[class_id]" aria-invalid="false">
						<option value="">Please Select</option>
						<?php foreach($meteo as $key=> $mikleter){
							if($class_nams == $key){
								$mitronslar = "selected='selected'";
							}else{
								$mitronslar = "";
							}
							echo "<option value='".$key."' ".$mitronslar.">".$mikleter."</option>";
						}  ?>
						</select><div class="help-block"></div>
						</div>
					<?php } ?>
					</div>
					<div class="col-md-6">
					<?php if(!isset($model->id)){ ?>
						<div class="form-group">
							<?= $form->field($model_thirds, 'section_id',[
								'template' => '<label>Section</label>{input}{hint}{error}'
							])->dropDownList($meteo,['prompt'=>'Please Select','disabled'=>'disabled']) ?>
						</div>
					<?php } else { ?>
					<div class="form-group field-classassignedstudent-section_id">
						<label>Section</label>
						<select id="classassignedstudent-section_id" class="form-control" name="ClassAssignedStudent[section_id]" >
							<option value="">Please Select</option>
							<?php foreach($sectionprinting as $key => $mikleters){
							if($class_sectonsd == $key){
								$mitronslars = "selected='selected'";
							}else{
								$mitronslars = "";
							}
							echo "<option value='".$key."' ".$mitronslars.">".$mikleters."</option>";
						}  ?>
						</select>
						<div class="help-block-secton" style="color : red;">Please select Section.</div>
					</div>	
						
					<?php } ?>
					</div>
				</div>
			  </div>
		  </div> 

		  
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
        <?= Html::a('Cancel', ['adduser/index'], ['class' => 'btn btn-default']) ?>
		</span>
			</div>
	</div>
		<?php } ?>
    <?php ActiveForm::end(); ?>

</div>
<?php

$this->registerJsFile(''.Yii::getAlias('@base').'/js/imagecropin.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
 ?>