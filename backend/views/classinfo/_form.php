<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\newStaffdata;
use backend\models\AddStudent;
use backend\models\ClassStudent;
use backend\models\Subject;
use backend\models\Section;
use backend\models\AcedemicYear;
use backend\models\AddClass;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Classinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="classinfo-form">
    <?php
    $mateods = array();
    if (Yii::$app->user->identity->role_id == 1) {
    $myroling = User::find()->where(['role_id' => '5'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
    }
    else{
    $myroling = User::find()->where(['role_id' => '5'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }

    foreach ($myroling as $rolig) {
            $rol_ids = $rolig->id;
            $myrolinsdsg = newStaffdata::find()->where(['user_id' => $rol_ids])->one();
            $midst = $myrolinsdsg['user_id'];
            $mateods[$midst] = $myrolinsdsg['fname'] . " " . $myrolinsdsg['lname'];
        } 
   
	$add_class = array();
    if (Yii::$app->user->identity->role_id == 1) {
		$addition = AddClass::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->all();
    } else {
		$addition = AddClass::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
    foreach ($addition as $add_class_roler) {
		$class_addition_id = $add_class_roler->id;
        $class_addition_name = $add_class_roler->class_name;
		$add_class[$class_addition_id] = $class_addition_name;
    }
	
	$acadyears = array();
	$getacadid = '';
    if (Yii::$app->user->identity->role_id == 1) {
        $saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->all(); 
    } else {
		$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->all();
    }
    foreach ($saddfs as $dfsdfsdfg) {
		$getacadid = $dfsdfsdfg->id;
        $rol_idsfds = $dfsdfsdfg->id;
        $rol_ifds = $dfsdfsdfg->from;
        $rol_idsdfds = $dfsdfsdfg->to;
		$acadyears[$rol_idsfds] = $rol_ifds . ' - ' . $rol_idsdfds;
    }

    $studas= array();
    if (Yii::$app->user->identity->role_id == 1) {
    $myroling_second = User::find()->where(['role_id' => '6'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', '10'])->all();
    }
    else{
    $myroling_second = User::find()->where(['role_id' => '6'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', '10'])->all(); 
    }
    foreach ($myroling_second as $studdsd){
			$stude_id = $studdsd->id;
			$student_count = ClassStudent::find()->where(['=', 'student_id', $stude_id])->andwhere(['=', 'Academic_year_id', $getacadid])->one();
			$mystudent = AddStudent::find()->where(['=', 'user_id', $stude_id])->one();			
            $real_studid = $mystudent['user_id'];
			$mhtd = $student_count['student_id'];
			if(isset($model->id)){
					
					if($real_studid == $student_count['student_id']){
						
						$checkclassinroel = ClassStudent::find()->where(['=', 'student_id', $mhtd])->andwhere(['=', 'class_id', $model->id])->andwhere(['=', 'Academic_year_id', $getacadid])->one();
						if(!empty($checkclassinroel['student_id'])){
						$mystusdadent = AddStudent::find()->where(['=', 'user_id',$checkclassinroel['student_id']])->one();					
						
						$studas[$mhtd] = ucfirst($mystusdadent['first_name']) . " " . ucfirst($mystusdadent['last_name'])." (" .ucfirst($mystusdadent['father_name']). ")" ; 
						}
						
						}
						
						else {
						$studas[$real_studid] = ucfirst($mystudent['first_name']) . " " . ucfirst($mystudent['last_name'])." (" .ucfirst($mystudent['father_name']). ")" ;
						}
					
						}
					
				
				else{
				if($real_studid != $student_count['student_id']){
				$studas[$real_studid] = ucfirst($mystudent['first_name']) . " " . ucfirst($mystudent['last_name'])." (" .ucfirst($mystudent['father_name']). ")" ;
				}
				
				
				
			}
			
        }

    $subjectsd = array();
    if (Yii::$app->user->identity->role_id == 1) {
        $subij = Subject::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->all();
    } else {
        $subij = Subject::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }

    foreach ($subij as $dsdfg) {
        $rol_idfds = $dsdfg->id;
        $rol_ifds = $dsdfg->subject_name;

        $subjectsd[$rol_idfds] = $rol_ifds;
    }
	
	$sections = array();
    if (Yii::$app->user->identity->role_id == 1) {
        $secone = Section::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->all();
    } else {
        $secone = Section::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }

    foreach ($secone as $secallshow) {
        $secting = $secallshow->id;
        $sctname = ucfirst($secallshow->section_name);

        $sections[$secting] = $sctname;
    }


	
	$inactiveacads = array();
	$import_check_id = array();
    if (Yii::$app->user->identity->role_id == 1) {
        $insdactive = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 0])->all();
		
    } else {
        $insdactive = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 0])->all();
    }
    foreach ($insdactive as $insdactivesd) {
        $rol_idsfdssa = $insdactivesd->id;
		$import_check_id[] = $insdactivesd->id;
        $rol_ifdssa = $insdactivesd->from;
        $rol_idsdfdsfds = $insdactivesd->to;
		$inactiveacads[$rol_idsfdssa] = $rol_ifdssa . ' - ' . $rol_idsdfdsfds;
    }


    $meteo1 = ['' => 'Please Select', 'Science' => 'Science', 'English' => 'English', 'Social Studies' => 'Social Studies', 'Mathematics' => 'Mathematics',];
    $meteo2 = ['' => 'Please Select', 'James' => 'James', 'Erick' => 'Erick', 'Bruno' => 'Bruno', 'Henderson' => 'Hendorson', 'Reo' => 'Reo',];
    ?>
    <?php $form = ActiveForm::begin(); 
	if(empty($acadyears)){ ?>
		<div id="w1-error" class="alert-error alert fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-time"></i>Please add active Academic Year.</div>
	<?php	}
	
	?>
	
    <div class="col-md-6 mar-left-non">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Class Information</h3>
            </div>


            <div class="box-body">
                <div class="form-group">
<?=
$form->field($model, 'class_name', [
    'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
])->dropDownList($add_class, ['prompt' => 'Please Select'])
?>
                </div>

                <div class="form-group">
				<?=
				$form->field($model, 'class_section', [
					'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-file-text"></i></div>{input}</div>{hint}{error}'
				])->dropDownList($sections, ['prompt' => 'Please Select'])

				?>
                </div>
                <div class="form-group">
                    <?=
                    $form->field($model, 'academic_year', [
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($acadyears,['readonly' => true])
                    ?>
                </div>
                <div class="form-group">
<?= $form->field($model, 'class_description')->textarea(['rows' => 3]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 ">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Class Subjects</h3>
                <button type="button" class="btn btn-info btn-sm pull-right" id="adding_cls">Add More</button>
            </div>
            <div class="box-body">

                <?php
                if (isset($model->id)) {
					
                    ?>
					
                    <div class="myclone">
                    <div class="apsnd_class">
					<div class="col-md-6">
    <?php 
	$xy = 0;
	foreach ($second_model as $hjasdasd) {
		$subikj = $hjasdasd->subject_id;
        ?>

                            <div class="form-group">
                                <div class="form-group_first_doin_<?php echo $xy; ?> field-classsubject-subject_id_<?php echo $xy; ?>">
                                    <label class="control-label" for="classsubject-subject_id">Subject</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div><select id="classsubject-subject_id_<?php echo $xy; ?>" class="form-control" name="ClassSubject[subject_id][]">
									<option value="">Please Select</option>
                                            <?php
                                            foreach ($subjectsd as $key => $val) {
                                                if ($key == $subikj) {
                                                    $check = "selected='selected'";
                                                } else {
                                                    $check = '';
                                                }
                                                echo "<option value='" . $key . "' " . $check . ">" . $val . "</option>";
                                            }
                                            ?>
                                        </select></div><div class="help-block_first_doin_<?php echo $xy; ?>"></div>
                                </div> 
                            </div>


                        <?php $xy++; } ?> 
                    </div>

                    <div class="col-md-6"> 
    <?php
		$jh = 0; $minds = 0;
	foreach ($second_model as $tchds) {
		 $teachingsd = $tchds->Assigned_teacher_id;
        ?>
                            <div class="form-group">
                                <div class="form-group_second_doin_<?php echo $jh; ?> field-classsubject-assigned_teacher_id_<?php echo $jh; ?>">
                                    <label class="control-label" for="classsubject-assigned_teacher_id">Assign Teacher</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <select id="classsubject-assigned_teacher_id_<?php echo $minds; ?>" class="form-control" name="ClassSubject[Assigned_teacher_id][]" aria-invalid="false">
										<option value="">Please Select</option>
                                            <?php
                                            foreach ($mateods as $key => $teachval) {
                                                if ($key == $teachingsd) {
                                                    $check = "selected='selected'";
                                                } else {
                                                    $check = '';
                                                }
                                                echo "<option value='" . $key . "' " . $check . ">" . $teachval . "</option>";
                                            }
                                            ?>
                                        </select></div><div class="help-block_second_doin_<?php echo $jh; ?>"></div>
                                </div> 
                            </div>
	<?php if($jh != '0'){ ?>
					<a class="maxing pull-right"  id="max_<?php echo $tchds->id; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
					
	<?php } $jh++; $minds++;
					} ?>
                    </div>
					</div>
					
				</div>
                        <?php } else { ?>
					<div class="myclone">
                    <div class="apsnd_class">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?=
                            $form->field($second_model, 'subject_id[]', [
                                'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>{input}</div>{hint}{error}'
                            ])->dropDownList($subjectsd, ['prompt' => 'Please Select'])
                            ?> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                    <?=
                    $form->field($second_model, 'Assigned_teacher_id[]', [
                        'template' => '{label}<div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>{input}</div>{hint}{error}'
                    ])->dropDownList($mateods, ['prompt' => 'Please Select'])
                    ?> 
                        </div>
                    </div></div></div>
<?php } ?>
			
					<div class="excent" style="display : none;">
                    <div class="apsnd_class_update">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group field-classsubject-subject_id">
							<label class="control-label" for="classsubject-subject_id">Subject</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div><select id="classsubject-subject_id" class="form-control" name="ClassSubject[subject_id][]">
								<option value="">Please Select</option>
                                            <?php
                                            foreach ($subjectsd as $key => $val) {
                                              
                                                echo "<option value='" . $key . "'>" . $val . "</option>";
                                            }
                                            ?>
							</select></div><div class="help-block"></div>
							</div> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                    <div class="form-group field-classsubject-assigned_teacher_id">
						<label class="control-label" for="classsubject-assigned_teacher_id">Assign Teacher</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div><select id="classsubject-assigned_teacher_id" class="form-control" name="ClassSubject[Assigned_teacher_id][]">
							<option value="">Please Select</option>
							<?php
								foreach ($mateods as $key => $teachval) {

									echo "<option value='" . $key . "'>" . $teachval . "</option>";
								}
							?>
						</select></div><div class="help-block"></div>
						</div> 
                        </div>
                    </div></div></div>


               <div class="row"></div> <div class="addition_clsdd">
                </div>
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-6 ">

        </div>
    </div>
	<div class="row"> 
        <div class="col-md-6 ">

        </div>
    </div>
    <div class="col-md-6 mar-left-non">

        <div class="box box-danger">
            <div class="box-header ">
                <h3 class="box-title">Add Student</h3>
				<?php 
				$reason_import = '';
				foreach ($import_check_id as $academic_count){
					if (Yii::$app->user->identity->role_id == 1) {
						$student_chkmodel = ClassStudent::find()->where(['Academic_year_id' => $academic_count])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->groupBy(['Academic_year_id'])->count();
					}else{
						$student_chkmodel = ClassStudent::find()->where(['Academic_year_id' => $academic_count])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->groupBy(['Academic_year_id'])->count();
					}
					$reason_import = $student_chkmodel;
					}
					if($reason_import > 0){ ?>
					<button class="btn btn-default pull-right" id="importing" type="button">Import</button>
				<?php	}
				?>
				
            </div>
			<div class="box-header with-border importing_selection">
				<div class="pull-right">
				<select id="acad_select" class="myslect_acdemic">
				<option>Please Select </option>
				<?php
					foreach ($inactiveacads as $key => $acad_chnge) {
							
						echo "<option value='" . $key . "'>" . $acad_chnge . "</option>";
					}
				?>
				</select>
				</div>
            </div>

			
            <div class="box-body">
			<div class="form-group orignal_select"> 
				<div class="form-group field-classstudent-student_id has-success">
					<label class="control-label" for="classstudent-student_id"></label>
					
					<select id="classstudent-student_id" class="form-control" name="ClassStudent[student_id][]" aria-invalid="false" multiple="multiple" >
					<?php
						if(isset($model->id)){ 
							if(!empty($third_model)){
								$teachinsdgsd = array();
								foreach($third_model as $mythidrdval){
								$teachinsdgsd[] = $mythidrdval->student_id;
								}
								foreach ($studas as $key => $sdasdae) {
                                                if (in_array($key,$teachinsdgsd)) {
                                                    $check = "selected='selected'";
                                                } else {
                                                    $check = '';
                                                }
                                                echo "<option value='" . $key . "' " . $check . ">" . $sdasdae . "</option>";
                                            }
							}else{
								 foreach ($studas as $key => $sdd) {
							 echo "<option value='" . $key . "'>" . $sdd . "</option>";
							 }
							}

						}
						else{
						 foreach ($studas as $key => $sdd) {
							echo "<option value='" . $key . "'>" . $sdd . "</option>";
						} 
						}
						
                    ?>
					</select>
					
					<div class="help-block"></div>
					<button class='btn btn-default all_select' id='select-all'>Select all</button> 
					<button class="btn btn-default del_select pull-right" id='deselect-all'>Deselect all</button>
				</div>			
			</div>
			<div class="custom_selections">
			
			</div>
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-6 ">
		<?php 
		$totalcount = '';
		if(isset($model->id)){ 
		if(!empty($second_model)){
				foreach($second_model as $contmodel) {
					$totalcount = count($contmodel) + $totalcount;
				}
			} 
		}
		?>
		<input type="hidden" value="<?php echo $totalcount; ?>" id="chechk_valuecount">
        </div>
    </div>
<?php	if(!empty($acadyears)){ ?>
    <div class="row">
        <div class="col-md-6 ">
            <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'hum']) ?>
<?= Html::a('Cancel', ['classinfo/index'], ['class' => 'btn btn-default tenmarleft']) ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php ActiveForm::end(); ?>

</div>
