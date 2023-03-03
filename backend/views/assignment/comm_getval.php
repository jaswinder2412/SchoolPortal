<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ClassInfo;
use backend\models\ClassStudent;
use backend\models\AddStudent;
use backend\models\AcedemicYear;
/* @var $this yii\web\View */
/* @var $model backend\models\Anouncements */

 if(isset($class) && isset($sect) && isset($schl) && isset($acad_id)){
	 if((!empty($class)) && ($sect != '')){
		 if($sect == '0'){
			 echo "All Sections Select";
		 }else{ 
	 $classdin = ClassInfo::find()->where(['class_name' => $class])->AndWhere(['=', 'school_id', $schl])->AndWhere(['=', 'class_section', $sect])->AndWhere(['=', 'academic_year', $acad_id])->one(); 
	 if(!empty($classdin['id'])){
		 
	 $studentsdcount = ClassStudent::find()->where(['class_id' => $classdin['id']])->count();
	 if($studentsdcount != '0'){
	 $studentsd = ClassStudent::find()->where(['class_id' => $classdin['id']])->all();
	 ?>
	 
 <div class="form-group">
	 <div class="form-group field-assignmentclasses-student_id">
	
		<select id="assignmentclasses-student_id" class="form-control" name="Assignmentclasses[student_id][]"  multiple="multiple">
		<?php foreach($studentsd as $mystudent){ 
			 $getstud = AddStudent::find()->where(['user_id' => $mystudent->student_id])->andwhere(['=','status','10'])->one();
			 if(!empty($getstud)){
				 echo "<option value='".$getstud['user_id']."'>".$getstud['first_name']." ".$getstud['last_name']."  </option>";
			 }
				
			
		} ?>
		
		</select>
		
		<div class="help-block"></div>
		<button class='btn btn-default all_select' id='select-all'>Select all</button> 
		<button class="btn btn-default del_select pull-right" id='deselect-all'>Deselect all</button>
	 </div>				
 </div>
	 
	 <?php }
		else{
			echo "No Result Found";
		}
	 }else{
	echo "No Result Found";
}
	 }
}else{
		echo "No Result Found";
}
} else
{
	
	echo "No Result Found";
	
}

 ?>