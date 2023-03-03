<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\User;
use backend\models\newStaffdata;
use backend\models\SchoolList;
use backend\models\AcedemicYear;
use backend\models\ClassSubject;
use backend\models\ClassInfo;
use backend\models\AddClass;
use backend\models\Section;
use backend\models\Subject;
if (Yii::$app->user->identity->role_id == 1) {
        $presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
    } else {
		$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
    }
	
if (Yii::$app->user->identity->role_id == 1) {
      $getstaffdta = newStaffdata::find()->where(['=', 'id', $iid])->andwhere(['=', 'school_id', Yii::$app->user->getId()])->all();
    } else { 
	$getstaffdta = newStaffdata::find()->where(['=', 'id', $iid])->andwhere(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
	foreach($getstaffdta as $stafforgdata){
 ?>
  <!-- Modal -->
  
			<div class="row">
				<div class="col-md-6 border_rightd">
							<div class="row prof-upper-margin">
					  <div class="col-md-6">
					  <?php
						 if($stafforgdata->image != ''){
							  $hdsd = $stafforgdata->image;
						   } else {
							   if(isset($stafforgdata->gender)){
								   if($stafforgdata->gender =='0'){
									   $hdsd = 'dummy-profile.png';
								   }
								   else{
									   $hdsd = '339959957.png.jpg';
								   }
							   }else {
								  $hdsd = 'dummy-profile.png'; 
							   }
							   
							   
						   }
						 echo   Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','class' => 'profile-user-img img-responsive img-circle']); 
					  ?>
						
						
					  </div>
					  <div class="col-md-6 prof-name"> 
						<span class="anothring_font"><?php echo ucfirst($stafforgdata->fname) ." ". ucfirst($stafforgdata->lname); ?></span><br/>
						<?php
						 $user_statusQuery = User::find()->select(['status'])->where(['id'=>$stafforgdata->user_id])->one();
						   $stat =  $user_statusQuery['status'];
						   if ($stat == '10'){
							   $jh = '<span class="micond"><i class="fa fa-check-circle" aria-hidden="true"></i> Active Account</span>';
						   } else if(($stat == '2')) {
					   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Deactivated</span>';
				   }
						   else {
							   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Inactive Account</span>';
						   }
						   echo $jh;?>
						
					  </div>
					  </div>
					  <br/>
					<div class="row getupds">
					  
					  <div class="col-md-6 prsnl-info-first">
					  <span><i class="fa fa-calendar getsiconpading" id="yellow-lcr" aria-hidden="true"></i><font class="generic">DOB :</font> </span>
					  </div>
						<div class="col-md-6 prsnl-info"> 
						<span><?php  $date = new DateTime($stafforgdata->dob);
							 echo $date->format('d-M-Y'); ?></span>
						</div>
						<div class="row"></div>
						<div class="col-md-6 prsnl-info-first">
					  <span><i class="fa fa-user getsiconpading" id="red-lcr" aria-hidden="true"></i><font class="generic">Gender :</font> </span>
					  </div>
						<div class="col-md-6 prsnl-info"> 
						<span><?php  if($stafforgdata->gender == '0'){ echo "Male"; }else{ echo "Female"; } ?></span>
						</div>
						<div class="row"></div>
						<div class="col-md-6 prsnl-info-first">
					  <span><i class="fa fa-user-o getsiconpading" id="skyblue-lcr" aria-hidden="true"></i><font class="generic">Qualification :</font> </span>
					  </div>
					  
						<div class="col-md-6 prsnl-info"> 
						<span><?php  echo $stafforgdata->qualification; ?></span>
						</div>
						<div class="row"></div>
						<div class="col-md-6 prsnl-info-first">
						  <span><i class="fa fa-calendar getsiconpading" id="yellow-lcr" aria-hidden="true"></i><font class="generic">Date of joining :</font> </span>
						  </div>
						  
						<div class="col-md-6 prsnl-info"> 
						<span><?php  echo $stafforgdata->date_of_joining; ?></span>
						</div>
							<div class="row"></div>
						<div class="col-md-6 prsnl-info-first">
						  <span><i class="fa fa-tint getsiconpading" id="red-lcr" aria-hidden="true"></i><font class="generic">Blood Group :</font> </span>
						  </div>
						  
						<div class="col-md-6 prsnl-info"> 
						<span><?php  echo $stafforgdata->blood_group; ?></span>
						</div>
						<div class="row"></div>
					</div>
				</div>
			 
				
				<div class="col-md-6">
					 <div class="col-md-6 my-info-first">
						<span><i class="fa fa-desktop  getsiconpading" id="skyblue-lcr" aria-hidden="true"></i> <font class="generic">Designation :</font> </span>
					  </div>
					  <div class="col-md-6 my-info-first">
						<span><?php $user_statusQuery = User::find()->select(['role_id'])->where(['id'=>$stafforgdata->user_id])->one();
							if($user_statusQuery->role_id == '1'){
								echo 'Principal';
							}else if($user_statusQuery->role_id == '2'){
								echo 'Vice Principal';
							} else if($user_statusQuery->role_id == '3'){
								echo 'Co-Ordinator';
							} else if($user_statusQuery->role_id == '4'){
								echo 'Office Staff';
							} else if($user_statusQuery->role_id == '5'){
								echo 'Teacher';
							} 
							?>
						</span>
					  </div>
					  <div class="row"></div>
					 <div class="col-md-6 my-info-first">
						<span><i class="fa fa-user-o getsiconpading" id="yellow-lcr" aria-hidden="true"></i> <font class="generic">Specialization :</font> </span>
					  </div>
					  <div class="col-md-6 my-info-first">
						<span><?php 
							echo $stafforgdata->specializatin;
							?>
						</span>
					  </div>
					  <div class="row"></div>
					 <div class="col-md-6 my-info-first">
						<span><i class="fa fa-at getsiconpading" id="yellow-lcr" aria-hidden="true"></i> <font class="generic">Email Address :</font> </span>
					  </div>
					  
					  <div class="col-md-6 my-info-first">
						<span><?php $user_statusQuery = User::find()->select(['email'])->where(['id'=>$stafforgdata->user_id])->one();
							echo $user_statusQuery->email;
							?>
						</span>
					  </div>
					  <div class="row"></div>
					  <div class="col-md-6 my-info-first">
						<span><i class="fa fa-phone getsiconpading" id="green-lcr" aria-hidden="true"></i> <font class="generic">Phone Number :</font> </span>
					  </div>
					  <div class="col-md-6 my-info-first">
						<span><?php echo $stafforgdata->phone_number; ?>
						</span>
					  </div>
					  <div class="row"></div>
					  <div class="col-md-6 my-info-first">
						<span><i class="fa fa-phone getsiconpading" id="red-lcr" aria-hidden="true"></i> <font class="generic">Emergency No.:</font> </span>
					  </div>
					  <div class="col-md-6 my-info-first">
						<span><?php echo $stafforgdata->emergency_contact; ?>
						</span>
					  </div>
					  <div class="row"></div>
					  <div class="col-md-6 my-info-first">
						<span><i class="fa fa-user getsiconpading" id="red-lcr" aria-hidden="true"></i> <font class="generic">Address :</font> </span>
					  </div>
					  <div class="col-md-6 my-info-first">
						<span><?php echo $stafforgdata->address; ?>
						</span>
					  </div>
					  <div class="row"></div>
					 <div class="col-md-6 my-info-first">
						<span><i class="fa fa-sign-in getsiconpading" id="grey-lcr" aria-hidden="true"></i> <font class="generic">Last Login :</font> </span>
					  </div>
					  <div class="col-md-6 my-info-first">
						<span><?php

								$user_statusQuery = User::find()->select(['last_login'])->where(['id'=>$stafforgdata->user_id])->one();
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
					  <div class="row"></div>
				</div>
			</div>
			
			<div class="row" >  </div>
			
			<div class="row" > 
				<?php
					
					$user_statusQuery = User::find()->select(['role_id'])->where(['id'=>$stafforgdata->user_id])->one();
					if($user_statusQuery->role_id == '5'){
						?>
						<div class="col-md-12 uppermargin">
						<table class="table table-bordered table-stripped" >
							<thead>
								<th>Assigned Class</th>
								<th>Assigned Subjects</th>
							</thead>
							<tbody>
								<?php $exkertso = ClassSubject::find()->where(['Assigned_teacher_id'=> $stafforgdata->user_id])->andwhere(['=','academic_year',$presnt_acad['id']])->groupBy(['class_id'])->all(); 
									foreach($exkertso as $exertings){
								
								?>
								
								
								<tr>
									<td>
										
									  <?php $getclassnameonsec = ClassInfo::find()->where(['id'=>$exertings->class_id])->one(); 
									  
										$newcls_name = AddClass::find()->where(['id'=>$getclassnameonsec['class_name']])->one();
									 
									 $newsecsd_name = Section::find()->where(['id'=>$getclassnameonsec['class_section']])->one();
									  
									  echo $newcls_name['class_name']." ". $newsecsd_name['section_name']; 
									  
									  ?>
										
									</td>
									<td>
										<?php 
											$miklahas = ClassSubject::find()->where(['Assigned_teacher_id'=> $stafforgdata->user_id])->andwhere(['=','academic_year',$presnt_acad['id']])->andwhere(['=','class_id',$exertings->class_id])->all();
										foreach($miklahas as $hiklamas){
											
											$getsubj_name = Subject::find()->where(['id'=>$hiklamas->subject_id])->one();
											echo $getsubj_name['subject_name'].", ";
										}
										?>
									</td>
								</tr>
								
									<?php } ?>
								
							</tbody>
						</table>
						</div>
						
					<?php	} 	?>
			</div>
			
    
	<?php } ?>