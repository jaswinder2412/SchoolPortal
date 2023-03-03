<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AddStudent;
use backend\models\AcedemicYear;
use budyaga\cropper\Widget;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\AddStudent */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->title = 'Edit Profile';
$this->params['breadcrumbs'][] = ['label' => 'New Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-user-create">
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
	$meteo = ['' => 'Please Select', 'Pre-Nursery' => 'Pre-Nursery', 'Nursery' => 'Nursery', 'L.K.G' => 'L.K.G', 'U.K.G' => 'U.K.G', 'First' => 'First', 'Second' => 'Second', 'Third' => 'Third', 'Fourth' => 'Fourth', 'Fifth' => 'Fifth', 'Sixth' => 'Sixth']; 
	$meteo2 = ['' => 'Please Select', '2001' => '2001', '2002' => '2002', '2003' => '2003','2004' => '2004', '2005' => '2005', '2006' => '2006', '2007' => '2007', '2008' => '2008', '2009' => '2009','2010' => '2010', '2011' => '2011', '2012' => '2012', '2013' => '2013', '2014' => '2015', '2016' => '2016','2017' => '2017'];
	$meteobg = ['' => 'Please Select', 'A+' => 'A+', 'O+' => 'O+', 'B+' => 'B+','AB+' => 'AB+', 'A-' => 'A-', 'O-' => 'O-', 'B-' => 'B-', 'AB-' => 'AB-'];
	$stuer = ['' => 'Please Select', '10' => 'Active', '0' => 'Inactive'];

?>


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	
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
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
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
				
				?>			<div class="form-group">
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
		  	<div class="row"></div>
			  <div class="box box-success">
				<div class="box-header with-border">
              <h3 class="box-title">Portal Information</h3>
            </div>
              <div class="box-body">
				<div class="form-group">
				<label>Email</label>
					<?= $model_second->email; ?>
					
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
		  	<div class="row"></div>
		  <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Academic Information</h3>
			 
            </div>
              <div class="box-body">
				<div class="form-group">
									
					<label> Admission Number </label>
					<p><?php echo $model->admission_number; ?></p>
				</div>
				<div class="addition_clsdd"></div>
			  </div>
		  </div>
		</div>
		
			 
			<div class="row"></div>
		<?php if(!empty($acadyears)){ ?>
<div class="row">
    <div class="col-md-6 ">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id' => 'school_sub']) ?>
			<span class="cancel_btn">
			<?php $newurl = 'adduser/myprofile/'.$model->id; ?>
        <?= Html::a('Cancel', [$newurl], ['class' => 'btn btn-default']) ?>
		</span>
			</div>
	</div>
		<?php } ?>
    <?php ActiveForm::end(); ?>

</div>
</div>
<?php
 $mids = $model->id;
$this->registerJs("  $( function() {
    $( '#addstudent-dob' ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,
            changeYear: true, });
  } );
  
");

$this->registerJs("  $( function() {
    $( '#newstaffdata-date_of_joining' ).datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,
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


jQuery('#new_gen_pas_upd').click(function(){
	var xis = Math.floor((Math.random() * 11223123) + 1123123);
	jQuery('#usercustom-password').val('STUD'+xis);
	jQuery('#usercustom-password_repeat').val('STUD'+xis);
	jQuery('#showing_pass_main').text('STUD'+xis);
	
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
	");

$this->registerJs("jQuery('#reveal-password').change(function(){
	
	jQuery('#usercustom-password').attr('type',this.checked?'text':'password');
	jQuery('#usercustom-password_repeat').attr('type',this.checked?'text':'password');
	
	})");

	$this->registerJs("jQuery('#dele_img').click(function(){
		$.ajax({
		type :'POST',
        data: {id:". $mids ." },
        url:'".Yii::getAlias('@base')."/adduser/deleteimage',
        success: function(response){
			window.location.reload();
           /*  console.log(response); 
				jQuery('.mydelete_imaging').show();
				jQuery('#my_mix').hide(); jQuery('.my_mix_2').hide(); */
        }
    });
	
	})");

	

?>

