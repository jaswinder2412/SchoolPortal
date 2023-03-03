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
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
			  <?= Html::a('Reset', ['staff/index'], ['class' => 'btn btn-info pull-right']) ?>
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
			   return "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','height' => '70px','class' => 'bord_img'])  
			    . "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $model->fname  ." ". $model->lname  . "</span> <p class='schl_para'>" . $user_statusQuery->email . "<p></div>";
			   },
			],
           [
			  'attribute' => 'user_id',
			  'format' => 'raw',
			  'label' => 'Designation',
			  'filter'=>array("2"=>"Vice Principal","3"=>"Co-Ordinator","4"=>"Office Staff","5"=>"Teacher"),
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
			  'filter'=>array("10"=>"Active","0"=>"Inactive"),
			   'value' => function ($model) {
				   $user_statusQuery = User::find()->select(['status'])->where(['id'=>$model->user_id])->one();
				   $stat =  $user_statusQuery->status;
				   if ($stat == '10'){
					   $jh = '<span class="micond"><i class="fa fa-check-circle" aria-hidden="true"></i> Active</span>';
				   }
				    else if(($stat == '2')) {
					   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Deactivated</span>';
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
				   $dx = 'NA';
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
			
           //['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
		   [
			'class'    => 'yii\grid\ActionColumn',
			'template' => '{leadView} {leadHorn} {leadTime} {leadUpdate} {leadDelete}',
			'buttons'  => [
				'leadView'   => function ($url, $model) {
					$gtr = '#myModal';
					$url = Url::to(['#']);
					return Html::a('<span class="fa fa-eye"></span>', $url , ['title' => 'View','data-toggle' => 'modal', 'data-target' => $gtr,'rel' => $model->id,'class'=>'gting_data']);
				},
				'leadHorn' => function ($url, $model) {
					if(Yii::$app->user->identity->role_id == 1){
					
						$url = Url::to(['staff/anouncements', 'id' => $model->id]);
					$mike =  Html::a('<i class="fa fa-bullhorn" aria-hidden="true"></i>
							', $url, [
						'title'        => 'Announcements',
					]);
					
					}else {
						$mike = '';
					}
					return $mike;
				},
				'leadTime' => function ($url, $model) {
					$getd_rold = User::find()->select(['role_id'])->where(['id'=>$model->user_id])->one();
					if($getd_rold->role_id == 5){
					
						$url = Url::to(['staff/viewvarioustime', 'id' => $model->id]);
					$mike =  Html::a('<i class="fa fa-table" aria-hidden="true"></i>
							', $url, [
						'title'        => 'Timetable',
					]);
					
					}else {
						$mike = '';
					}
					return $mike;
				},
				'leadUpdate' => function ($url, $model) {
					if(Yii::$app->user->identity->role_id == 4){
					$getd_rold = User::find()->select(['role_id'])->where(['id'=>$model->user_id])->one();
					if($getd_rold->role_id != 2){
						$url = Url::to(['staff/update', 'id' => $model->id]);
					return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'Update']);
					}
					}else{
						$url = Url::to(['staff/update', 'id' => $model->id]);
					return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'Update']);
					}
					
				},
				'leadDelete' => function ($url, $model) {
					if(Yii::$app->user->identity->role_id == 4){
					$getd_rold = User::find()->select(['role_id'])->where(['id'=>$model->user_id])->one();
					if($getd_rold->role_id != 2){
						$url = Url::to(['staff/delete', 'id' => $model->id]);
					return Html::a('<span class="fa fa-trash"></span>', $url, [
						'title'        => 'Delete',
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method'  => 'post',
					]);
					}
					}else{
					$url = Url::to(['staff/delete', 'id' => $model->id]);
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
        </div>
        <!-- /.col -->
</div></div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" >
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">
		<img class="mehrumsd" src="<?= Yii::getAlias('@base') ?>/uploads/pattis.png">
		<button type="button" class="close wintagr" data-dismiss="modal"></button>
		<div class="modals_dats">
		
		</div>
      
    </div>
    </div>
    </div>
  </div>	
	<?php 
	
	$this->registerJsFile(''.Yii::getAlias('@base').'/js/getprofilemodal.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
	
	
	?> 
	
	
		