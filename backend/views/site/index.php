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
/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>

<style>
.table td:last-child {
    min-width: 25%;
}
</style>

<div class="site-index">

<?php 
   
	

if(Yii::$app->user->identity->role_id == '6'){ 

	if(isset($academics_set) && !empty($academics_set)){
		$presnt_acad = $academics_set;
		$academine = $academics_set;
		$keysacad = $academics_set;

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

<div class="row pull-right acad_margn-lef">
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

	<div class="row"></div>
	   <div class="col-md-6 mar-left-non">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Assignments</h3>
            </div>
           
            
              <div class="box-body">
				<table class="table table-striped ">
				    <thead>
					    <tr>
						  <th>Assignment Title</th>
						  <th>Created Date</th>
					    </tr>
				    </thead>
				    <tbody>
					<?php $getassigned = Assignmentclasses::find()->where(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['=','Academic_year_id',$presnt_acad])->andwhere(['=','status','1'])->orderBy(['id' => SORT_DESC])->limit(10)->all();  
					$record1 = array(); $i=1;
						foreach($getassigned as $assgnmntd){
							$getstud = explode(',',$assgnmntd['student_id']);
							$userid = Yii::$app->user->identity->id;
							if(in_array($userid,$getstud)){
					?>
						<tr>
							<td>
								<a style="color : black;" href="<?php echo Yii::$app->homeUrl .'assignment/index?newid='.$assgnmntd['id']; ?>"><?php echo ucfirst($assgnmntd['anouncement_title']); ?></a>
							</td>
							<td><a style="color : black;" href="<?php echo Yii::$app->homeUrl .'assignment/index'; ?>"><?php
									$timestamp= $assgnmntd['created'];
									echo gmdate("d-M-Y", $timestamp); ?></a>
							</td>
						</tr>
							<?php $record1[] = $i++; } } ?>
							<?php if (count($record1) == '0'){ ?>
							<tr><td colspan="2" style="text-align:center;"> NA </td></tr>
							<?php } ?>
				    </tbody>
					<?php if (count($record1) == '10'){ ?>
					<tfoot><tr><td colspan="2" >
							<a style="float:right;" href="<?php echo Yii::$app->homeUrl .'assignment/index'; ?>">View all >></a>
						</td></tr></tfoot>
					<?php } ?>
			    </table>
			  </div>
		  </div>
		          		  <?php

					
				   $getclass = ClassStudent::find()->where(['student_id'=>Yii::$app->user->getId()])->andwhere(['Academic_year_id'=>$academine])->one();
				   $getclassname = ClassInfo::find()->where(['id'=>$getclass['class_id']])->one();
				   
				   $student = Yii::$app->user->identity->id;
				   
			?>

		<div class="row"></div>
		<div class="main_parentsdf">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Exams</h3>
			  
			  		<div class="pull-right">
			 <select name="slection_exams" id="getselectionexams">
			
				<?php
				
				
					$mistiquesr = FinalExam::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$academine])->andwhere(['=','class_id',$getclassname['class_name']])->andwhere(['=','section_id',$getclassname['class_section']])->groupBy(['exam_id'])->orderBy(['id' => SORT_DESC])->all();
				$exmsditser = '';
				$mkol = 0;
				foreach($mistiquesr as $mastrmingd){
					
					$gtalsd = FinalExamSubjects::find()->where(['final_exam_id'=>$mastrmingd->id])->count();
					if($gtalsd > 0){
				$getexmnmer = AddExam::find()->where(['id'=>$mastrmingd->exam_id])->one();
				 ?>
				<option value="<?php echo $mastrmingd->id; ?>" ><?php echo ucfirst($getexmnmer['exam_name']); ?></option>
					<?php if($mkol == 0){$exmsditser = $mastrmingd->id; }  $mkol++;} } 
					
					if(empty($exmsditser)){ ?>
						<option value="" >Select Exam</option>
					<?php }
					?>
					
					
			</select>
			
		</div>
			  
            </div>
           
            <div class="row">
		</div><div class="row">
		</div>
              <div class="box-body exam_mine_subjcts">
				<table class="table table-striped ">
				    <thead>
				 <?php
					
						$getexam_name = FinalExam::find()->where(['id'=>$exmsditser])->one();
						$getexmnmer = AddExam::find()->where(['id'=>$getexam_name['exam_id']])->one();
						
					?>	
					  <!--tr>
						  <th>Exam Name : <?php //echo $getexmnmer['exam_name']; ?></th>
						 
					    </tr-->
					
					    <tr>
						  <th>Subject</th>
						  <th>Teacher</th>
						  <?php  if($getexam_name['marks_in'] == '0'){  ?> <th>Max. Marks</th>		<?php } ?>				  
						  <th>Marks </th>
					    </tr>
						
				    </thead>
				    <tbody>
				<?php
					
						
							$gtalsdsd = FinalExamSubjects::find()->where(['final_exam_id'=>$exmsditser])->all();
							
							foreach($gtalsdsd as $mikltorsd){
							
						?>
					<tr>
						<td><?php $subjctd = Subject::find()->where(['id' => $mikltorsd->subject_id])->one();
						echo ucfirst($subjctd['subject_name']);
						?></td>
						
						<td><?php $newStaffdatad = newStaffdata::find()->where(['user_id' => $mikltorsd->Assigned_teacher_id])->one();
						echo ucfirst($newStaffdatad['fname']) . " " .ucfirst($newStaffdatad['lname']); 
						?></td>
				<?php  if($getexam_name['marks_in'] == '0'){  ?> 	<td> <?php echo $mikltorsd->maximum_marks; ?> </td> <?php } ?>		
						  <td>
							<?php 
								
								
								$getstudent_marksd = FinalExamGrading::find()->where(['final_exam_id'=>$exmsditser])->andwhere(['=','student_id',$student])->andwhere(['=','subject_id',$mikltorsd->subject_id])->one();
								
								if($getexam_name['marks_in'] == '0'){
									if($getstudent_marksd['marks'] != ''){
										echo $getstudent_marksd['marks']; 
									} else {
										echo "NA";
									}
							}else {
								if($getstudent_marksd['grade'] != ''){
										echo $getstudent_marksd['grade']; 
									} else {
										echo "NA";
									}
							}
							?>
						  </td>
					</tr>
							<?php }   if(empty($exmsditser)){ ?>
							
						<tr><td colspan="4" style="text-align : center;">No Exam Found.</td></tr> 
						
					<?php }
					?>
				    </tbody>
				
					
			    </table>
			  </div>
		  </div>
		  </div>
		</div>
		<div class="col-md-6">
        
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Announcements</h3>
            </div>
           
            
              <div class="box-body">
				<table class="table table-striped ">
				    <thead>
					  <tr>
						  <th>Announcement Title</th>
						  <th>Created Date</th>
					  </tr>
				    </thead>
				    <tbody>
					<?php $getassigned = AnnouncementsParent::find()->where(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['=','Academic_year_id',$presnt_acad])->andwhere(['=','status','1'])->orderBy(['id' => SORT_DESC])->limit(10)->all();  
					
					 $mixing = '';
					$n = 1; $record = array();
						foreach($getassigned as $assgnmntd){
							$getclasd = ClassStudent::find()->where(['student_id'=>Yii::$app->user->identity->id])->andwhere(['=','Academic_year_id',$presnt_acad])->one();
							
							$getclass_name = ClassInfo::find()->where(['id'=>$getclasd['class_id']])->one();
							
							$getstud = explode(',',$assgnmntd['student_id']);
							$getstudclass = explode(',',$assgnmntd['class_id']);
							$getstudsection = explode(',',$assgnmntd['section']);
							$userid = Yii::$app->user->identity->id;
							
							if((in_array($userid,$getstud)) || (in_array('0',$getstudclass)) || (in_array($getclass_name['class_name'],$getstudclass) && in_array('0',$getstudsection))){
					?>
						<tr>
							<td><a style="color : black;" href="<?php echo Yii::$app->homeUrl .'anouncements/student_index?newid='.$assgnmntd['id']; ?>"><?php echo ucfirst($assgnmntd['anouncement_title']);
										
							?></a></td>
							<td><a style="color : black;" href="<?php echo Yii::$app->homeUrl .'anouncements/student_index'; ?>"><?php
									$timestamp= $assgnmntd['created'];
									echo  gmdate("d-M-Y", $timestamp); ?></a>
							</td>
						</tr>
						
							<?php $record[] = $n++;} 
							
							}

								?>
								<?php if (count($record) == '0'){ ?>
							<tr><td colspan="2" style="text-align:center;"> NA </td></tr>
							<?php } ?>
								
								
				    </tbody>
					<?php if (count($record) == '10'){ ?>
					<tfoot><tr><td colspan="2" >
							<a style="float:right;" href="<?php echo Yii::$app->homeUrl .'anouncements/student_index'; ?>">View all >></a>
						</td></tr></tfoot>
					<?php } ?>
			    </table>
			  </div>
		  </div>
		  
		<div class="row">
		</div>
		<div class="row">
		</div>
		<div class="main_parentsdf">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Test</h3>
			  
		<div class="pull-right">
			<select name="slection_test" id="getselectiontests">
			
				<?php
					$exam_idforone = '';
					$mistiquesr1 = InhouseTest::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$academine])->andwhere(['=','class_id',$getclassname['class_name']])->andwhere(['=','section_id',$getclassname['class_section']])->groupBy(['exam_id'])->orderBy(['id' => SORT_DESC])->all();
				$miclos = 0;
				foreach($mistiquesr1 as $mastrmingd1){
					
					$gtalsd1 = InhouseTestSubjects::find()->where(['inhouse_test_id'=>$mastrmingd1->id])->count();
					if($gtalsd1 > 0){
				$getexmnmer1 = AddTest::find()->where(['id'=>$mastrmingd1->exam_id])->one();
				 ?>
				<option value="<?php echo $mastrmingd1->id; ?>" ><?php echo ucfirst($getexmnmer1['test_name']); ?></option>
					<?php

					if($miclos == 0){
						$exam_idforone = $mastrmingd1->id;
					}	
					
					
					$miclos++;} }
					if(empty($exam_idforone)){ ?>
						<option value="" >Select Test</option>
					<?php }
					?>
			</select>
		</div>	
		<div class="row"></div>	
			  
			  
            </div>
           
            
              <div class="box-body testmine_subjcts">
			  
			  <table class="table table-striped ">
				    <thead>
				 <?php
					
						$getexam_nameer = InhouseTest::find()->where(['id'=>$exam_idforone])->one();
						$getexmnmersw = AddTest::find()->where(['id'=>$getexam_nameer['exam_id']])->one();
						
					?>	
					  <!--tr>
						  <th>Test Name : <?php //echo $getexmnmersw['test_name']; ?></th>
						 
					    </tr-->
					
					    <tr>
						  <th>Subject</th>
						  <th>Teacher</th>
						   <th>Test Date</th>
						<th>Max. Marks</th>
						  <th>Obt. Marks </th>
					    </tr>
						
				    </thead>
				    <tbody>
				<?php
				
				$getexam_nameerss = InhouseTest::find()->where(['id'=>$exam_idforone])->one();
				$getexam_nameers = InhouseTest::find()->where(['exam_id'=>$getexam_nameerss['exam_id']])->andwhere(['class_id'=>$getexam_nameerss['class_id']])->andwhere(['section_id'=>$getexam_nameerss['section_id']])->andwhere(['school_id'=>$getexam_nameerss['school_id']])->andwhere(['academic_year'=>$getexam_nameerss['academic_year']])->orderBy(['id' => SORT_DESC])->all();
				foreach($getexam_nameers as $testerexms){ 
							
						
							$gtalsdsddorn = InhouseTestSubjects::find()->where(['inhouse_test_id'=>$testerexms->id])->all();
						
							foreach($gtalsdsddorn as $mikltorongs){ 
							
						?>
					<tr>
						<td><?php $subjcter = Subject::find()->where(['id' => $mikltorongs->subject_id])->one();
						echo ucfirst($subjcter['subject_name']);
						?></td>
						
						<td><?php $newStaffdataad = newStaffdata::find()->where(['user_id' => $mikltorongs->Assigned_teacher_id])->one();
						echo ucfirst($newStaffdataad['fname']) . " " .ucfirst($newStaffdataad['lname']);  
						?></td>
						<td><?php 
						
						if($mikltorongs->exam_date != ''){
										$newDatesds = date("d-M-Y", strtotime($mikltorongs->exam_date));
									}
									else {
										$newDatesds = 'NA';
									}
									
									echo $newDatesds;
						
						?></td>
						<td> <?php echo $mikltorongs->maximum_marks; ?> </td>
						  <td>
							<?php 
								
								
								$getstudent_marks = InhouseTestGrading::find()->where(['inhouse_test_id'=>$testerexms->id])->andwhere(['=','student_id',$student])->andwhere(['=','subject_id',$mikltorongs->subject_id])->one();
								
									if($getstudent_marks['marks'] != ''){
										echo $getstudent_marks['marks']; 
									} else {
										echo "NA";
									}
							
							
							?>
						  </td>
					</tr>
					<?php }  }
							
					if(empty($exam_idforone)){ ?>
						<tr><td colspan="4" style="text-align : center;"> No Test Found. </td></tr>
					<?php }
					?>		
				    </tbody>
				
					
			    </table>
			  
				
			  </div>
		  </div>
		  </div>
		  
		</div>
		

<div class="col-md-6 mar-left-non">


		  
		</div>
		<div class="col-md-6">
        


		</div> 
		
		<div class="row">
		</div>
		<div class="row">
		</div>



<?php }   ?>

</div>
<?php 

$this->registerJsFile('/js/dashboard_request.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

 ?>