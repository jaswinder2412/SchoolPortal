<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\newStaffdata;
use backend\models\AcedemicYear;
use backend\models\AnnouncementsTeacher;
use common\models\User;
use backend\models\AnouncementTeachersUserids;
use budyaga\cropper\Widget;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Staff */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->title = 'My Profile'  ;
$this->params['breadcrumbs'][] = 'Vice Principal Profile';
$mids = $model->id;
?>

<div class="staff-form">
 <?php  if((Yii::$app->user->identity->role_id == '5') || (Yii::$app->user->identity->role_id == '3')){ 

	$announcingms = AnnouncementsTeacher::find()->where(['status'=>1])->andwhere(['school_id'=>Yii::$app->user->identity->school_id])->all();
		foreach($announcingms as $ancmnts){
			
			$myanounces = AnouncementTeachersUserids::find()->where(['=','announcement_id',$ancmnts->id])->andwhere(['=','teacher_id',Yii::$app->user->getId()])->andwhere(['=','seen',0])->count();
		
		if($myanounces > 0){
			?>
		<div id="w1-warning" class="alert-warning alert fade in">
			<button type="button" rel="<?php echo $ancmnts->id; ?>" class="close" data-dismiss="alert" aria-hidden="true" id="mybuttons">x</button>

			<i class="icon fa fa-circle-o"></i><?php echo ucfirst($ancmnts->anouncement_title) ."."; ?>
			<br/>
			<span style="font-size : 12px;"><?php echo ucfirst($ancmnts->anouncement_description) ."."; ?></span>
		</div>
	<?php	}
		}
 } ?> 
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
				
				$meteo = ['' => 'Please Select', '2' => 'Vice Principal', '3' => 'Co-ordinators', '4' => 'Office staff', '5' => 'Teachers'];
				
				$meteo3 = ['' => 'Please Select', 'James' => 'James', 'Steve' => 'Steve', 'Henry' => 'Henry',  'Patrick' => 'Patrick', 'Reo' => 'Reo', ];
				
            ?>
    <?php $form = ActiveForm::begin(
			[
			    'id' => 'form-terms',
				'options' => ['enctype' => 'multipart/form-data'],
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
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
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
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
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
								    <?= $form->field($model, 'image')->widget(Widget::className(), [
							  'maxSize' => 10485760,
								'uploadUrl' => Url::toRoute('/site/uploadPhoto'),
								'cropAreaWidth' => 150,
								'cropAreaHeight' => 150,
								'width' => 2400,
								'height' => 2400,
							]) ?>
								  <span style="font-size : 11px;"> Max Image size 10MB.</span>
							</div>
						<?php	}
						
							else{ ?>
								<div class="form-group">
								<?= $form->field($model, 'image')->widget(Widget::className(), [
							  'maxSize' => 10485760,
								'uploadUrl' => Url::toRoute('/site/uploadPhoto'),
								'cropAreaWidth' => 150,
								'cropAreaHeight' => 150,
								'width' => 2400,
								'height' => 2400,
							]) ?>
								  <span style="font-size : 11px;"> Max Image size 10MB.</span>
								</div>
						<?php 	}
							
							
						} else {
				
				?>		<div class="form-group">
							    <?= $form->field($model, 'image')->widget(Widget::className(), [
							  'maxSize' => 10485760,
								'uploadUrl' => Url::toRoute('/site/uploadPhoto'),
								'cropAreaWidth' => 150,
								'cropAreaHeight' => 150,
								'width' => 2400,
								'height' => 2400,
							]) ?>
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
				<label>Designation</label><p>
					<?php 
					if($model_second->role_id == '2'){
						echo "Vice Principal";
					} else if($model_second->role_id == '3'){
						echo "Co-ordinator";
					} 
					else if($model_second->role_id == '4'){
						echo "Office Staff";
					} 
					else if($model_second->role_id == '5'){
						echo "Teacher";
					} 
					
					?></p>
				</div>
				
				
			</div>
		   </div>
		  <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Portal Information</h3>
            </div>
              <div class="box-body">
			  <label>Email</label>
				
				<div class="form-group">
					<p><?= $model_second->email; ?></p>
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
        <?= Html::submitButton('Update', ['class' => 'btn btn-success btn btn-primary'])?>
		<span class="cancel_btn">
        <?= Html::a('Cancel', ['site/index'], ['class' => 'btn btn-default']) ?>
		</span>
   </div>
</div>
		<?php } ?>
    <?php ActiveForm::end(); ?>
	
