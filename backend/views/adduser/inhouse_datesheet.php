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

$this->title = 'Class Test Date Sheet';
?>


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


	   <div class="col-md-6 mar-left-non">
						<div class="row pull-right " style="margin-bottom : 7px;">
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
</div> <div class="row"></div><div class="row"></div>
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
					
				   $getclass = ClassStudent::find()->where(['student_id'=>Yii::$app->user->getId()])->andwhere(['Academic_year_id'=>$academine])->one();
				   $getclassname = ClassInfo::find()->where(['id'=>$getclass['class_id']])->one();
				   
				   $student = Yii::$app->user->identity->id; 
				   
				   $mistiquesr = InhouseTest::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$academine])->andwhere(['=','class_id',$getclassname['class_name']])->andwhere(['=','section_id',$getclassname['class_section']])->groupBy(['exam_id'])->orderBy(['id' => SORT_DESC])->all();
				   
				$exmsditser = '';
				$mkol = 0;
				foreach($mistiquesr as $mastrmingd){
					
					$gtalsd = InhouseTestSubjects::find()->where(['inhouse_test_id'=>$mastrmingd->id])->count();
					if($gtalsd > 0){
				$getexmnmer = AddTest::find()->where(['id'=>$mastrmingd->exam_id])->one();
				 
					?>
						
						
						<tr style="background: beige;"><td colspan="3"><b style="color :  darkorange;"> <?php echo "Exam : ". ucfirst($getexmnmer['test_name']); ?></b></td></tr>
						
						<?php

						$gtalsdsd = InhouseTestSubjects::find()->where(['inhouse_test_id'=>$mastrmingd->id])->all();
							
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