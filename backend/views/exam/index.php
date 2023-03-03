<?php

use yii\helpers\Html;
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
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Exam_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Exams';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

</style>
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
			   <?= Html::a('Create', ['exam/create'], ['class' => 'btn btn-info pull-right']) ?>
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
			  'label' => 'Classes Information',
			  'filter' => false,
			   'value' => function($model) {
				   $tablevar = "<table class='table table-striped table-bordered'>
								<thead>
									<th>Class Name</th>
									<th>Class Section</th>
									<th>Subject</th>
									<th>Assigned Teachers</th>
								</thead>
								<tbody>";
				    $maximun = $model->id;
				   $getexamclassname = ExamClass::find()->where(['exam_id'=>$maximun])->all();
				   $monarm = array();
				   foreach($getexamclassname as $maxima){
				   $tablevar.="<tr>";
				   
					$tablevar.="<td>";
					$getclassname = ClassInfo::find()->where(['id'=>$maxima['class_id']])->one();
					$adgetd = AddClass::find()->where(['id'=>$getclassname['class_name']])->one();
						
					$tablevar.= ucfirst($adgetd['class_name'])."</td>";
					
					$tablevar.="<td>";
						$getsectionname = Section::find()->where(['id'=>$maxima['section_id']])->one();
					$tablevar.= ucfirst($getsectionname['section_name'])."</td>";
					
					$tablevar.="<td>";
							$mixiar = array();
							$getsectionname2 = ClassSubject::find()->where(['class_id'=>$maxima['class_id']])->all();
						foreach($getsectionname2 as $key => $givassign){
							$get_techr_name = Subject::find()->where(['id'=>$givassign['subject_id']])->one();
							 $mixiar[] = ucfirst($get_techr_name['subject_name'])."<br/> "; 
						}
					$tablevar.= implode($mixiar) ."</td>";
					
						$tablevar.="<td style='min-width: 132px;'>";
						$mixiar2 = array();
						$getsectionname3 = ClassSubject::find()->where(['class_id'=>$maxima['class_id']])->all();
						foreach($getsectionname3 as $key => $givassign2){
							$get_techr_name2 = newStaffdata::find()->where(['user_id'=>$givassign2['Assigned_teacher_id']])->one();
							 $mixiar2[] = ucfirst($get_techr_name2['fname'])." ".ucfirst($get_techr_name2['lname'])."<br/> "; 
						}
						$tablevar.= implode($mixiar2) ."</td>
							   </tr>";
				   }
				   $tablevar.="</tbody>
								</table>";
					
					return $tablevar;
			   },
			], 

			[
			  'attribute' => 'exam_date',
			  'format' => 'raw',
			  'label' => 'Date of Exam',
			  'filter' => false,
			   'value' => function($model) {
				   $originalDate = $model->exam_date;
					$newDate = date("d-M-Y", strtotime($originalDate));
					return $newDate;
			   },
			], 
		/* 	[
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
			], */
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

            ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
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

$this->registerJs("$('#example1').dataTable( {
  'ordering': false
} );
  
");

$this->registerJsFile('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

 ?>
</div>
