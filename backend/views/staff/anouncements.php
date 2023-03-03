<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Section;
use backend\models\AddClass;
use backend\models\AnnouncementsTeacher;
use yii\helpers\Url;
use backend\models\newStaffdata;
use common\models\User;
use backend\models\SchoolList;
use backend\models\AnnouncementsParent;
use backend\models\AcedemicYear;
use backend\models\ClassStudent;
use backend\models\ClassInfo;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Anouncements_search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');

	$this->title = 'Parent Announcements';
	$this->params['breadcrumbs'][] = $this->title;


?>
<style>
.first_hefd {
color: white !important;
display: block;
padding: 10px;
position: relative;
background-color: #F39c12 !important;
font-weight : 600;
}
.box-title {
	font-weight : 600;
}
.condenser_secodn {
	margin-top: 10px !important;
}
.condenser_secodn td:nth-child(3) {
	min-width: 265px !important;
}
.condenser_secodn td:nth-child(2) {
	min-width: 224px !important;
}



.condenser_secodn thead tr:nth-child(1) th a {
	color : black;
	
}
table.dataTable {
    border-collapse: collapse !important;
    border-spacing: 0;
}
</style>
<div class="anouncements-index">
 <?php  

  if((Yii::$app->user->identity->role_id == '5') || (Yii::$app->user->identity->role_id == '3')){ 
	
	$announcingms = AnnouncementsTeacher::find()->where(['status'=>1])->andwhere(['school_id'=>Yii::$app->user->identity->school_id])->all();
		foreach($announcingms as $ancmnts){
			
		$getdcas = explode(',',$ancmnts->announcements_to);	
		$user_id = Yii::$app->user->getId();
		if((in_array($user_id,$getdcas)) || (in_array(0,$getdcas))){
			?>
		<div id="w1-warning" class="alert-warning alert fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

			<i class="icon fa fa-circle-o"></i><?php echo ucfirst($ancmnts->anouncement_title) ."."; ?>
			<br/>
			<span style="font-size : 12px;"><?php echo ucfirst($ancmnts->anouncement_description) ."."; ?></span>
		</div>
	<?php	}
		}
 } ?>
 
 <?php 
		
 

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
	
 
 
 ?>
 

 
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box box-primary">
            <div class="box-header with-border">
             <?php 
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
			   echo "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class' => 'bord_img'])  
			    . "</div><div class='col-md-9 mar-left-non_secnd' style='margin-top: 25px;'> <span class='schl_spn' ><b> " . $model->fname  ." ". $model->lname  . "</b></span> </div>";
			 ?>
			   
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<table id="example1" class="table condenser_secodn table-striped table-bordered ">
				    <thead>
					  <tr>
						  <th>#</th>
						  <th>Title</th>
						  <th>Class</th>
						  <th>Section</th> 
						  <th>Status</th>
						  <th>Created Date</th>
						  <th>Action</th>
					  </tr>
				    </thead>
				    <tbody>
					<?php 
					if (Yii::$app->user->identity->role_id == 1) {
						
					$getassigned = AnnouncementsParent::find()->where(['=','school_id',Yii::$app->user->identity->id])->andwhere(['=','Academic_year_id',$presnt_acad])->andwhere(['=','created_by',$model->user_id])->orderBy(['id' => SORT_DESC])->all(); 

					}else {
						$getassigned = AnnouncementsParent::find()->where(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['=','Academic_year_id',$presnt_acad])->andwhere(['=','created_by',$id])->orderBy(['id' => SORT_DESC])->all();  
					}
					
					
					$i = 1;
						foreach($getassigned as $assgnmntd){
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php  $statu = $assgnmntd->anouncement_title;
				   
									echo ucfirst($statu); ?></td>
								<td>
									<?php 
									$getings=array();
								   $xclusion = explode(',',$assgnmntd->class_id);
								   if(in_array('0',$xclusion)){
									   $getings[] = 'All Classes';
								   }else {
									   foreach($xclusion as $mrge_class){
										$getclass = AddClass::find()->where(['id'=>$mrge_class])->one();
										$getings[] = $getclass['class_name'].", ";   
									   }
									 
								   }
								   $rerics = implode($getings);
								   echo $rerics;
									?>
								</td>
								<td>
									<?php 
									if(($assgnmntd->section == '0') || ($assgnmntd->section == '')){
									   $getingss = 'All Sections';
								   }else {
									  $getclasss = Section::find()->where(['id'=>$assgnmntd->section])->one();
									$getingss = $getclasss['section_name'];
								   }
								  
								   echo $getingss;
									?>
								</td>
								<td>
									<?php $statd = $assgnmntd->status;
									   if ($statd == '1'){
										   $jhs = '<span class="micond"><i class="fa fa-check-circle" aria-hidden="true"></i> Active</span>';
									   }
									   else {
										   $jhs = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Inactive</span>';
									   }
									   echo $jhs; ?>
								</td>
								<td><?php 

									 $statas = $assgnmntd->created;
									  $datetimeFormat = 'd-M-Y';

										$date = new \DateTime();
										// If you must have use time zones
										// $date = new \DateTime('now', new \DateTimeZone('Europe/Helsinki'));
										$date->setTimestamp($statas);
										
									   echo $date->format($datetimeFormat);

								?></td>
								<td>
								<?php  
								
								$gtr = '#myModal'.$assgnmntd->id;
								$url = Url::to(['#']);
								echo Html::a('<span class="fa fa-eye"></span>', $url , ['title' => 'view','data-toggle' => 'modal', 'data-target' => $gtr]);
								
								?>
								</td>
							</tr>
						<?php $i++;} ?>
				    </tbody>
			    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
