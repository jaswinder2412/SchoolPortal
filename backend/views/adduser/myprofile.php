<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\web\assets\AdminLtePluginAsset; 
use common\models\User;
use backend\models\ClassStudent;
use backend\models\AnnouncementsParent;
use backend\models\ClassInfo;
use backend\models\ClassSubject;
use backend\models\newStaffdata;
use backend\models\Subject;
use backend\models\Section;
use backend\models\AcedemicYear;
use backend\models\AddClass;
use backend\models\SchoolList;
use backend\models\ExamClass;
use backend\models\Exam;
use backend\models\FinalExam;
use backend\models\AddExam;
use backend\models\FinalExamGrading;
use backend\models\FinalExamSubjects;
use backend\models\ManageGrade;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Staff_search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
$role = Yii::$app->user->identity->role_id;
?>
<style> 
.table td:last-child {
	min-width : auto !important;
	
}
.margig-tabl {
margin-top: 10px;
margin-bottom: -4px;
}
.margig-tabl2 {
margin-top: 3px;
margin-bottom: -4px;
}
.fixed_widt{
	width: 50%;
}
</style>
<div class="staff-index-fonting">
<div class="row ">
		<div class="class_width_thirtyfive index_rowing">
          <div class="box box-primary fixd_height_box">
            <div class="box-body">
			<div class="row prof-upper-margin">
              <div class="col-md-6">
			  <?php
				 if($model['image'] != ''){
					  $hdsd = '/uploads/'.$model['image'];
				   } else {
					   if(isset($model->gender)){
						   if($model->gender =='0'){
							   $hdsd = '/dummy_users/dummyusers.png';
						   }
						   else{
							   $hdsd = '/dummy_users/girluser.jpg';
						   }
					   }else {
						  $hdsd = '/dummy_users/dummyusers.png'; 
					   }
					   
					   
				   }
				echo   Html::img(Yii::getAlias('@base').$hdsd,['width' => '70px','class' => 'profile-user-img img-responsive img-circle']);
			  ?>
				
				
			  </div>
			  <div class="col-md-6 prof-name"> 
				<span class="anothring_font"><?php echo ucfirst($model->first_name) ." ". ucfirst($model->last_name); ?></span><br/>
				<?php
				 $user_statusQuery = User::find()->select(['status'])->where(['id'=>$model->user_id])->one();
				   $stat =  $user_statusQuery->status;
				   if ($stat == '10'){
					   $jh = '<span class="micond"><i class="fa fa-check-circle" aria-hidden="true"></i> Active Account</span>';
				   } else if(($stat == '2')) {
					   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Deactivated</span>';
				   }
				   else {
					   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Inactive Account</span>';
				   }
				   echo $jh;?>
				<!--span class="grn-clr"><i class="fa fa-check-circle" aria-hidden="true"></i> 
				Activate Now</span-->
			  </div>
			  </div>
			  <br/>
			  <div class="row getupds">
			  
			  <div class="col-md-6 prsnl-info-first">
			  <span><i class="fa fa-calendar getsiconpading" id="yellow-lcr" aria-hidden="true"></i><font class="generic">DOB :</font> </span>
			  </div>
				<div class="col-md-6 prsnl-info"> 
				<span><?php  $date = new DateTime($model->dob);
				     echo $date->format('d-M-Y'); ?></span>
				</div>
			<div class="row"></div>
				<div class="col-md-6 prsnl-info-first">
					<span><i class="fa fa-desktop getsiconpading" id="skyblue-lcr" aria-hidden="true"></i><font class="generic">Current Class : </font></span>
				</div>
				<div class="col-md-6 prsnl-info"> 
				<span><?php

					if(Yii::$app->user->identity->role_id == 1){
				    $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
				   }else{
					   $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
				   }
				   $getclass = ClassStudent::find()->where(['student_id'=>$model->user_id])->andwhere(['Academic_year_id'=>$academine['id']])->one();
				   $getclassname = ClassInfo::find()->where(['id'=>$getclass['class_id']])->one();
				   if(!empty($getclassname['class_name'])){
					  $nockout  = $getclassname['class_name'];
					   $myclassfind = AddClass::find()->where(['id'=>$nockout])->one();
					   $getclks = $myclassfind['class_name'];
				   }else {
					   $getclks = 'NA';
				   }
				   
				    if(Yii::$app->user->identity->role_id == 1){
				    $academinesection = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
				   }else{
					   $academinesection = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
						
				   }

					$getclasssection = ClassStudent::find()->where(['student_id'=>$model->user_id])->andwhere(['Academic_year_id'=>$academinesection['id']])->one();
				   $getclassnamesection = ClassInfo::find()->where(['id'=>$getclasssection['class_id']])->one();
					$getsubject = Section::find()->where(['id'=>$getclassnamesection['class_section']])->one();
					 if(!empty($getsubject['section_name'])){
					   $getsubjicts = $getsubject['section_name'];
				   }else {
					   $getsubjicts = 'NA';
				   }
					
				   
					echo $getclks. " " .$getsubjicts;
				?></span>
				</div>
				<div class="row"></div>
				<div class="col-md-6 prsnl-info-first">
					<span><i class="fa fa-user getsiconpading" id="red-lcr" aria-hidden="true"></i><font class="generic">Admission No. :</font> </span>
				</div>
				<div class="col-md-6 prsnl-info"> 
					<span><?php echo $model->admission_number; ?></span>
				</div>
				<div class="row"></div>
				<div class="col-md-6 prsnl-info-first">
					<span><span><i class="fa fa-calendar getsiconpading" id="green-lcr" aria-hidden="true"></i></span><span class="generic">Acad. Year : </span></span>
				</div>
				<div class="col-md-6 prsnl-info"> 
					<span><?php $msiuser = new User;
					 $getacademic = $msiuser->getonlyacademicyear($role);
					echo ucfirst($getacademic);
				?></span>
				</div>
				<div class="row"></div>
				<div class="col-md-6 prsnl-info-first">
					<span><i class="fa fa-tint getsiconpading" id="red-lcr" aria-hidden="true"></i><font class="generic">Blood Group :</font></span>
				</div>
				
				<div class="col-md-6 prsnl-info"> 
					<span><?php echo $model->blood_group; ?></span>
				</div>
				
				<div class="row"></div>
			  </div>
			  </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		
        <!-- /.col -->
		<div class="class_width_thirtyfive">
          <div class="box box-success fixd_height_box">
		  <div class="box-header with-border">
              <h3 class="box-title boxhedl">More Information
			</h3><i class="fa fa-info-circle grn-clr iconfixing" aria-hidden="true"></i>
            </div>
            <div class="box-body">
		   <div class="row getupds2">
			  <div class="col-md-6 my-info-first">
				<span ><i class="fa fa-user-o getsiconpading" id="green-lcr" aria-hidden="true"></i> <font class="generic">Father Name :</font> </span>
			  </div>
			  <div class="col-md-6 my-info-first">
				<span><?php echo ucfirst($model->father_name); ?></span>
			  </div>			  
				<div class="row"></div>
			  <div class="col-md-6 my-info-first">
				<span ><i class="fa fa-phone getsiconpading" id="skyblue-lcr" aria-hidden="true"></i> <font class="generic">Phone Number :</font> </span>
			  </div>
			  <div class="col-md-6 my-info-first">
				<span><?php echo ucfirst($model->father_ph_no); ?></span>
			  </div>
			  <div class="row"></div>
			  <div class="col-md-6 my-info-first">
				<span ><i class="fa fa-user-o getsiconpading" id="green-lcr" aria-hidden="true"></i> <font class="generic">Mother Name :</font> </span>
			  </div>
			  <div class="col-md-6 my-info-first">
				<span><?php echo ucfirst($model->mother_name); ?></span>
			  </div>
			  <div class="row"></div>
			  <div class="col-md-6 my-info-first">
				<span><i class="fa fa-phone getsiconpading" id="skyblue-lcr" aria-hidden="true"></i> <font class="generic">Phone Number :</font> </span>
			  </div>
			  <div class="col-md-6 my-info-first">
				<span><?php echo ucfirst($model->mother_phone_no); ?></span>
			  </div>
			  <div class="row"></div>
			  <div class="col-md-6 my-info-first">
				<span><i class="fa fa-map-marker getsiconpading" id="red-lcr" aria-hidden="true"></i> <font class="generic">Address :</font> </span>
			  </div>
			  <div class="col-md-6 my-info-first">
				<span><?php echo ucfirst($model->address); ?></span>
			  </div>
			  <div class="row"></div>
			  <div class="col-md-6 my-info-first">
				<span><i class="fa fa-at getsiconpading" id="yellow-lcr" aria-hidden="true"></i> <font class="generic">Email Address :</font> </span>
			  </div>
			  <div class="col-md-6 my-info-first">
				<span><?php $user_statusQuery = User::find()->select(['email'])->where(['id'=>$model->user_id])->one();
					echo $user_statusQuery->email;
					?>
				</span>
			  </div>
			  <div class="row"></div>
			  <div class="col-md-6 my-info-first">
				<span><i class="fa fa-sign-in getsiconpading" id="grey-lcr" aria-hidden="true"></i> <font class="generic">Last Login :</font> </span>
			  </div>
			  <div class="col-md-6 my-info-first">
				<span><?php

						$user_statusQuery = User::find()->select(['last_login'])->where(['id'=>$model->user_id])->one();
				   $stasdat =  $user_statusQuery->last_login; 
			   if(!empty($stasdat)){
				   $myd = date('d-M-Y', $stasdat);	
			   }else{
				   $myd = 'NA';
			   }
					
				   echo $myd;
				?>
				</span>
			  </div>
				
			  </div>
		  </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col -->
		<div class="class_width_thirty">
          <div class="box box-danger fixd_height_box">
		  <div class="box-header with-border">
              <h3 class="box-title">Communication Center <i class="fa fa-comments-o" id="red-lcr" aria-hidden="true"></i></h3>
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
					<?php $getassigned = AnnouncementsParent::find()->where(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['=','Academic_year_id',$academine['id']])->andwhere(['=','status','1'])->orderBy(['id' => SORT_DESC])->limit(5)->all();  
					
					 $mixing = '';
					$n = 1; $record = array();
						foreach($getassigned as $assgnmntd){
							$getclasd = ClassStudent::find()->where(['student_id'=>Yii::$app->user->identity->id])->andwhere(['=','Academic_year_id',$academine['id']])->one();
							
							$getclass_name = ClassInfo::find()->where(['id'=>$getclasd['class_id']])->one();
							
							$getstud = explode(',',$assgnmntd['student_id']);
							$getstudclass = explode(',',$assgnmntd['class_id']);
							$getstudsection = explode(',',$assgnmntd['section']);
							$userid = Yii::$app->user->identity->id;
							
							if((in_array($userid,$getstud)) || (in_array('0',$getstudclass)) || (in_array($getclass_name['class_name'],$getstudclass) && in_array('0',$getstudsection))){
					?>
						<tr>
							<td><a style="color : black;" href="<?php echo Yii::$app->homeUrl .'anouncements/student_index'; ?>"><?php echo ucfirst($assgnmntd['anouncement_title']);
										
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
					<?php if (count($record) == '5'){ ?>
					<tfoot><tr><td colspan="2" >
							<a style="float:right;" href="<?php echo Yii::$app->homeUrl .'anouncements/student_index'; ?>">View all >></a>
						</td></tr></tfoot> 
					<?php } ?>
			    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<?php 
if(Yii::$app->user->identity->role_id == 1){
				    $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->orderBy(['status' => SORT_DESC])->all();
				   }else{
					   $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->orderBy(['status' => SORT_DESC])->all();
				   } 
				   
				   foreach($academine as $academicyr) {
					   if($academicyr->status == '0'){
						   $marinspart = 'collapsed-box';
						   $pokws = 'fa-plus';
					   }else{
						   $marinspart = '';
						   $pokws = 'fa-minus';
					   }
				 
?>

	<div class="row">
				<div class="col-md-12">
				 <div class="box box-warning new_box_shadowing <?php echo $marinspart; ?>">
				  <div class="box-header with-border pointatin" data-widget="collapse">
					  <h3 class="box-title"><span><i class="fa fa-calendar gotheader" id="green-lcr" aria-hidden="true"></i> <b class="gotheader"><?php 
					  
					  echo $academicyr->academic_name . " : ".$academicyr->from ."-".$academicyr->to ; ?> </b></span>&nbsp;&nbsp;<span class="req-mar"><i class="fa fa-desktop gotheader" id="skyblue-lcr" aria-hidden="true"></i> <b class="gotheader"> <?php

					
				   $getclass = ClassStudent::find()->where(['student_id'=>$model->user_id])->andwhere(['Academic_year_id'=>$academicyr->id])->one();
				   $getclassname = ClassInfo::find()->where(['id'=>$getclass['class_id']])->one();
				   if(!empty($getclassname['class_name'])){
					  $nockout  = $getclassname['class_name'];
					   $myclassfind = AddClass::find()->where(['id'=>$nockout])->one();
					   $getclks = ucfirst($myclassfind['class_name']);
				   }else {
					   $getclks = 'NA';
				   }
				   
					$getclasssection = ClassStudent::find()->where(['student_id'=>$model->user_id])->andwhere(['Academic_year_id'=>$academicyr->id])->one();
				   $getclassnamesection = ClassInfo::find()->where(['id'=>$getclasssection['class_id']])->one();
					$getsubject = Section::find()->where(['id'=>$getclassnamesection['class_section']])->one();
					 if(!empty($getsubject['section_name'])){
					   $getsubjicts = ucfirst($getsubject['section_name']);
				   }else {
					   $getsubjicts = '';
				   }
					
				   
					echo "Class : ". $getclks. " " .$getsubjicts;
				?></b></span>&nbsp;&nbsp;<span class="req-mar"></span></h3>
					<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa <?php echo $pokws; ?>"></i>
                </button>
              </div>
					</div>
					<?php 
					
					
					
				   $getclass2 = ClassStudent::find()->where(['student_id'=>$model->user_id])->andwhere(['Academic_year_id'=>$academicyr->id])->one();
						
					$getclasssubject2 = ClassSubject::find()->where(['class_id'=>$getclass2['class_id']])->all();
					
					$getclasssinfo = Classinfo::find()->where(['id'=>$getclass2['class_id']])->one();
					
					
					?>
					<div class="box-body">
					   <table id="" class="table box-body table-bordered and_index_font">
						<thead>
						<tr>
						<th class="fntsize"><i class="fa fa-book" id="green-lcr" aria-hidden="true"></i> Subjects</th>
						<th class="fntsize"><i class="fa fa-user-o gotheader" id="green-lcr" aria-hidden="true"></i> Subject Teacher</th>
						
						<?php $getexam_id = FinalExam::find()->where(['class_id'=>$getclasssinfo['class_name']])->andwhere(['section_id'=>$getclasssinfo['class_section']])->andwhere(['=','academic_year',$academicyr->id])->all();
							foreach ($getexam_id as $main_exam_id){
						?>
						<th class="fntsize"><i class="fa fa-calendar" id="green-lcr" aria-hidden="true"></i><?php
							$get_inexam = AddExam::find()->where(['id'=>$main_exam_id->exam_id])->one();
							echo " ".ucfirst($get_inexam['exam_name'])."<br>";
							if($main_exam_id->marks_in == '0'){?>
								<table class="table margig-tabl table-bordered"> <tbody><tr><td>Obt. Marks</td><td>Max. Marks</td></tr></tbody> </table>
						<?php	} else {
							?>
							<table class="table margig-tabl table-bordered"> <tbody><tr><td>Grades</td></tr></tbody> </table>
						<?php }
							?>
						</th>
							<?php } ?>
						</thead>
						
						
						<tbody>
						<?php 
						if(!empty($getclasssubject2)){ 
							
										foreach($getclasssubject2 as $getiingsubjects) {
						?>
						<tr>
						<td><i class="fa fa-book" id="blue-lcr" aria-hidden="true"></i><?php
						$getjsub = Subject::find()->where(['id'=>$getiingsubjects->subject_id])->one();
						echo " ".ucfirst($getjsub['subject_name']); ?></td>
						<td>
						<?php $get_assigned_teacher = newStaffdata::find()->where(['user_id'=>$getiingsubjects->Assigned_teacher_id])->one();
	
						echo ucfirst($get_assigned_teacher['fname']) . " ". ucfirst($get_assigned_teacher['lname']);
						?>
						</td>
						<?php $getexam_id2 = FinalExam::find()->where(['class_id'=>$getclasssinfo['class_name']])->andwhere(['section_id'=>$getclasssinfo['class_section']])->andwhere(['=','academic_year',$academicyr->id])->all();
							foreach ($getexam_id2 as $main_exam_id2){
						?>
						<td>
						<?php
						
						$get_inexam2 = AddExam::find()->where(['id'=>$main_exam_id2->exam_id])->one();
							if($main_exam_id2->marks_in == '0'){
								$getnumbr = FinalExamGrading::find()->where(['student_id'=>$model->user_id])->andwhere(['=','final_exam_id',$main_exam_id2->id])->andwhere(['=','subject_id',$getiingsubjects->subject_id])->one(); 
								$getmaxnumbr = FinalExamSubjects::find()->where(['=','final_exam_id',$main_exam_id2->id])->andwhere(['=','subject_id',$getiingsubjects->subject_id])->one();
								?>
								<table class="table margig-tabl2 table-bordered"> <tbody><tr><td class="fixed_widt" ><?php if($getnumbr['marks'] != ''){echo $getnumbr['marks']; } else { echo "NA"; }  ?></td><td><?php echo $getmaxnumbr['maximum_marks']; ?></td></tr></tbody> </table>
								
							<?php }else {
								$getnumbr = FinalExamGrading::find()->where(['student_id'=>$model->user_id])->andwhere(['=','final_exam_id',$main_exam_id2->id])->andwhere(['=','subject_id',$getiingsubjects->subject_id])->one();
								if($getnumbr['grade'] !=''){ echo $getnumbr['grade']; }else { echo "NA"; } 
							}
						?>
						</td>
							<?php } ?>
						</tr>
						
						
					<?php } 	
					
					} else {
					
					?>
					
					<tr><td colspan="2" style="text-align : center;">No Record found</td></tr>
						 
					
					<?php } ?>
						</tbody>
						</table>
					</div>
					<!-- /.box-body -->
				  </div>
			  </div>
		</div>
				   <?php } ?>

</div>
