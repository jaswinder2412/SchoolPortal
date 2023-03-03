<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ClassInfo;
use backend\models\AcedemicYear;
use backend\models\Section;
use backend\models\AddClass;
/* @var $this yii\web\View */
/* @var $model backend\models\Exam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-form">
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
	
	$setcion = array();
	if (Yii::$app->user->identity->role_id == 1) {
        $secting = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->andWhere(['=', 'academic_year', $getacadid])->all();
    } else { 
        $secting = ClassInfo::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->andWhere(['=', 'academic_year', $getacadid])->all();
    }

    foreach ($secting as $sections) {
        $section_id = $sections->id;
		$stcn_nam = $sections->class_section;
		$getnameofsection = Section::find()->Where(['=', 'id', $stcn_nam])->one();
        $section_name = $getnameofsection['section_name'];
		$mysect_id = $getnameofsection['id'];
        $setcion[$mysect_id] = $section_name;
    }
	
	

?>
    <?php $form = ActiveForm::begin(); 
	if(empty($acadyears)){ ?>
		<div id="w1-error" class="alert-error alert fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-time"></i>Please add active Academic Year.</div>
	<?php	} ?>
	<div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Exam Information</h3>
            </div>
           
            
              <div class="box-body">
				<div class="form-group">
					  <?= $form->field($model, 'exam_name',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					  <?= $form->field($model, 'exam_date',[
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calender"></i></div>{input}</div>{hint}{error}'
                    ])->textInput() ?>
				</div>
				<div class="form-group">
					    <?=
                    $form->field($model, 'academic_year', [
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($acadyears,['readonly' => true])
                    ?>
				</div>

				<div class="form-group">
					<?= $form->field($model, 'marks')->radioList(array('0'=>'In Marks','1'=>'In Grades'));  ?>
				</div>
			  </div>
	      </div>
	</div> 
	<div class="col-md-6">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Class Information</h3>
			  <button type="button" class="btn btn-info btn-sm pull-right" id="adding_exms">Add More</button>
            </div>
           
            
              <div class="box-body">
				
				<?php if(isset($model->id)){ 
				$i = 0;
				foreach ($model_second as $tchds) {
					$class_selection = $tchds->class_id;
					$geasdffgtsd = ClassInfo::find()->Where(['=', 'id', $class_selection])->one();
					$section_selection = $tchds->section_id;
				?>
				<div class="examine chek_examine">
					<div class="apsnd_class">
						<div class="col-md-6 first">
							<div class="form-group">
								<div class="form-group_first field-examclass-class_id">
									<label class="control-label" for="examclass-class_id">Class </label>
									<select id="examclass-class_id_<?php echo $i; ?>" class="form-control" name="ExamClass[class_id][]">
										<option value="">Please Select</option>
									<?php
													foreach ($meteo as $key => $val) {
														 if ($key == $geasdffgtsd['class_name']) {
															$check = "selected='selected'";
														} else {
															$check = '';
														} 
														echo "<option value='" . $key . "' ".$check.">" . $val . "</option>";
													}
									?>  
									</select>
									<div class="help-block_first"></div>
								</div>
							</div>
						</div>
						<div class="col-md-6 second">
							<div class="form-group">
								<div class="form-group_second field-examclass-section_id">
									<label class="control-label" for="examclass-section_id">Section</label>
										<select id="examclass-section_id_<?php echo $i; ?>" class="form-control" name="ExamClass[section_id][]" readonly="true">
										<option value="">Please Select</option>
										<?php
													foreach ($setcion as $key => $val) {
														 if ($key == $section_selection) {
															$check = "selected='selected'";
														} else {
															$check = '';
														} 
														echo "<option value='" . $key . "'".$check.">" . $val . "</option>";
													} 
										?> 
										</select>

									<div class="help-block_second"></div>
								</div>
							</div>
							<a class="maxing pull-right"  id="max_<?php echo $tchds->id; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
						</div>
					</div>
					
				</div>
				
				<?php $i++; } 
					} else { ?>
				<div class="examine">
					<div class="apsnd_class">
						<div class="col-md-6">
							<div class="form-group">
								<?= $form->field($model_second, 'class_id[]',[
                        'template' => '<label>Class</label>{input}{hint}{error}'
                    ])->dropdownList($meteo,['prompt' => 'Please Select']); ?>
							</div>
						</div>
						<div class="col-md-6">
							
							<div class="form-group">
				<?= $form->field($model_second, 'section_id[]',['template' => '<label>Section</label>{input}{hint}{error}'])->dropdownList($setcion,['prompt' => 'Please Select','disabled' => 'disabled']);   ?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="row"></div> 
					<div class="addition_classing">
					</div>
				</div>
	      </div>
	</div> 
	
			<div class='row front_type' style="display : none;">
			<div class="examinesd ">
					<div class="apsnd_classds">
						<div class="col-md-6">
							<div class="form-group">
								<div class="form-group field-examclass-class_id">
									<label class="control-label" for="examclass-class_id">Class </label>
									<select id="examclass-class_id_min" class="form-control" name="ExamClass[class_id][]">
									<option value=''>Please select</option>
									<?php
													foreach ($meteo as $key => $val) {
														
														echo "<option value='" . $key . "' >" . $val . "</option>";
													}
									?>  
									</select>
									<div class="help-block"></div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="form-group field-examclass-section_id">
									<label class="control-label" for="examclass-section_id">Section Id</label>
										<select id="examclass-section_idmin" class="form-control" name="ExamClass[section_id][]">
										<option value=''>Please select</option>
										<?php
													/* foreach ($setcion as $key => $val) {
														 
														echo "<option value='" . $key . "'>" . $val . "</option>";
													} */
										?> 
										</select>

									<div class="help-block"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
    <div class="row"> 
        <div class="col-md-6 ">
		<?php 
		$totalcount = '';
		if(isset($model->id)){ 
		if(!empty($model_second)){
				foreach($model_second as $contmodel) {
					$totalcount = count($contmodel) + $totalcount;
				}
			} 
		}
		?>
		<input type="hidden" value="<?php echo $totalcount; ?>" id="chechk_valuecount">
        </div>
    </div>
	<div class="row"></div>
	<div class="row"></div>
	<?php	if(!empty($acadyears)){ ?>
		<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'examclassin']) ?>		
		<?= Html::a('Cancel', ['exam/index'], ['class' => 'btn btn-default tenmarleft']) ?>
		</div>

	<?php } ?>	
	  
    <?php ActiveForm::end(); ?>

</div>
