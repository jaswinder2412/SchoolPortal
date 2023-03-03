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
use backend\models\AnnouncementsTeacher;
use backend\models\AnouncementTeachersUserids;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Staff_search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Manage Staff';
$this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->user->identity->role_id == 1) {
        $presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
    } else {
		$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
    }
?>
<style>
.table td:nth-child(2){
	min-width : 300px;
}
.modal-dialog {
	width : 750px !important;
}
.mehrumsd {
    width: 750px !important;
    margin-top: -44px;
    margin-left: -15px;
}
</style>
<div class="staff-index">
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
 } ?> 
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
			  <?= Html::a('Reset', ['staff/cordinator_staff'], ['class' => 'btn btn-info pull-right']) ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    

    <?php   echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
            
            [
			  'attribute' => 'fname',
			  'format' => 'raw',
			  'label' => 'Name',
			   'value' => function($model) {
				   if($model['image'] != ''){
					  $hdsd = $model['image'];
				   } else {
					    if(isset($model->gender)){
						   if($model->gender =='0'){
							   $hdsd = 'dummy-profile.png';
						   }
						   else{
							   $hdsd = '339959957.png.jpg';
						   }
					   }else {
						  $hdsd = 'dummy-profile.png'; 
					   }
				   }
				   $user_statusQuery = User::find()->select(['email'])->where(['id'=>$model->user_id])->one();
			   return "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','class' => 'bord_img'])  
			    . "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $model->fname  ." ". $model->lname  . "</span> <p class='schl_para'>" . $user_statusQuery->email . "<p></div>";
			   },
			],
           [
			  'attribute' => 'user_id',
			  'format' => 'raw',
			  'label' => 'Designation',
			  'filter'=>false,
			   'value' => function ($model) {
				   $user_statusQuery = User::find()->select(['role_id'])->where(['id'=>$model->user_id])->one();
				   $stat =  $user_statusQuery->role_id;
				   $jh='';
				   if ($stat == '2'){
					   $jh = 'Vice Principal';
				   }
				   elseif($stat == '3') {
					   $jh = 'Co-Ordinator';
				   }
				   elseif($stat == '4') {
					   $jh = 'Office Staff';
				   }
				   elseif($stat == '5') {
					   $jh = 'Teacher';
				   }else{
					   $jh='';
				   }
				   return $jh;
			   },
			],
			[
			  'attribute' => 'date_of_joining',
			  'format' => 'raw',
			  'label' => 'Date Of Joining',
			   'filter' => false,
			   'value' => function ($model) {
				   $date = new DateTime($model->date_of_joining);
					
				
				   return $date->format('d-M-Y');
			   },
			],
			[
			  'attribute' => 'dob',
			  'format' => 'raw',
			  'label' => 'Date Of Birth',
			  'filter' => false,
			   'value' => function ($model) {
				   $date = new DateTime($model->dob);
					
				   return $date->format('d-M-Y');
			   },
			],
			[
			  'attribute' => 'qualification',
			  'format' => 'raw',
			  'label' => 'Qualification',
			  'filter' => false,
			   'value' => function ($model) {
				   return $model->qualification;
			   },
			],
			
			[
			  'attribute' => 'last_login',
			  'format' => 'raw',
			  'label' => 'Last Login',
			   'value' => function ($model) {
				   $user_statusQuery = User::find()->select(['last_login'])->where(['id'=>$model->user_id])->one();
				   $stasdat =  $user_statusQuery->last_login; 
				   if(!empty($stasdat)){
					   $myd = date('d-M-Y', $stasdat);	
				   }else{
					   $myd = "NA";
				   }
					
				   return $myd;
			   },
			],
			[
			  'attribute' => 'status',
			  'format' => 'raw',
			  'label' => 'Status',
			  'filter'=>false,
			   'value' => function ($model) {
				   $user_statusQuery = User::find()->select(['status'])->where(['id'=>$model->user_id])->one();
				   $stat =  $user_statusQuery->status;
				   if ($stat == '10'){
					   $jh = '<span class="micond"><i class="fa fa-check-circle" aria-hidden="true"></i> Active</span>';
				   }
				   else {
					   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Inactive</span>';
				   }
				   return $jh;
			   },
			],
			[
			  'attribute' => 'last_updated_by',
			  'format' => 'raw',
			  'label' => 'Last Updated By',
			  'filter'=>false,
			   'value' => function ($model) {
				   $rolname ='';
				   $user_statusQuery = User::find()->where(['id'=>$model->last_updated_by])->one();
				   $dx = '';
				   if($user_statusQuery['role_id'] == '1'){
					   $rolname = '(Principal)';
					   $staff_nme = SchoolList::find()->where(['school_user_id'=>$model->last_updated_by])->one();
						$dx = $staff_nme['first_name'] . " " . $staff_nme['last_name']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '2'){
					   $rolname = '(Vice Principal)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$model->last_updated_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '3'){
					   $rolname = '(Co-Ordinator)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$model->last_updated_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '4'){
					   $rolname = '(office Staff)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$model->last_updated_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }
				   return $dx;
			   },
			],
			
         //  ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
		   [
			'class'    => 'yii\grid\ActionColumn',
			'template' => '{leadView}',
			'buttons'  => [
				'leadView'   => function ($url, $model) {
					$gtr = '#myModal'.$model->id;
					$url = Url::to(['#']);
					return Html::a('<span class="fa fa-eye"></span>', $url , ['title' => 'view','data-toggle' => 'modal', 'data-target' => $gtr]);
				},

			]
			],
        ],
    ]);  ?>
 </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div></div>

<?php 

if (Yii::$app->user->identity->role_id == 1) {
      $getstaffdta = newStaffdata::find()->where(['=', 'school_id', Yii::$app->user->getId()])->all();
    } else {
	$getstaffdta = newStaffdata::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
    }
	foreach($getstaffdta as $stafforgdata){
 ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $stafforgdata->id; ?>" role="dialog">
    <div class="modal-dialog modal-lg" >
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">
		<img class="mehrumsd" src="<?php echo Yii::getAlias('@base'); ?>/uploads/pattis.png">
		<button type="button" class="close wintagr" data-dismiss="modal"></button>
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
			
        </div>

      </div>
      
    </div>
  </div>	
	<?php } 
	
$this->registerJs("
$('#mybuttons').click(function(){
	var rel = $(this).attr('rel');
	
	
	$.ajax({
				type :'POST',
				data: {announceid: rel},
				url:'".Yii::getAlias('@base')."/anouncements/announcement_seen',
				success: function(response){
					
					console.log(response);
					location.reload();
					}
	});
	
});
  
");	
	
	?> 
	
	
			
	
	
		