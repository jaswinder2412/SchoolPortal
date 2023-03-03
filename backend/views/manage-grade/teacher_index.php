<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\ClassInfo;
use backend\models\ExamClass;
use backend\models\AcedemicYear;
use backend\models\AddClass;
use backend\models\Section;
use backend\models\AnnouncementsTeacher;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Exam_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Exam Marks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-index">
  <?php  if((Yii::$app->user->identity->role_id == '5') || (Yii::$app->user->identity->role_id == '3')){ 
	
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
    
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
			  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php   echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
			  'attribute' => 'exam_name',
			  'format' => 'raw',
			  'label' => 'Exam Name',
			   'value' => function($model) {
				   
					return ucfirst($model->exam_name);
			   },
			],
			
			[
			  'attribute' => 'marks',
			  'format' => 'raw',
			  'label' => 'Marks',
			  'filter' => false,
			   'value' => function($model) {
				    if($model->marks == '1'){
						$getsubjicts = "In Grades";
					}else{
						$getsubjicts = "In Marks";
					}
					return $getsubjicts;
			   },
			],
			[
			  'attribute' => 'class_name',
			  'format' => 'raw',
			  'label' => 'Class Name',
			  'filter' => false,
			   'value' => function($model) {
				   $maximun = $model->id;
				   $getexamclassname = ExamClass::find()->where(['exam_id'=>$maximun])->all();
				 
				   $monarm = array();
				   foreach($getexamclassname as $maxima){
					$getclassname = ClassInfo::find()->where(['id'=>$maxima['class_id']])->one();
					$adgetd = AddClass::find()->where(['id'=>$getclassname['class_name']])->one();
					$monarm[] = ucfirst($adgetd['class_name'])."<br/>";
					
				   }
					$maxok = implode($monarm);
					return $maxok;
			   },
			], 
			[
			  'attribute' => 'class_name',
			  'format' => 'raw',
			  'label' => 'Section',
			  'filter' => false,
			   'value' => function($model) {
				   $maximun2 = $model->id;
				   $getexamSectionname = ExamClass::find()->where(['exam_id'=>$maximun2])->all();
				   $monarm2 = array();
				   foreach($getexamSectionname as $maxima2){
					$getsectionname = Section::find()->where(['id'=>$maxima2['section_id']])->one();
					
					$monarm2[] = ucfirst($getsectionname['section_name'])."<br/>";
					
				   }
					$maxok2 = implode($monarm2);
					return $maxok2;
			   },
			], 
			[
			  'attribute' => 'academic_year',
			  'format' => 'raw',
			  'label' => 'Academic Year',
			  'filter' => false,
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
			'class'    => 'yii\grid\ActionColumn',
			'template' => '{leadView} {leadUpdate} {leadDelete}',
			'buttons'  => [
				'leadView'   => function ($url, $model) {
					$url = Url::to(['exam/class_view', 'id' => $model->id]);
					return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']);
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

/* 'leadUpdate' => function ($url, $model) {
					$url = Url::to(['#']);
					return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'update']);
				},
				'leadDelete' => function ($url, $model) {
					$url = Url::to(['#']);
					return Html::a('<span class="fa fa-trash"></span>', $url, [
						'title'        => 'delete',
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method'  => 'post',
					]);
				}, */

$this->registerJs("$('#example1').dataTable( {
  'ordering': false
} );
  
");

$this->registerJsFile('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

 ?>
</div>
