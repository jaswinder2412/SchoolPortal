<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\AnnouncementsTeacher;
use backend\models\newStaffdata;
use common\models\User;
use backend\models\SchoolList;
use yii\widgets\ActiveForm;
use backend\models\AcedemicYear;
use backend\models\AnouncementTeachersUserids;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Anouncements_search */
/* @var $dataProvider yii\data\ActiveDataProvider */
if(Yii::$app->user->identity->role_id == '5') {
$this->title = ''; }
else {
$this->title = 'Teacher Announcements';
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
}
.condenser_secodn td:last-child {
	min-width: 265px !important;
}
.condenser_secodn td:nth-child(2) {
	min-width: 224px !important;
}
.condenser_secodn thead tr:nth-child(1) {
	background-color : #00A65A;
	
}
.condenser_secodn thead tr:nth-child(1) th  {
	color : white;
	
}
.condenser_secodn thead tr:nth-child(1) th a {
	color : white;
	
}
</style>
<div class="anouncements-index">
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
 
 <?php if(Yii::$app->user->identity->role_id == '5') { 


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
		
		<div class="col-xs-12 index_rowing">
          <div class="box box-warning">
            <div class="box-header first_hefd">
              <h3 class="box-title"><i class="fa fa-bullhorn"></i> Important Announcements</h3>
            </div>
            <div class="box-body">
    <div id="w0" class="grid-view">

	
	
			<table class="table condenser_secodn table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Description </th>
						
						<th>Created By </th>
					</tr>
				</thead>
				<tbody>
			<?php 	$announcingmsing = AnnouncementsTeacher::find()->where(['school_id'=>Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$presnt_acad])->all();
			$ihjs = 1;
			if(!empty($announcingmsing)){
				
			
		foreach($announcingmsing as $ancmntss){
			
		$myanouncess = AnouncementTeachersUserids::find()->where(['=','announcement_id',$ancmntss->id])->andwhere(['=','teacher_id',Yii::$app->user->getId()])->count();
		
		if($myanouncess > 0){
			?>
					<tr>
						<td><?php echo $ihjs; ?></td>
						<td><?php echo ucfirst($ancmntss->anouncement_title) ."."; ?></td>
						<td><?php echo ucfirst($ancmntss->anouncement_description) ."."; ?></td>
			
						<td>
						<?php
						
							   $rolname ='';
				   $user_statusQuery = User::find()->where(['id'=>$ancmntss->created_by])->one();
				   $dx = '';
				   if($user_statusQuery['role_id'] == '1'){
					   $rolname = '(Principal)';
					   $staff_nme = SchoolList::find()->where(['school_user_id'=>$ancmntss->created_by])->one();
					   
						   if($staff_nme['image'] != ''){
							  $hdsd = $staff_nme['image'];
						   } else {
							   $hdsd = 'dummy.jpg';
						   }
					   
						$dx =  "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class'=>'img-circle']). "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $staff_nme['first_name'] . " " . $staff_nme['last_name'] . "<p class='schl_para'>" .$rolname. "<p></span></div>";
						
				   }else if($user_statusQuery['role_id'] == '2'){
					   $rolname = '(Vice Principal)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$ancmntss->created_by])->one();
					   
					     if($staff_nme['image'] != ''){
							  $hdsd = $staff_nme['image'];
						   } else {
							   $hdsd = 'dummy.jpg';
						   }
					   
						$dx =  "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class'=>'img-circle']). "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $staff_nme['fname'] . " " . $staff_nme['lname'] . "<p class='schl_para'>" .$rolname. "<p></span></div>";
					   
				   }else if($user_statusQuery['role_id'] == '3'){
					   $rolname = '(Co-Ordinator)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$ancmntss->created_by])->one();
						if($staff_nme['image'] != ''){
							  $hdsd = $staff_nme['image'];
						   } else {
							   $hdsd = 'dummy.jpg';
						   }
					   
						$dx =  "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class'=>'img-circle']). "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $staff_nme['fname'] . " " . $staff_nme['lname'] . "<p class='schl_para'>" .$rolname. "<p></span></div>";
				   }else if($user_statusQuery['role_id'] == '4'){
					   $rolname = '(office Staff)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$ancmntss->created_by])->one();
						if($staff_nme['image'] != ''){
							  $hdsd = $staff_nme['image'];
						   } else {
							   $hdsd = 'dummy.jpg';
						   }
					   
						$dx =  "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class'=>'img-circle']). "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $staff_nme['fname'] . " " . $staff_nme['lname'] . "<p class='schl_para'>" .$rolname. "<p></span></div>";
				   }
				   echo $dx;
						
						?>
						</td>
					</tr>
		<?php	$ihjs++; }
 } } else { ?>
	 <tr> <td colspan="4" style="text-align:center;">No Record Found.</td> </tr>
	  
 <?php }
  ?> 
				</tbody>
			</table>
			</div>
		</div>
					<!-- /.box-body -->
		</div>
				  <!-- /.box -->
		</div>
		
		
	
 <?php } else { ?>

<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
			   <?= Html::a('Create', ['anouncements/create'], ['class' => 'btn btn-info pull-right']) ?>
            </div>
            <div class="box-body">
    <?php  echo GridView::widget([
		 'tableOptions'=>['class'=>'table condenser table-striped table-bordered'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          
                
			 [
			  'attribute' => 'anouncement_title',
			  'format' => 'raw',
			  'label' => 'Title',
			   'value' => function ($model) {
				   $stat = ucfirst($model->anouncement_title);
				   
				   return $stat;
			   },
			],						

			[
			  'attribute' => 'anouncement_description',
			  'format' => 'raw',
			  'filter' => false, 
			  'label' => 'Description',
			   'value' => function ($model) {
				   $gudghs = substr($model->anouncement_description, 0, 200);
				   return ucfirst($gudghs);
			   },
			],
			[
			  'attribute' => 'start_date',
			  'format' => 'raw',
			  'filter' => false, 
			  'label' => 'Date of Commencement',
			   'value' => function ($model) {
			   if(!empty($model->start_date)){
			   $myd = date('d-M-Y', strtotime($model->start_date))." - ".date('d-M-Y', strtotime($model->end_date));	
			   }else{
				   $myd = 'NA';
			   }
				   return $myd;
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
				   $dx = '';
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
				   return $dx;
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
					
					$url = Url::to(['anouncements/update', 'id' => $model->id]);
					return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'update']);
					
				},
				'leadDelete' => function ($url, $model) {
				
					$url = Url::to(['anouncements/delete', 'id' => $model->id]);
					return Html::a('<span class="fa fa-trash"></span>', $url, [
						'title'        => 'Delete',
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method'  => 'post',
					]);
				
					
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
</div>	




<?php

	if(Yii::$app->user->identity->role_id == 1) {
		$geting = AnnouncementsTeacher::find()->where(['=', 'school_id', Yii::$app->user->getId()])->all();
		}else {
			$geting = AnnouncementsTeacher::find()->where(['=', 'school_id', Yii::$app->user->identity->school_id])->all();
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
 $this->registerJsFile('/js/teacher_academic.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

 ?>
</div>
