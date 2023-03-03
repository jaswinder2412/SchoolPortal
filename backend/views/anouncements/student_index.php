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
use backend\models\AnouncementTeachersUserids;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Anouncements_search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
if(Yii::$app->user->identity->role_id == '6'){
	$this->title = '';
}else{
	$this->title = 'Parent Announcements';
	$this->params['breadcrumbs'][] = $this->title;
}

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
.condenser_secodn td:nth-child(1) {
	min-width: 120px !important;
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
 
 <?php if(Yii::$app->user->identity->role_id == '6'){
 	if(isset($assignid) && !empty($assignid)){
		?>
		<input type="hidden" name='madsookd' id='maksoders' value='<?php echo $assignid; ?>'>
		
	<?php }
 
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

<div class="row"></div><div class="row"></div>
 
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box box-primary">
            <div class="box-header with-border">
             <h3 class="box-title">Important Announcements</h3>
			   
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<table id="example1" class="table condenser_secodn table-striped table-bordered ">
				    <thead>
					  <tr>
						  <th>Created Date</th>
						  <th>Announcement Title</th>
						  <th>Created By</th>
						 
						  <th>Action</th>
					  </tr>
				    </thead>
				    <tbody>
					<?php $getassigned = AnnouncementsParent::find()->where(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['=','Academic_year_id',$presnt_acad])->andwhere(['=','status','1'])->orderBy(['id' => SORT_DESC])->all();  
					$i = 1;
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
							<td><?php
									$timestamp= $assgnmntd['created'];
									echo gmdate("d-M-Y", $timestamp); ?>
							</td>
							<td> <?php  $stat = "<b>".ucfirst($assgnmntd->anouncement_title)."</b>";
							  $gudghs = substr($assgnmntd->anouncement_description, 0, 150); 
							   $stat.= "<br/>".strip_tags($gudghs)."..."; 
							   echo $stat; ?>
							</td> 
							<td>
									<?php 
							  $rolname ='';
				   $user_statusQuery = User::find()->where(['id'=>$assgnmntd->created_by])->one();
				   $dx = '';
				   if($user_statusQuery['role_id'] == '1'){
					   $rolname = '(Principal)';
					   $staff_nme = SchoolList::find()->where(['school_user_id'=>$assgnmntd->created_by])->one();
					   
						   if($staff_nme['image'] != ''){
							  $hdsd = $staff_nme['image'];
						   } else {
							   $hdsd = 'dummy.jpg';
						   }
					   
						$dx =  "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class'=>'img-circle']). "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $staff_nme['first_name'] . " " . $staff_nme['last_name'] . "<p class='schl_para'>" .$rolname. "<p></span></div>";
						
				   }else if($user_statusQuery['role_id'] == '2'){
					   $rolname = '(Vice Principal)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$assgnmntd->created_by])->one();
					   
					     if($staff_nme['image'] != ''){
							  $hdsd = $staff_nme['image'];
						   } else {
							   $hdsd = 'dummy.jpg';
						   }
					   
						$dx =  "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class'=>'img-circle']). "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $staff_nme['fname'] . " " . $staff_nme['lname'] . "<p class='schl_para'>" .$rolname. "<p></span></div>";
					   
				   }else if($user_statusQuery['role_id'] == '3'){
					   $rolname = '(Co-Ordinator)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$assgnmntd->created_by])->one();
						if($staff_nme['image'] != ''){
							  $hdsd = $staff_nme['image'];
						   } else {
							   $hdsd = 'dummy.jpg';
						   }
					   
						$dx =  "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class'=>'img-circle']). "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $staff_nme['fname'] . " " . $staff_nme['lname'] . "<p class='schl_para'>" .$rolname. "<p></span></div>";
				   }else if($user_statusQuery['role_id'] == '4'){
					   $rolname = '(office Staff)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$assgnmntd->created_by])->one();
						if($staff_nme['image'] != ''){
							  $hdsd = $staff_nme['image'];
						   } else {
							   $hdsd = 'dummy.jpg';
						   }
					   
						$dx =  "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class'=>'img-circle']). "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $staff_nme['fname'] . " " . $staff_nme['lname'] . "<p class='schl_para'>" .$rolname. "<p></span></div>";
				   }
				   else if($user_statusQuery['role_id'] == '5'){
					   $rolname = '(Teacher)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$assgnmntd->created_by])->one();
						if($staff_nme['image'] != ''){
							  $hdsd = $staff_nme['image'];
						   } else {
							   $hdsd = 'dummy.jpg';
						   }
					   
						$dx =  "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class'=>'img-circle']). "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $staff_nme['fname'] . " " . $staff_nme['lname'] . "<p class='schl_para'>" .$rolname. "<p></span></div>";
				   }
				   echo $dx; ?> 
							</td>
							
							<td><?php
							$gtr = '#myModal'.$assgnmntd->id;
							$mkierid = 'clickmod'.$assgnmntd->id;
							$url = Url::to(['#']);
							echo Html::a('<span class="fa fa-eye"></span>', $url , ['title' => 'view','data-toggle' => 'modal', 'data-target' => $gtr, 'id'=>$mkierid]); ?>
							</td>
						</tr>
							<?php $i++; }
							
							} ?>
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
		<img class="mehrumsd" src="/uploads/pattis.png">
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
 <?php /* } */ } else { ?>
 
 <div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
			   <?= Html::a('Create', ['anouncements/comm_thread'], ['class' => 'btn btn-info pull-right']) ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <?php  echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          
            
			[
			  'attribute' => 'anouncement_title',
			  'format' => 'raw',
			  'label' => 'Title',
			   'value' => function ($model) {
				   $stat = $model->anouncement_title;
				   
				   return ucfirst($stat);
			   },
			],
			[
			  'attribute' => 'class_id',
			  'format' => 'raw',
			  'label' => 'Class',
			  'filter' => false,
			   'value' => function ($model) {
				   $getings=array();
				   $xclusion = explode(',',$model->class_id);
				   if(in_array('0',$xclusion)){
					   $getings[] = 'All Classes';
				   }else {
					   foreach($xclusion as $mrge_class){
						$getclass = AddClass::find()->where(['id'=>$mrge_class])->one();
						$getings[] = $getclass['class_name'];   
					   }
					 
				   }
				   $rerics = implode(',',$getings);
				   return $rerics;
			   },
			],
			[
			  'attribute' => 'section',
			  'format' => 'raw',
			  'label' => 'Section',
			  'filter' => false,
			   'value' => function ($model) {
				   if(($model->section == '0') || ($model->section == '')){
					   $getings = 'All Sections';
				   }else {
					  $getclass = Section::find()->where(['id'=>$model->section])->one();
					$getings = $getclass['section_name'];
				   }
				  
				   return $getings;
				   
			   },
			],
			[
			  'attribute' => 'status',
			  'format' => 'raw',
			  'filter' => false,
			  'label' => 'Status',
			   'value' => function ($model) {
				   $stat = $model->status;
				   if ($stat == '1'){
					   $jh = '<span class="micond"><i class="fa fa-check-circle" aria-hidden="true"></i> Active</span>';
				   }
				   else {
					   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Inactive</span>';
				   }
				   return $jh;
			   },
			],
			[
			  'attribute' => 'created_by',
			  'format' => 'raw',
			  'label' => 'Created By',
			  'filter'=>false,
			   'value' => function ($model) {
				   $rolname ='';
				   $user_statusQuery = User::find()->where(['id'=>$model->created_by])->one();
				   $dx = 'NA';
				   if($user_statusQuery['role_id'] == '1'){
					   $rolname = '(Principal)';
					   $staff_nme = SchoolList::find()->where(['school_user_id'=>$model->created_by])->one();
						$dx = $staff_nme['first_name'] . " " . $staff_nme['last_name']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '2'){
					   $rolname = '(Vice Principal)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$model->created_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '3'){
					   $rolname = '(Co-Ordinator)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$model->created_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '4'){
					   $rolname = '(office Staff)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$model->created_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }
				   else if($user_statusQuery['role_id'] == '5'){
					   $rolname = '(Teacher)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$model->created_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }
				   return $dx;
			   },
			],
			[
			  'attribute' => 'created',
			  'format' => 'raw',
			  'filter' => false,
			  'label' => 'Created Date',
			   'value' => function ($model) {
				   $stat = $model->created;
				  $datetimeFormat = 'd-M-Y';

					$date = new \DateTime();
					// If you must have use time zones
					// $date = new \DateTime('now', new \DateTimeZone('Europe/Helsinki'));
					$date->setTimestamp($stat);
					
				   return $date->format($datetimeFormat);
			   },
			],
		 		   [
			'class'    => 'yii\grid\ActionColumn',
			'template' => '{leadView} {leadUpdate} {leadDelete}',
			'buttons'  => [
				'leadView'   => function ($url, $model) {
					$gtr = '#myModal'.$model->id;
					$url = Url::to(['#']);
					return Html::a('<span class="fa fa-eye"></span>', $url , ['title' => 'View','data-toggle' => 'modal', 'data-target' => $gtr]);
				},
				'leadUpdate' => function ($url, $model) {
					if(Yii::$app->user->identity->role_id == 5){
					if($model->created_by == Yii::$app->user->identity->id){
						
						$url = Url::to(['anouncements/update_com_thread', 'id' => $model->id]);
					return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'Update']);
					}					 
					}
					else {
					$url = Url::to(['anouncements/update_com_thread', 'id' => $model->id]);
					return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'Update']);
					}
				},
				'leadDelete' => function ($url, $model) {
					if(Yii::$app->user->identity->role_id == 5){
					if($model->created_by == Yii::$app->user->identity->id){
						$url = Url::to(['anouncements/delete_com_thread', 'id' => $model->id]);
					return Html::a('<span class="fa fa-trash"></span>', $url, [
						'title'        => 'Delete',
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method'  => 'post',
					]);
					}					 
					}
					else {
					$url = Url::to(['anouncements/delete_com_thread', 'id' => $model->id]);
					return Html::a('<span class="fa fa-trash"></span>', $url, [
						'title'        => 'Delete',
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method'  => 'post',
					]);
					}
					
				},
			]
			],
        ],
    ]);  ?>
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
		<img class="mehrumsd" src="/uploads/pattis.png">
		<button type="button" class="close wintagr" data-dismiss="modal"></button> 
			<div class="row">
			
				<div class="col-md-12"> 
				<span class="title_ds"><?php echo ucfirst($getigd->anouncement_title); ?></span>
				</div>
			
			</div>
			<div class="row">
		
				<div class="col-md-12 justficationas"> 
				<p><?php echo ucfirst($getigd->anouncement_description); ?></p>
				</div>
			
			</div>
			
        </div>
        <div class="modal-footer ">
          <span> Created By :  <?php 
							$rolname ='';
				   $user_statusQuery = User::find()->where(['id'=>$getigd->created_by])->one();
				   $dx = 'NA';
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
	<?php } ?>
		  
        </div>
        <!-- /.col -->
</div>
 
 <?php } 
 
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

$this->registerJsFile('/js/datesheet.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

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