<?php

	if(Yii::$app->user->identity->role_id == 1) {
		$geting = AnnouncementsParent::find()->where(['=', 'school_id', Yii::$app->user->getId()])->all();
		}else {
			$geting = AnnouncementsParent::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
		}
	foreach($geting as $getigd) {
  ?>		  
  <div class="modal fade" id="myModal<?php echo $getigd->id; ?>" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
          
          
        <div class="modal-body">
		<img class="mehrumsd" src="<?= Yii::getAlias('@base') ?>/uploads/pattis.png">
		<button type="button" class="close wintagr" data-dismiss="modal"></button> 
			<div class="row">
			
				<div class="col-md-12"> 
				<span class="title_ds"><?php echo $getigd->anouncement_title; ?></span>
				</div>
			
			</div>
			<div class="row">
		
				<div class="col-md-12 justficationas">
				<p><?php echo $getigd->anouncement_description; ?></p>
				</div>
			
			</div>
			
        </div>
        <div class="modal-footer ">
          <span> Created By :  <?php 
							$rolname ='';
				   $user_statusQuery = User::find()->where(['id'=>$getigd->created_by])->one();
				   $dx = '';
				   if($user_statusQuery['role_id'] == '1'){
					   $rolname = '(Principal)';
					   $staff_nme = SchoolList::find()->where(['school_user_id'=>$getigd->created_by])->one();
						$dx = $staff_nme['first_name'] . " " . $staff_nme['last_name']. " ".$rolname;
				   }else if($user_statusQuery['role_id'] == '2'){
					   $rolname = '(Vice Principal)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$getigd->created_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. " ".$rolname;
				   }else if($user_statusQuery['role_id'] == '3'){
					   $rolname = '(Co-Ordinator)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$getigd->created_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. " ".$rolname;
				   }else if($user_statusQuery['role_id'] == '4'){
					   $rolname = '(office Staff)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$getigd->created_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. " ".$rolname;
				   }
				   else if($user_statusQuery['role_id'] == '5'){
					   $rolname = '(Teacher)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$getigd->created_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']." ".$rolname;
				   }
				  
						
						echo  $dx; ?> </span>
        </div>
      </div>
    </div>
  </div>
							<?php }  ?>
		  
        </div>
        <!-- /.col -->
</div>


<?php

$this->registerJsFile(''.Yii::getAlias('@base').'/js/datesheet.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJs("$('#example1').dataTable( {
	'lengthChange': false,
  'ordering': false,
  'searching': false,
   pageLength: 20,
    lengthChange: false,
    drawCallback: function(settings){   
        if($(this).find('tbody tr').length <= 20){
            $('#example1_paginate').hide();
        }  
		if($(this).find('tbody tr').length == 1){
			$('#example1_info').hide();
        }
    },
	 'language': {
      'emptyTable': 'No Announcement available.'
    }
} );
  
  var miksit = $('#maksoders').val();
  
  if(miksit != '0' && miksit !=''){
	  var clikbler = '#clickmod'+miksit;
	  $(clikbler).trigger('click');
  }
  
");

$this->registerJsFile('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

 ?>
</div>
