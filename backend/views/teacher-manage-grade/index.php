<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\ClassInfo;
use backend\models\ExamClass;
use backend\models\AcedemicYear;
use backend\models\AddClass;
use backend\models\Section;
use backend\models\Subject;
use backend\models\ClassSubject;
use backend\models\AnnouncementsTeacher;
use common\models\User;
use backend\models\SchoolList;
use backend\models\newStaffdata;
use backend\models\TeacherExamClass;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Exam_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Test Marks';
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
			  'attribute' => 'Subject',
			  'format' => 'raw',
			  'label' => 'Subject',
			  'filter' => false,
			   'value' => function($model) {
				   $originalid = $model->id;
				   $clas_name = array();
					$getclass = TeacherExamClass::find()->where(['exam_id'=>$originalid])->groupBy(['subject_id'])->all();
					foreach($getclass as $getclassval) {
						
						$adgetd = Subject::find()->where(['id'=>$getclassval->subject_id])->one();
						$clas_name[] = ucfirst($adgetd['subject_name']). "<br/>";
						
						
					}
					$newData = implode($clas_name);
					return $newData;
			   },
			],
			[
			  'attribute' => 'class',
			  'format' => 'raw',
			  'label' => 'Class',
			  'filter' => false,
			   'value' => function($model) {
				   $originalid = $model->id;
				   $clas_name = array();
					$getclass = TeacherExamClass::find()->where(['exam_id'=>$originalid])->all();
					foreach($getclass as $getclassval) {
						if($getclassval->class_id == '0'){
							$clas_name[] = 'All Classes';
						}else {
							$getclassname = ClassInfo::find()->where(['id'=>$getclassval->class_id])->one();
							$getsectionname = Section::find()->where(['id'=>$getclassname['class_section']])->one();
						$adgetd = AddClass::find()->where(['id'=>$getclassname['class_name']])->one();
						$clas_name[] = ucfirst($adgetd['class_name'])." - ".ucfirst($getsectionname['section_name']). "<br/>";
						}
						
					}
					$newData = implode($clas_name);
					return $newData;
			   },
			],
			[
			'class'    => 'yii\grid\ActionColumn',
			'template' => '{leadView} {leadUpdate} {leadDelete}',
			'buttons'  => [
				'leadView'   => function ($url, $model) {
					$url = Url::to(['teacher-manage-grade/view', 'id' => $model->id]);
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
