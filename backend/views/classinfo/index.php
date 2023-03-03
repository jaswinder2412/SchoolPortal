<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\AcedemicYear;
use backend\models\ClassSubject;
use backend\models\ClassStudent;
use backend\models\Subject;
use backend\models\Section;
use backend\models\AddStudent;
use backend\models\newStaffdata;
use backend\models\AddClass;
use backend\models\AnnouncementsTeacher;
use common\models\User;
use backend\models\SchoolList;
use backend\models\AnouncementTeachersUserids;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Classinfo_search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Merge Classes';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="classinfo-index">
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
 }  ?>
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
			<?php   if(Yii::$app->user->identity->role_id != 5) { ?>
			  <?= Html::a('Merge', ['classinfo/create'], ['class' => 'btn btn-info pull-right']) ?>
			<?php } ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <?php  
	if(Yii::$app->user->identity->role_id == 5) {
		echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
			  'attribute' => 'class_name',
			  'format' => 'raw',
			  'filter' => false,
			   'value' => function ($model) {
				 
					$myclassfind = AddClass::find()->where(['id'=>$model->class_name])->one();
				   $salclass =  ucfirst($myclassfind->class_name);  
					$showingclass = $salclass;
				  
				   return $showingclass;
			   },
			],
			
			[
			  'attribute' => 'class_section',
			  'format' => 'raw',
			  'filter' => false,
			  'label' => 'Section',
			   'value' => function ($model) {
				 
				$user_sectioning = Section::find()->where(['id'=>$model->class_section])->one();
					 
					$getsection =  ucfirst($user_sectioning->section_name); 
					$showingclass = $getsection;
				  
				   return $showingclass;
			   },
			],
			
			
			[
			  'attribute' => 'academic_year',
			  'format' => 'raw',
			   'value' => function ($model) {
				   if($model->academic_year !=''){
					    $user_statusQuery = AcedemicYear::find()->where(['id'=>$model->academic_year])->one();
				   $stasdat =  $user_statusQuery->from; 
					$stasdatsss =  $user_statusQuery->to; 
					$hjssd = $stasdat. ' - '. $stasdatsss;
				   }
				  	 else {
						 $hjssd = '';
						 
					 }
				   return $hjssd;
			   },
			],
			[
			  'attribute' => 'class_students',
			  'format' => 'raw',
			  'label' => 'No. Of Students',
			   'value' => function ($model) {
				   
				  $ids = $model->id;
				  $total = ClassStudent::find()->where(['class_id'=>$ids])->all();
				  $inters = array();
				  foreach($total as $totaling){
					  $miklor = AddStudent::find()->where(['user_id'=>$totaling->student_id])->andwhere(['=','status','10'])->one();
					  if(!empty($miklor)){
						  $inters[$miklor['id']] = $miklor['id'];
					  }
					  
				  }
						return count($inters);
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
			'template' => '{leadView}',
			'buttons'  => [
				'leadView'   => function ($url, $model) {
					$url = Url::to(['classinfo/class_view', 'id' => $model->id]);
					return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']);
				},
				
			]
			],

        ],
    ]);
	}else{
	echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
			[
			  'attribute' => 'class_name',
			  'format' => 'raw',
			  'filter' => false,
			   'value' => function ($model) {
				 
					$myclassfind = AddClass::find()->where(['id'=>$model->class_name])->one();
				   $salclass =  ucfirst($myclassfind['class_name']);  
					$showingclass = $salclass;
				  
				   return $showingclass;
			   },
			],
			
			[
			  'attribute' => 'class_section',
			  'format' => 'raw',
			  'filter' => false,
			  'label' => 'Section',
			   'value' => function ($model) {
				 
				$user_sectioning = Section::find()->where(['id'=>$model->class_section])->one();
					 
					$getsection =  ucfirst($user_sectioning->section_name); 
					$showingclass = $getsection;
				  
				   return $showingclass;
			   },
			],
			
			
			[
			  'attribute' => 'academic_year',
			  'format' => 'raw',
			   'value' => function ($model) {
				   if($model->academic_year !=''){
					    $user_statusQuery = AcedemicYear::find()->where(['id'=>$model->academic_year])->one();
				   $stasdat =  $user_statusQuery->from; 
					$stasdatsss =  $user_statusQuery->to; 
					$hjssd = $stasdat. ' - '. $stasdatsss;
				   }
				  	 else {
						 $hjssd = '';
						 
					 }
				   return $hjssd;
			   },
			],
			[
			  'attribute' => 'class_students',
			  'format' => 'raw',
			  'label' => 'No. Of Students',
			   'value' => function ($model) {
				   
				  $ids = $model->id;
				  $total = ClassStudent::find()->where(['class_id'=>$ids])->all();
				  $inters = array();
				  foreach($total as $totaling){
					  $miklor = AddStudent::find()->where(['user_id'=>$totaling->student_id])->andwhere(['=','status','10'])->one();
					 if(!empty($miklor)){
						  $inters[$miklor['id']] = $miklor['id'];
					  }
				  }
						return count($inters);
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
           //['class' => 'yii\grid\ActionColumn','template'=>'{view} {update} {delete}'],
		   [
			'class'    => 'yii\grid\ActionColumn',
			'template' => '{leadView} {leadUpdate} {leadDelete}',
			'buttons'  => [
				'leadView'   => function ($url, $model) {
					$url = Url::to(['classinfo/class_view', 'id' => $model->id]);
					return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']);
				},
				'leadUpdate' => function ($url, $model) {
					 if (Yii::$app->user->identity->role_id == 1) {
						$myroling = AcedemicYear::find()->where(['status' => '1'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->one();
						}
						else{
						$myroling = AcedemicYear::find()->where(['status' => '1'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->one();
						}
						if($model->academic_year == $myroling->id){
							$url = Url::to(['classinfo/update', 'id' => $model->id]);
						$mike= Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'update']);
						}else{
							$mike="";
						}
						return $mike;
					
				},
				'leadDelete' => function ($url, $model) {
					if (Yii::$app->user->identity->role_id == 1) {
						$myroling = AcedemicYear::find()->where(['status' => '1'])->AndWhere(['=', 'school_id', Yii::$app->user->getId()])->one();
						}
						else{
						$myroling = AcedemicYear::find()->where(['status' => '1'])->AndWhere(['=', 'school_id', Yii::$app->user->identity->school_id])->one();
						}
						if($model->academic_year == $myroling->id){
							$url = Url::to(['classinfo/delete', 'id' => $model->id]);
					$mike= Html::a('<span class="fa fa-trash"></span>', $url, [
						'title'        => 'delete',
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method'  => 'post',
					]);
						}else{
							$mike="";
						}
						return $mike;
					
				},
			]
			],
        ],
    ]); } ?>
 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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