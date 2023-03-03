<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\newStaffdata;
use backend\models\AddStudent;
use backend\models\Subject;
use backend\models\AcedemicYear;
use common\models\User;
use backend\models\Classinfo; 
use backend\models\ClassStudent; 

if(isset($modelfs)){
	$myroling = ClassStudent::find()->Where(['Academic_year_id' => $modelfs])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->all();
	 foreach ($myroling as $rolig) {
            $rol_ids = $rolig->student_id;
            $myrolinsdsg = AddStudent::find()->where(['user_id' => $rol_ids])->one();
            $midst = $myrolinsdsg['user_id'];
            $mateods[$midst] = $myrolinsdsg['first_name'] . " " . $myrolinsdsg['last_name'];
        } 
	
	
} ?>
				<div class="form-group field-classstudent-student_id has-success">
					<label class="control-label" for="classstudent-student_id"></label>

					<select id="classstudent-student_id_second" class="form-control" name="ClassStudent[student_id][]" aria-invalid="false" multiple='multiple'>
					<?php
 						foreach ($mateods as $key => $sdd) {
							echo "<option value='" . $key . "'>" . $sdd . "</option>";
						}  
                    ?>
					</select>
					<div class="help-block"></div>
					<button class='btn btn-default all_select' id='select-all_new'>Select all</button> 
					<button href='#' class="btn btn-default del_select pull-right" id='deselect-all_new'>Deselect all</button>
				</div>	


