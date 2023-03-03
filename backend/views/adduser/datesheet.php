<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\models\Subject;
use backend\models\AcedemicYear;
use backend\models\Section;
use backend\models\AddExam;
use backend\models\FinalExam;
use common\models\User;
use backend\models\SchoolList;
use backend\models\newStaffdata; 
use backend\models\FinalExamSubjects;
use backend\models\FinalExamGrading;
use backend\models\AnnouncementsTeacher;
use backend\models\Assignmentclasses;
use backend\models\AnnouncementsParent;
use backend\models\ClassStudent;
use backend\models\ClassSubject;
use backend\models\ClassInfo;
use backend\models\AddClass;
use backend\models\InhouseTest;
use backend\models\InhouseTestGrading;
use backend\models\InhouseTestSubjects;
use backend\models\AddTest;
use yii\helpers\Url; 

$this->title = 'Date Sheet';
?>

<style>
.table td:last-child {
    min-width: 27%;
}
</style>
<div class="site-index">

<?php 

	
	

if(Yii::$app->user->identity->role_id == '6'){ 

if(isset($academics_set) && !empty($academics_set)){
		$presnt_acad = $academics_set;
		$academine = $academics_set;
		$keysacad = $academics_set;
		/* echo $presnt_acad;
		die; */
	}else {
		if (Yii::$app->user->identity->role_id == 1) {
        $presnt_acadi = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
		$presnt_acad = $presnt_acadi['id'];
		$academine = $presnt_acadi['id'];
		$keysacad = $presnt_acadi['id'];
		} else {
			$presnt_acadi = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			$presnt_acad = $presnt_acadi['id'];
			$academine = $presnt_acadi['id'];
			$keysacad = $presnt_acadi['id'];
		}
	}



?>

<div class="row">
<div class="col-md-12">
<div class="row pull-right " style="margin-bottom : 7px; margin-right: 15px;">
	<div class="col-md-12">
	<?php $form = ActiveForm::begin(['id' => 'toggle-acadsearch']); ?>
		<span class="margileftplus">Acedemic Year :</span>
		<span>
			<select name="newacademic" id="acadhochnge">
				<option value="">Please Select</option>
				<?php $acadchnge = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->orderBy(['status' => SORT_DESC])->all(); 
				
					foreach($acadchnge as $racadchng){ 
					if($keysacad == $racadchng->id){
						$mikilwer = "selected = 'selected'";
					}
					else {
						$mikilwer = "";
					}
					?>
					
					
					<option value="<?php echo $racadchng->id; ?>" <?php echo $mikilwer; ?> ><?php echo $racadchng->from."-".$racadchng->to; ?></option>
					<?php } ?>
			</select>
		</span>
		<div class="button-group">
                    <button type="submit" style="display:none;" class="oceanSearch" name="signup-button">Search  </button>
                </div>
            <?php ActiveForm::end(); ?>

	</div>
</div>

</div>
</div>
	   <div class="col-md-6 mar-left-non">
 <div class="row"></div><div class="row"></div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Exam Date Sheet</h3>
            </div>
           
            
              <div class="box-body">
				<table class="table table-striped table-bordered">
				    <thead>
					    <tr>
						  <th>Subject</th>
						  <th>Subject Teacher</th>
						  <th>Exam Date</th>
					    </tr>
				    </thead>
				    <tbody>
					
					<?php 
					
				   $getclass = ClassStudent::find()->where(['student_id'=>Yii::$app->user->getId()])->andwhere(['Academic_year_id'=>$academine])->one();
				   $getclassname = ClassInfo::find()->where(['id'=>$getclass['class_id']])->one();
				   
				   $student = Yii::$app->user->identity->id; 
				   
				   $mistiquesr = FinalExam::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$academine])->andwhere(['=','class_id',$getclassname['class_name']])->andwhere(['=','section_id',$getclassname['class_section']])->groupBy(['exam_id'])->orderBy(['id' => SORT_DESC])->all();
				   
				$exmsditser = '';
				$mkol = 0;
				foreach($mistiquesr as $mastrmingd){
					
					$gtalsd = FinalExamSubjects::find()->where(['final_exam_id'=>$mastrmingd->id])->count();
					if($gtalsd > 0){
				$getexmnmer = AddExam::find()->where(['id'=>$mastrmingd->exam_id])->one();
				 
					?>
						
						
						<tr style="background: beige;"><td colspan="3"><b style="color :  darkorange;"> <?php echo "Exam : ". ucfirst($getexmnmer['exam_name']); ?></b></td></tr>
						
						<?php

						$gtalsdsd = FinalExamSubjects::find()->where(['final_exam_id'=>$mastrmingd->id])->all();
							
							foreach($gtalsdsd as $mikltorsd){
							
						?>
					<tr>
						<td><?php $subjctd = Subject::find()->where(['id' => $mikltorsd->subject_id])->one();
						echo ucfirst($subjctd['subject_name']);
						?></td>
						<td>
							<?php $newStaffdatad = newStaffdata::find()->where(['user_id' => $mikltorsd->Assigned_teacher_id])->one();
							echo ucfirst($newStaffdatad['fname']) . " " .ucfirst($newStaffdatad['lname']);
							?>
						</td>
						<td><?php 
						
						if($mikltorsd->exam_date != ''){
										$newDatesd = date("d-M-Y", strtotime($mikltorsd->exam_date));
									}
									else {
										$newDatesd = 'NA';
									}
									
									echo $newDatesd;
						
						?></td>
						
						
						
					</tr> 
						 
					<?php }
					if($mkol == 0){
						$exmsditser = $mastrmingd->id; 
						}  
					$mkol++; } 
					
					
					} 
					
					if(empty($exmsditser)){ ?>
						<tr>
							<td colspan="3" style="text-align : center;">No Exam Found.</td>
						</tr> 
					<?php }
					?>
						
				    </tbody>
			    </table>
			  </div>
		  </div>
		</div> 
		<div class="col-md-6">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Test Date Sheet</h3>
            </div>
           
            
              <div class="box-body">
				<table class="table table-striped table-bordered">
				    <thead>
					    <tr>
						  <th>Subject</th>
						  <th>Subject Teacher</th>
						  <th>Exam Date</th>
					    </tr>
				    </thead>
				    <tbody>
					
					<?php 
					
				   $getclasssa = ClassStudent::find()->where(['student_id'=>Yii::$app->user->getId()])->andwhere(['Academic_year_id'=>$academine])->one();
				   $getclassnamesa = ClassInfo::find()->where(['id'=>$getclasssa['class_id']])->one();
				   
				   $student = Yii::$app->user->identity->id; 
				   
				   $mistiquesra = InhouseTest::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$academine])->andwhere(['=','class_id',$getclassnamesa['class_name']])->andwhere(['=','section_id',$getclassnamesa['class_section']])->groupBy(['exam_id'])->orderBy(['id' => SORT_DESC])->all();
				   
				$exmsditserer = '';
				$mkoler = 0;
				foreach($mistiquesra as $mastrmingds){
					
					$gtalsds = InhouseTestSubjects::find()->where(['inhouse_test_id'=>$mastrmingds->id])->count();
					if($gtalsds > 0){
				$getexmnmers = AddTest::find()->where(['id'=>$mastrmingds->exam_id])->one();
				 
					?>
						 
						
						<tr style="background: beige;"><td colspan="3"><b style="color :  darkorange;"> <?php echo "Exam : ". ucfirst($getexmnmers['test_name']); ?></b></td></tr>
						
						<?php

				$getexam_nameerss = InhouseTest::find()->where(['id'=>$mastrmingds->id])->one();
				
				$getexam_nameers = InhouseTest::find()->where(['exam_id'=>$getexam_nameerss['exam_id']])->andwhere(['class_id'=>$getexam_nameerss['class_id']])->andwhere(['section_id'=>$getexam_nameerss['section_id']])->andwhere(['school_id'=>$getexam_nameerss['school_id']])->andwhere(['academic_year'=>$getexam_nameerss['academic_year']])->orderBy(['id' => SORT_DESC])->all();
				foreach($getexam_nameers as $testerexms){ 
						$gtalsdsds = InhouseTestSubjects::find()->where(['inhouse_test_id'=>$testerexms->id])->all();
							
							foreach($gtalsdsds as $mikltorsds){
							
						?>
					<tr>
						<td><?php $subjctd = Subject::find()->where(['id' => $mikltorsds->subject_id])->one();
						echo ucfirst($subjctd['subject_name']);
						?></td>
						<td>
							<?php $newStaffdatads = newStaffdata::find()->where(['user_id' => $mikltorsds->Assigned_teacher_id])->one();
							echo ucfirst($newStaffdatads['fname']) . " " .ucfirst($newStaffdatads['lname']);
							?>
						</td>
						<td><?php 
						
						if($mikltorsds->exam_date != ''){
										$newDatesds = date("d-M-Y", strtotime($mikltorsds->exam_date));
									}
									else {
										$newDatesds = 'NA';
									}
									
									echo $newDatesds;
						
						?></td>
						
						
						
					</tr> 
						 
				<?php } }
					if($mkoler == 0){
						$exmsditserer = $mastrmingds->id; 
						}  
					$mkoler++; } 
					
					
					} 
					
					if(empty($exmsditserer)){ ?>
						<tr>
							<td colspan="3" style="text-align : center;">No Test Found.</td>
						</tr> 
					<?php }
					?>
						
				    </tbody>
			    </table>
			  </div>
		  </div>
		
		</div>
<?php } ?>	


<?php 

$this->registerJsFile(''.Yii::getAlias('@base').'/js/datesheet.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

 ?>	