</div>
<?php

 $this->registerJs("
$('#mybuttons').click(function(){
	var rel = $(this).attr('rel');
	
	
	$.ajax({
				type :'POST',
				data: {announceid: rel},
				url:'".Yii::getAlias('@base')."/anouncements/announcement_seen',
				success: function(response){
					
					console.log(response);
					
					}
	});
	
});
  
");

$this->registerJs("  $( function() {
    $( '#newstaffdata-dob' ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,
            changeYear: true, });
  } );
  
");

$this->registerJs("  $( function() {
    $( '#newstaffdata-date_of_joining' ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,
            changeYear: true, });
  } );
  
");

$this->registerJsFile(''.Yii::getAlias('@base').'/js/imagecropin.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);


$this->registerJs("
jQuery('.hide_confirm').hide();
jQuery('.main_pass').hide();
jQuery('.show_check').hide();
jQuery('.spaning_passsd').hide();
jQuery('.passing_quote').hide();
jQuery('#showing_pass_main').hide();
jQuery('#new_gen_pas').hide();
jQuery('.mydelete_imaging').hide();
jQuery('.cordi_requ').hide();

jQuery('#new_gen_pas_upd').click(function(){
	var xis = Math.floor((Math.random() * 11223123) + 1123123);
	jQuery('#usercustom-password').val('PTP'+xis);
	jQuery('#usercustom-password_repeat').val('PTP'+xis);
	jQuery('#showing_pass_main').text('PTP'+xis);
	
	jQuery('.passing_quote').show();
	});
	
jQuery('#myclicking_fr_show').click(function(){
	jQuery('#showing_pass_main_twoo').hide();
	jQuery('#showing_pass_main').show();
	});
	
	jQuery('#myclicking_fr_copy').click(function() {
		var vpl = jQuery('#showing_pass_main').text();
  var temp = jQuery('<input>');
  $('body').append(temp);
  temp.val(vpl).select();
  document.execCommand('copy');
  temp.remove();
  
  if (window.getSelection && document.createRange) {
        // IE 9 and non-IE
        var range = document.createRange();
        range.selectNodeContents(document.getElementById('showing_pass_main'));
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    } else if (document.body.createTextRange) {
        // IE < 9
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(document.getElementById('showing_pass_main'));
        textRange.select();
    }
  
});
var get_tecsh_val = jQuery('#usercustom-role_id').val();
		if(get_tecsh_val == '5'){
			jQuery('.mycordinator').show();	
		} else {
			jQuery('.mycordinator').hide();
		}

	jQuery('#usercustom-role_id').change(function(){
		var get_tech_val = jQuery('#usercustom-role_id').val();
		if(get_tech_val == '5'){
			jQuery('.mycordinator').show();	
		} else {
			jQuery('.mycordinator').hide();
		}
	});
	
	
	
	jQuery('#school_sub').click(function(e){
		
		
		var jkuer = $('#usercustom-role_id').val();
		var cdgntr = $('#newstaffdata-co_ordinator_id').val();
		
		if(jkuer == '5' && cdgntr == ''){
			
			$('.field-newstaffdata-co_ordinator_id').removeClass('has-success');
			jQuery('.cordi_requ').show();
			e.preventDefault();
			return false;
		}else{
			jQuery('.cordi_requ').hide();
		}
	});
	");

$this->registerJs("jQuery('#reveal-password').change(function(){
	
	jQuery('#usercustom-password').attr('type',this.checked?'text':'password');
	jQuery('#usercustom-password_repeat').attr('type',this.checked?'text':'password');
	
	})");

	$this->registerJs("jQuery('#dele_img').click(function(){
		$.ajax({
		type :'POST',
        data: {id:". $mids ." },
        url:'".Yii::getAlias('@base')."/staff/deleteimage',
        success: function(response){
			window.location.reload();
            /* console.log(response); 
				jQuery('.mydelete_imaging').show();
				jQuery('#my_mix').hide(); jQuery('.my_mix_2').hide(); */
        }
    });
	
	})");

	

?> 