<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SchoolList;
use budyaga\cropper\Widget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SchoolList */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'School Profile';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="school-list-form">
<?php 
$meteo = ['' => 'Please Select', '1' => 'Active', '0' => 'InActive'];
?>
    <?php $form = ActiveForm::begin(); ?>
	
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
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-group"></i></div>{input}</div>{hint}{error}'
                    ])->textinput() ?>
				</div>
				
				
				<?php
						if(isset($model->id)){
							$mid = $model->id;
							?> 
							
							<?php
							$mypicture = SchoolList::find()->select(['school_logo'])->where(['id'=>$mid])->one();
							if ($mypicture['school_logo'] != ''){
								echo Html::img(Yii::getAlias('@base').'/uploads/'.$mypicture['school_logo'],['width' => '120px' , 'id' => 'my_mix']); ?>
							
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
							
							
						} ?>
				
				<div class="form-group">
					 <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
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
					<label>Email</label>
					<p><?= $model_second->email; ?></p>
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
				<?php	} else {	?>
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
				<?php } ?>
				
			  </div>
		  </div>
</div>
<div class="row">
<div class="col-md-6 ">
	
</div>
</div>



		<div class="form-group">
			<?= Html::submitButton('Update', ['class' => 'btn btn-success btn btn-primary'])?>
			<?= Html::a('Cancel', ['adduser/index'], ['class' => 'btn btn-default']) ?>
		</div>
	

    <?php ActiveForm::end(); ?>

</div>


<?php 
 

$this->registerJsFile(''.Yii::getAlias('@base').'/js/imagecropin.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$mids = $model->id; 
$this->registerJs("
jQuery('.mydelete_imaging_princ').hide();
jQuery('.mydelete_imaging').hide();
jQuery('#dele_img').click(function(){
		$.ajax({
		type :'POST',
        data: {id:". $mids ." },
        url:'".Yii::getAlias('@base')."/school-list/deleteimage',
        success: function(response){
            console.log(response); 
				jQuery('.mydelete_imaging').show();
				jQuery('#my_mix').hide(); jQuery('.my_mix_2').hide();
        }
    });
	 
	})");
	
	$this->registerJs("jQuery('#dele_img_prince').click(function(){
		$.ajax({
		type :'POST',
        data: {id:". $mids ." },
        url:'".Yii::getAlias('@base')."/school-list/deleteimageprinc',
        success: function(response){
			window.location.reload();
          /*   console.log(response); 
				jQuery('.mydelete_imaging_princ').show();
				jQuery('#my_mix_second').hide(); jQuery('.my_mix_two').hide(); */
        }
    });
	
	})");
?>