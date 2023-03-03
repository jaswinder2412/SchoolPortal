<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\AnnouncementsTeacher;
use common\models\User;
use backend\models\SchoolList;
use backend\models\FinalExam;
use backend\models\newStaffdata;
use backend\models\AnouncementTeachersUserids;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AddExam_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Add Exam Name';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-exam-index">
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
			  <?= Html::a('Add', ['add-exam/create'], ['class' => 'btn btn-info pull-right']) ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

 
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],

			
				[
			  'attribute' => 'exam_name',
			  'format' => 'raw',
			  'label' => 'Exam Name',
			   'value' => function ($model) {
				   $rightd = ucfirst($model->exam_name);		
					return $rightd;
			   }
				],
				
				[
			  'attribute' => 'academic_year',
			  'format' => 'raw',
			  'label' => 'Last Updated',
			   'value' => function ($model) {
				   
				  $timestamp = $model->updated;
					$datetimeFormat = 'd-M-Y ';
					$date = new \DateTime();
					// If you must H:i:s have use time zones
					// $date = new \DateTime('now', new \DateTimeZone('Europe/Helsinki'));
					$date->setTimestamp($timestamp);
					return $date->format($datetimeFormat);
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

			[
			'class'    => 'yii\grid\ActionColumn',
			'template' => '{leadUpdate} {leadDelete}',
			'buttons'  => [
			
				'leadUpdate' => function ($url, $model) {
					
						$url = Url::to(['add-exam/update', 'id' => $model->id]);
					return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'Update']);
									
				},
				'leadDelete' => function ($url, $model) {
					
				if(Yii::$app->user->identity->role_id == '1'){
					$mikler = FinalExam::find()->where(['=','exam_id',$model->id])->andwhere(['=','school_id',Yii::$app->user->identity->id])->count();
				}else{
					$mikler = FinalExam::find()->where(['=','exam_id',$model->id])->andwhere(['=','school_id',Yii::$app->user->identity->school_id])->count();
				}
					if($mikler > 0){
						$hti = '';
				}else {
					
					 $url = Url::to(['add-exam/delete', 'id' => $model->id]);
					$hti = Html::a('<span class="fa fa-trash"></span>', $url, [
						'title'        => 'Delete',
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method'  => 'post',
					]);
				}
					return $hti;
					
				},
				
			]
			],
			],
		]); ?>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
		</div>
			<!-- /.col -->
	</div>
</div>
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
					location.reload();
					}
	});
	
}); 
  
");	

?>