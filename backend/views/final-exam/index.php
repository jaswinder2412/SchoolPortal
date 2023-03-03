<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\models\ClassInfo;
use backend\models\ClassSubject;
use backend\models\Subject;
use backend\models\AcedemicYear;
use backend\models\Section;
use backend\models\AddClass;
use backend\models\AddExam;
use backend\models\FinalExam;
use common\models\User;
use backend\models\SchoolList;
use backend\models\newStaffdata; 
use backend\models\FinalExamSubjects;
use backend\models\AnnouncementsTeacher;
use yii\helpers\Url;
use backend\models\AnouncementTeachersUserids;
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FinalExam_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Exams';
$this->params['breadcrumbs'][] = $this->title;
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
        $meteo[$goclass['id']] = ucfirst($goclass['class_name']);
    }
	
	
	$examinsd = array();
    if (Yii::$app->user->identity->role_id == 1) {
        $newexm = AddExam::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->all();
    } else { 
        $newexm = AddExam::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
    foreach ($newexm as $newexamm) {
        
        $examinsd[$newexamm->id] = ucfirst($newexamm->exam_name);
    }
?>

<style>
.table td:last-child {
    min-width: 64% !important;
}

.customgrinds td:first-child {
     min-width: 12% !important; 
}

.customgrinds td {
     border: 2px solid #D5DEE5 !important;
}

.customgrinds th {
     border: 2px solid #D5DEE5 !important;
}

.marjuin td:last-child {
    min-width: 70% !important;
}

.marjuin td:first-child {
    min-width: 9% !important;
}

.marjuin td:nth-child(2) {
    min-width: 10% !important;
}

.marjuin td {
	border: 1px solid #BFBDBD !important;
}

.marjuin th {
	border: 1px solid #BFBDBD !important;
}

.tablsubmid td:last-child {
    min-width: 20% !important;
}

.tablsubmid td:first-child {
    min-width: 15% !important;
}

.tablsubmid td {
     border: 1px solid #CFCDCE !important;
}

.tablsubmid th {
     border: 1px solid #CFCDCE !important;
}

</style>
<div class="final-exam-index">
<?php  if((Yii::$app->user->identity->role_id == '5') || (Yii::$app->user->identity->role_id == '3')){ 

	$announcingms = AnnouncementsTeacher::find()->where(['status'=>1])->andwhere(['school_id'=>Yii::$app->user->identity->school_id])->all();
		foreach($announcingms as $ancmnts){
			
			$myanounces = AnouncementTeachersUserids::find()->where(['=','announcement_id',$ancmnts->id])->andwhere(['=','teacher_id',Yii::$app->user->getId()])->andwhere(['=','seen',0])->count();
		
		if($myanounces > 0){
			?>
		<div id="w1-warning" class="alert-warning alert fade in">
			<button type="button" rel="<?php echo $ancmnts->id; ?>" class="close" data-dismiss="alert" aria-hidden="true" id="mybuttons">x</button>

			<i class="icon fa fa-circle-o"></i><?php echo ucfirst($ancmnts->anouncement_title) ."."; ?>
			<br/>
			<span style="font-size : 12px;"><?php echo ucfirst($ancmnts->anouncement_description) ."."; ?></span>
		</div>
	<?php	}
		}
 }  ?> 
 <div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
			  <?php if(Yii::$app->user->identity->role_id != 5) { ?>
			  <a class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal" href="#">Create</a>
			  <?php } ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			
	 <div> 
		  <?php $form = ActiveForm::begin(['id' => 'toggle-search']); ?>
			<select name="slection_exam" id="getselectionexam">
			<?php if(isset($exmserch_id)){
				$keys = $exmserch_id;
			}else {
				$keys = '0';
			} 
			
				if($keys == '0'){
					$milokiwer = "selected = 'selected'";
				}else {
					$milokiwer = "";
				}
			
			?>
				<option value="0" <?php echo $milokiwer; ?>>All Select</option>
				<?php
				
				if(Yii::$app->user->identity->role_id == 1) {
					$mistiquesr = FinalExam::find()->where(['=', 'school_id', Yii::$app->user->getId()])->andwhere(['=','academic_year',$getacadid])->groupBy(['exam_id'])->orderBy(['id' => SORT_DESC])->all();
				}else{
					$mistiquesr = FinalExam::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$getacadid])->groupBy(['exam_id'])->orderBy(['id' => SORT_DESC])->all();
				}
				foreach($mistiquesr as $mastrmingd){
					if($keys == $mastrmingd->exam_id){
						$mikilwer = "selected = 'selected'";
					}
					else {
						$mikilwer = "";
					}
				$getexmnmer = AddExam::find()->where(['id'=>$mastrmingd->exam_id])->one();
				 ?>
				<option value="<?php echo $mastrmingd->exam_id; ?>" <?php echo $mikilwer; ?>><?php echo ucfirst($getexmnmer['exam_name']); ?></option>
				<?php } ?>
			</select>
			
			<div class="button-group">
                    <button type="submit" style="display:none;" class="oceanSearch" name="signup-button">Search  </button>
                </div>
            <?php ActiveForm::end(); 
			
				 
				 
			
			?>
	 </div>
					<?php if(isset($exmserch_id) && $exmserch_id != '0'){ ?>
		  <div class='main_parentsdf'>
				  <table id='mintabl' class='table table-striped table-bordered marjuin '>
								<thead>
									<?php if(isset($exmserch_id)){
										$maximun = $exmserch_id;
										$agexqms = AddExam::find()->where(['id'=>$exmserch_id])->one();
									?>
									<tr style="background: beige;">
										<th colspan="3"><?php echo "<b style='color :  darkorange;'> Exam Name : ".ucfirst($agexqms['exam_name'])."</b>"; ?></th>
									</tr>
									<?php } ?>
									
								</thead>
								<tbody>
				 <?php   
				 
					
					
					$maximun = $exmserch_id;
					 $getexamclassname = FinalExam::find()->where(['exam_id'=>$maximun])->andwhere(['=','academic_year',$getacadid])->groupBy(['class_id'])->orderBy(['id' => SORT_DESC])->all();
				
				$monarm = array();
				if(!empty($getexamclassname)){
				   foreach($getexamclassname as $maxima){
					   
					   ?>
				<tr>
				   
				<td>
					<table class='table table-striped table-bordered'>
									<thead>
										<tr>
											<th>Class Name</th>
											<th>Exam Marks In</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<?php $adgetd = AddClass::find()->where(['id'=>$maxima->class_id])->one();
												echo ucfirst($adgetd['class_name']); ?>
											</td>
											<td>
												<?php 
												if($maxima->marks_in == '0'){
													$trimas = 'Numbers';
												}else{
													$trimas = 'Grades';
												}
												echo $trimas;
												?>
											</td>
										</tr>
									</tbody>
					</table>
					
					
				</td>
					
				
					
				<td>
					<table class='table table-striped table-bordered tablsubmid'>
						<thead><tr>
							<th>Section</th>
							<th>Subject</th>
							<th>Exam Date</th>
							<th>Last Updated By</th>
							<th>Action</th>
						</tr></thead>
						<tbody>
						<?php
						$getexamsectionsname = FinalExam::find()->where(['exam_id'=>$maximun])->andwhere(['class_id'=>$maxima->class_id])->andwhere(['=','academic_year',$getacadid])->all();
						foreach($getexamsectionsname as $mikilan){
							
							?>
					<tr>
				   
							<td>
									<?php
									$getsectionname = Section::find()->where(['id'=>$mikilan->section_id])->one();
									echo ucfirst($getsectionname['section_name']);
									?>
							</td>	 
							
								<?php
									if ($mikilan->section_id!='0'){
										  $getingsection_first = ClassInfo::find()->where(['class_name'=>$mikilan->class_id])->andwhere(['=','class_section',$mikilan->section_id])->andwhere(['=','academic_year',$mikilan->academic_year])->one();
									  }else {
										  $getingsection_first = ClassInfo::find()->where(['class_name'=>$mikilan->class_id])->andwhere(['=','academic_year',$mikilan->academic_year])->one(); 
									  }
									$getingsection = ClassSubject::find()->where(['class_id'=>$getingsection_first['id']])->all();
								?>
							<td>
							
									<?php
									$iks = 1;
									foreach($getingsection as $key => $sectionwise) {
						
									$getsections_name = Subject::find()->where(['id'=>$sectionwise->subject_id])->one();
									
									$getsections_date = FinalExamSubjects::find()->where(['final_exam_id'=>$mikilan->id])->andwhere(['=','academic_year',$getacadid])->andwhere(['subject_id'=>$sectionwise->subject_id])->one();
									
									echo ucfirst($getsections_name['subject_name']). "<br/>";
									
									}
									?>
							</td>
							
							<td>
								<?php
									$ikt = 1;
									foreach($getingsection as $key => $sectionwises) {
						
									$getsections_name = Subject::find()->where(['id'=>$sectionwises->subject_id])->one();
									
									$getsections_dates = FinalExamSubjects::find()->where(['final_exam_id'=>$mikilan->id])->andwhere(['=','academic_year',$getacadid])->andwhere(['subject_id'=>$sectionwises->subject_id])->one();
									if($getsections_dates['exam_date'] != ''){
										$newDatesd = date("d-M-Y", strtotime($getsections_dates['exam_date']));
									}
									else {
										$newDatesd = 'NA';
									}
									
									echo $newDatesd. "<br/>";
									
									}
								?>
							
							</td>
							<td>
								<?php
								
									$getlastds = FinalExamSubjects::find()->where(['final_exam_id'=>$mikilan->id])->andwhere(['=','academic_year',$getacadid])->one();
									$rolname ='';
								   $user_statusQuery = User::find()->where(['id'=>$getlastds['last_updated_by']])->one();
								   $dx = 'NA';
								   if($user_statusQuery['role_id'] == '1'){
									   $rolname = '(Principal)';
									   $staff_nme = SchoolList::find()->where(['school_user_id'=>$getlastds->last_updated_by])->one();
										$dx = $staff_nme['first_name'] . " " . $staff_nme['last_name']. "<p class='schl_para'>".$rolname."</p>";
								   }else if($user_statusQuery['role_id'] == '2'){
									   $rolname = '(Vice Principal)';
									   $staff_nme = newStaffdata::find()->where(['user_id'=>$getlastds->last_updated_by])->one();
										$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
								   }else if($user_statusQuery['role_id'] == '3'){
									   $rolname = '(Co-Ordinator)';
									   $staff_nme = newStaffdata::find()->where(['user_id'=>$getlastds->last_updated_by])->one();
										$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
								   }else if($user_statusQuery['role_id'] == '4'){
									   $rolname = '(office Staff)';
									   $staff_nme = newStaffdata::find()->where(['user_id'=>$getlastds->last_updated_by])->one();
										$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
								   }
									
							
							
									echo $dx;
									?>
							</td>
						
							<td>
							<?php if(Yii::$app->user->identity->role_id == 5) { ?>
								<a href='/final-exam/add_marks?id=<?php echo$mikilan->id; ?>' data-method='post' >
									<i class="fa fa-file-text-o" aria-hidden="true" 
									style="font-size: 16px;"></i>
								</a> 
						<?php } else { ?>
								
								<?php if($getacadid == $mikilan->academic_year){ ?>
								<a href='#' title='Update' data-toggle='modal' data-target='#mysecondModal<?php echo $mikilan->id; ?>'>
									<span class='glyphicon glyphicon-pencil'></span>
								</a>
								
								<?php } ?>
								<a href='/final-exam/add_marks?id=<?php echo$mikilan->id; ?>' title='Marks' data-method='post' >
									<i class="fa fa-file-text-o" aria-hidden="true" 
									style="font-size: 16px;"></i>
								</a> 
								<?php $minhaksder = FinalExamSubjects::find()->where(['final_exam_id'=>$mikilan->id])->count();
								
								if($minhaksder == 0){
								?>
								
								<a href='/final-exam/delete?id=<?php echo $mikilan->id; ?>' title='Delete' data-confirm='Are you sure you want to delete this item?' data-method='post'>
									<span class='fa fa-trash' style="font-size: 17px;"></span>
								</a> 
								<?php } ?>
						<?php } ?> 
							</td>
					</tr>
				<?php   }  ?>
						
						</tbody>
					</table>
				</td>
				</tr>



				<?php	} }else { ?>
				<tr><td colspan="3" style="text-align : center;">No Exam Found</td></tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
				 
				 <?php
					}
					else{ 
			?>
			<div class='main_parentsdf'>
				  <table id='mintabl' class='table table-striped table-bordered marjuin '>
								
								<tbody>
			<?php
					 if(Yii::$app->user->identity->role_id == 1) {
						 
					$mistiquesra = FinalExam::find()->where(['=', 'school_id', Yii::$app->user->getId()])->andwhere(['=','academic_year',$getacadid])->groupBy(['exam_id'])->orderBy(['id' => SORT_DESC])->all();
					
					}
					else
					{
						$mistiquesra = FinalExam::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$getacadid])->groupBy(['exam_id'])->orderBy(['id' => SORT_DESC])->all();
					}
					if(!empty($mistiquesra)){
					foreach ($mistiquesra as $makintoshd){
						$maximun = $makintoshd->exam_id;
						?>
						 <tr style="background: beige;">
						   <td colspan="3">
						   <?php 
						   $agexqmsize = AddExam::find()->where(['id'=>$maximun])->one();
								echo "<b style='color :  darkorange;'> Exam Name : ".ucfirst($agexqmsize['exam_name'])."</b>";
						   ?> 
						   </td>
					   </tr>
					   <?php
						$getexamclassname = FinalExam::find()->where(['exam_id'=>$maximun])->andwhere(['=','academic_year',$getacadid])->groupBy(['class_id'])->orderBy(['id' => SORT_DESC])->all();
						$monarm = array();
						
				   foreach($getexamclassname as $maxima){
					   
					   ?>
					  
				<tr> 
				     
				<td>
					<table class='table table-striped table-bordered'>
									<thead>
										<tr>
											<th>Class Name</th>
											<th>Exam Marks In</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<?php $adgetd = AddClass::find()->where(['id'=>$maxima->class_id])->one();
												echo ucfirst($adgetd['class_name']); ?>
											</td>
											<td>
												<?php 
												if($maxima->marks_in == '0'){
													$trimas = 'Numbers';
												}else{
													$trimas = 'Grades';
												}
												echo $trimas;
												?>
											</td>
										</tr>
									</tbody>
					</table>
					
					
				</td>					
				<td>
					<table class='table table-striped table-bordered tablsubmid'>
						<thead><tr>
							<th>Section</th>
							<th>Subject</th>
							<th>Exam Date</th>
							<?php if($maxima->marks_in == '0'){ ?>
							<th>Maximum Marks</th>
							<?php } ?>
							<th>Last Updated By</th>
							<th>Action</th>
						</tr></thead>
						<tbody>
						<?php
						$getexamsectionsname = FinalExam::find()->where(['exam_id'=>$maximun])->andwhere(['class_id'=>$maxima->class_id])->andwhere(['=','academic_year',$getacadid])->all();
						foreach($getexamsectionsname as $mikilan){
							
							?>
						<tr>
				   
							<td>
									<?php
									$getsectionname = Section::find()->where(['id'=>$mikilan->section_id])->one();
									echo ucfirst($getsectionname['section_name']);
									?>
							</td>	 
							
								<?php
									if ($mikilan->section_id!='0'){
										  $getingsection_first = ClassInfo::find()->where(['class_name'=>$mikilan->class_id])->andwhere(['=','class_section',$mikilan->section_id])->andwhere(['=','academic_year',$mikilan->academic_year])->one();
									  }else {
										  $getingsection_first = ClassInfo::find()->where(['class_name'=>$mikilan->class_id])->andwhere(['=','academic_year',$mikilan->academic_year])->one(); 
									  }
									$getingsection = ClassSubject::find()->where(['class_id'=>$getingsection_first['id']])->all();
								?>
							<td>
							
									<?php
									$iks = 1;
									foreach($getingsection as $key => $sectionwise) {
						
									$getsections_name = Subject::find()->where(['id'=>$sectionwise->subject_id])->one();
									
									$getsections_date = FinalExamSubjects::find()->where(['final_exam_id'=>$mikilan->id])->andwhere(['=','academic_year',$getacadid])->andwhere(['subject_id'=>$sectionwise->subject_id])->one();
									
									echo ucfirst($getsections_name['subject_name']). "<br/>";
									
									}
									?>
							</td>
							
							<td>
								<?php
									$ikt = 1;
									foreach($getingsection as $key => $sectionwises) {
						
									$getsections_name = Subject::find()->where(['id'=>$sectionwises->subject_id])->one();
									
									$getsections_dates = FinalExamSubjects::find()->where(['final_exam_id'=>$mikilan->id])->andwhere(['=','academic_year',$getacadid])->andwhere(['subject_id'=>$sectionwises->subject_id])->one();
									if($getsections_dates['exam_date'] != ''){
										$newDatesd = date("d-M-Y", strtotime($getsections_dates['exam_date']));
									}
									else {
										$newDatesd = 'NA';
									}
									
									echo $newDatesd. "<br/>";
									
									}
								?>
							
							</td>
							<?php if($mikilan->marks_in == '0'){ ?>
							<td>
								<?php
									$ikt = 1;
									foreach($getingsection as $key => $sectionwisess) {
						
									$getsections_name = Subject::find()->where(['id'=>$sectionwisess->subject_id])->one();
									
									$getsections_marks = FinalExamSubjects::find()->where(['final_exam_id'=>$mikilan->id])->andwhere(['=','academic_year',$getacadid])->andwhere(['subject_id'=>$sectionwisess->subject_id])->one();
									if($getsections_marks['maximum_marks'] != ''){
										$newmark = $getsections_marks['maximum_marks'];
									}
									else {
										$newmark = 'NA';
									}
									
									echo $newmark. "<br/>";
									
									}
								?>
							
							</td>
							<?php } ?>
							<td>
								<?php
								
									$getlastds = FinalExamSubjects::find()->where(['final_exam_id'=>$mikilan->id])->andwhere(['=','academic_year',$getacadid])->one();
									$rolname ='';
								   $user_statusQuery = User::find()->where(['id'=>$getlastds['last_updated_by']])->one();
								   $dx = 'NA';
								   if($user_statusQuery['role_id'] == '1'){
									   $rolname = '(Principal)';
									   $staff_nme = SchoolList::find()->where(['school_user_id'=>$getlastds->last_updated_by])->one();
										$dx = $staff_nme['first_name'] . " " . $staff_nme['last_name']. "<p class='schl_para'>".$rolname."</p>";
								   }else if($user_statusQuery['role_id'] == '2'){
									   $rolname = '(Vice Principal)';
									   $staff_nme = newStaffdata::find()->where(['user_id'=>$getlastds->last_updated_by])->one();
										$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
								   }else if($user_statusQuery['role_id'] == '3'){
									   $rolname = '(Co-Ordinator)';
									   $staff_nme = newStaffdata::find()->where(['user_id'=>$getlastds->last_updated_by])->one();
										$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
								   }else if($user_statusQuery['role_id'] == '4'){
									   $rolname = '(office Staff)';
									   $staff_nme = newStaffdata::find()->where(['user_id'=>$getlastds->last_updated_by])->one();
										$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
								   }
									
							
							
									echo $dx;
									?>
							</td>
						
							<td>
							<?php if(Yii::$app->user->identity->role_id == 5) { ?>
								<a href='/final-exam/add_marks?id=<?php echo$mikilan->id; ?>' data-method='post' >
									<i class="fa fa-file-text-o" aria-hidden="true" 
									style="font-size: 16px;"></i>
								</a> 
							<?php } else { ?>
								 
								<?php if($getacadid == $mikilan->academic_year){ ?>
								<a href='#' title='Update' data-toggle='modal' data-target='#mysecondModal<?php echo $mikilan->id; ?>'>
									<span class='glyphicon glyphicon-pencil'></span>
								</a>
								<?php } ?> 
								<a href='/final-exam/add_marks?id=<?php echo$mikilan->id; ?>' title='Marks' data-method='post' >
									<i class="fa fa-file-text-o" aria-hidden="true" 
									style="font-size: 16px;"></i>
								</a>
								<?php $minhaksder = FinalExamSubjects::find()->where(['final_exam_id'=>$mikilan->id])->count(); 
								if($minhaksder == 0){
								?>
								<a href='/final-exam/delete?id=<?php echo$mikilan->id; ?>' title='Delete' data-confirm='Are you sure you want to delete this item?' data-method='post'>
									<span class='fa fa-trash' style="font-size: 17px;"></span>
								</a>
								
							<?php } } ?>
								
							</td>
						</tr>
				<?php   }  ?>
						
						</tbody>
					</table>
				</td>
				</tr>
						
						
					<?php 	} } } else { ?>
					<tr><td colspan="3" style="text-align : center;">No Exam Found</td></tr>	
					<?php } 
					 
					 ?>
					 </tbody>
				 </table>
			 </div>
					 
			<?php	}
					
				 ?>  
				   
				
		</div>
					
				
			
			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
	</div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Exam</h4>
        </div>
        <div class="modal-body">
              <?php $form = ActiveForm::begin(); ?>

			<?= $form->field($model, 'exam_id')->dropDownList($examinsd,['prompt' => 'Please Select']) ?>

				<?= $form->field($model, 'class_id')->dropDownList($meteo,['prompt' => 'Please Select']) ?>
				
				<div class="apnds_classing"></div>
				<div class="help-block_second chkbxs"> Please choose atleast one section. </div>
				
			<?= $form->field($model, 'marks_in')->radioList(array('0'=>'In Numbers','1'=>'In Grades'));  ?>
    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success','id' => 'checkBtn']) ?>
		<button  class="btn btn-default " type="button" data-dismiss="modal">Cancel</button>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </div>
  
  <?php

	  if (Yii::$app->user->identity->role_id == 1) {
		$getfinal = FinalExam::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->all();
    } else {
		$getfinal = FinalExam::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
	
	foreach ($getfinal as $getfinalexma){
   ?>
  
	<div class="modal fade" id="mysecondModal<?php echo $getfinalexma->id; ?>" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Exam Date</h4>
        </div>
        <div class="modal-body mint_one">
          <?php 
		  if ($getfinalexma['section_id'] !='0'){
			  $getingsection_first = ClassInfo::find()->where(['class_name'=>$getfinalexma['class_id']])->andwhere(['=','class_section',$getfinalexma['section_id']])->andwhere(['=','academic_year',$getfinalexma['academic_year']])->one();
		  }else {
			  $getingsection_first = ClassInfo::find()->where(['class_name'=>$getfinalexma['class_id']])->andwhere(['=','academic_year',$getfinalexma['academic_year']])->one();
		  }
				
				
		
		
		$getingsection = ClassSubject::find()->where(['class_id'=>$getingsection_first['id']])->all();
		
		$ik = 1;
		
		
		$getsections_date_count = FinalExamSubjects::find()->where(['final_exam_id'=>$getfinalexma->id])->count();
		
		foreach($getingsection as $key => $sectionwise) {
		
			$getsections_name = Subject::find()->where(['id'=>$sectionwise->subject_id])->one();
			
			$getsections_date = FinalExamSubjects::find()->where(['final_exam_id'=>$getfinalexma->id])->andwhere(['subject_id'=>$sectionwise->subject_id])->one();
			?>
			<div class="row myvalids">
			<?php if($getfinalexma->marks_in == '0'){ ?>
			  <div class="col-md-4">
			  <div class="form-group field-finalexamsubjects-subject_id gteror">
				  <label class="control-label" for="finalexamsubjects-subject_id">Subject</label>
                <input id="newsubject_id_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control" name="FinalExamSubjects[subject_id][]" value="<?php echo ucfirst($getsections_name['subject_name']); ?>" readonly="readonly" aria-invalid="false" type="text">
				
				<input id="newsubjesact_id_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control subgtc" name="FinalExsamSubjects[subject_id][]" value="<?php echo $sectionwise->subject_id; ?>" type="hidden">	
				
				<input id="Assigned_teacher_id<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control assigning_tech" name="FinalExsamSubjects[Assigned_teacher_id][]" value="<?php echo $sectionwise->Assigned_teacher_id; ?>" type="hidden">	
					<div class="help-block_second"></div> 
				</div>				
			  </div> 
			<?php } else { ?>
				<div class="col-md-6">
			  <div class="form-group field-finalexamsubjects-subject_id gteror">
				  <label class="control-label" for="finalexamsubjects-subject_id">Subject</label>
                <input id="newsubject_id_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control" name="FinalExamSubjects[subject_id][]" value="<?php echo ucfirst($getsections_name['subject_name']); ?>" readonly="readonly" aria-invalid="false" type="text">
				
				<input id="newsubjesact_id_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control subgtc" name="FinalExsamSubjects[subject_id][]" value="<?php echo $sectionwise->subject_id; ?>" type="hidden">	
				
				<input id="Assigned_teacher_id<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control assigning_tech" name="FinalExsamSubjects[Assigned_teacher_id][]" value="<?php echo $sectionwise->Assigned_teacher_id; ?>" type="hidden">	
					<div class="help-block_second"></div> 
				</div>				
			  </div> 
			<?php } if($getsections_date_count != 0){ 
			if($getfinalexma->marks_in == '0'){ ?>
				<div class="col-md-4">
				<div class="form-group field-finalexamsubjects-exam_date gteror">
					<label class="control-label" for="finalexamsubjects-exam_date">Exam Date</label> 
					<input id="newsexam_date_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control exm_dts" name="FinalExamSubjects[exam_date][]" aria-invalid="false" value="<?php echo $getsections_date['exam_date'] ?>" type="text">

					<div class="help-block_second"></div>
				</div>
			  </div>
				<?php } else { ?>
				<div class="col-md-6">
				<div class="form-group field-finalexamsubjects-exam_date gteror">
					<label class="control-label" for="finalexamsubjects-exam_date">Exam Date</label> 
					<input id="newsexam_date_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control exm_dts" name="FinalExamSubjects[exam_date][]" aria-invalid="false" value="<?php echo $getsections_date['exam_date'] ?>" type="text">

					<div class="help-block_second"></div>
				</div>
			  </div>
				<?php } ?>
				
			  <?php if($getfinalexma->marks_in == '0'){ ?>
			  <div class="col-md-4">
				<div class="form-group field-finalexamsubjects-maximumarks gteror">
					<label class="control-label" for="finalexamsubjects-maximumarks">Maximum Marks</label> 
					<input id="newsmaximum_marks_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control max_marks" name="FinalExamSubjects[maximum_marks][]" aria-invalid="false" value="<?php echo $getsections_date['maximum_marks'] ?>" type="text">

					<div class="help-block_second"></div>
				</div>
			  </div>
			   <?php } ?>
				<?php } else {
				if($getfinalexma->marks_in == '0'){
				?>
				<div class="col-md-4">
				<div class="form-group field-finalexamsubjects-exam_date gteror">
					<label class="control-label" for="finalexamsubjects-exam_date">Exam Date</label> 
					<input id="newsexam_date_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control exm_dts" name="FinalExamSubjects[exam_date][]" aria-invalid="false" type="text">

					<div class="help-block_second"></div>
				</div>
			  </div>
				<?php } else{ ?>
				<div class="col-md-6">
				<div class="form-group field-finalexamsubjects-exam_date gteror">
					<label class="control-label" for="finalexamsubjects-exam_date">Exam Date</label> 
					<input id="newsexam_date_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control exm_dts" name="FinalExamSubjects[exam_date][]" aria-invalid="false" type="text">

					<div class="help-block_second"></div>
				</div>
			  </div>
				<?php } if($getfinalexma->marks_in == '0'){ ?>
			   <div class="col-md-4">
				<div class="form-group field-finalexamsubjects-maximumarks gteror">
					<label class="control-label" for="finalexamsubjects-maximumarks">Maximum Marks</label> 
					<input id="newsmaximum_marks_<?php echo $getfinalexma->id."_".$ik; ?>" class="form-control max_marks" name="FinalExamSubjects[maximum_marks][]" aria-invalid="false" value="" type="text">

					<div class="help-block_second"></div>
				</div>
			  </div>
			  <?php } ?>
			  
				<?php } ?>
				 
			
				
			</div>
				<?php
				$ik++;
		}
		
		  ?>   
		  <button id="newdmodal_<?php echo $getfinalexma->id; ?>" class="btn btn-success add_subjectsd">Save</button>
			<button  class="btn btn-default " type="button" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>
	
	<?php } ?>
	
	
</div> 

<?php 
 $this->registerJs("
$('#mybuttons').click(function(){
	var rel = $(this).attr('rel');
	
	
	$.ajax({
				type :'POST',
				data: {announceid: rel},
				url:'/anouncements/announcement_seen',
				success: function(response){
					
					console.log(response);
					
					}
	});
	
});
  
");
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/final_exams.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

?>