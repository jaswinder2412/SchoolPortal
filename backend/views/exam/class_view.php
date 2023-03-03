<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\newStaffdata;
use backend\models\AddStudent;
use backend\models\Subject;
use backend\models\AcedemicYear;
use common\models\User;
use backend\models\AddClass; 
use backend\models\ClassInfo; 
use backend\models\ClassStudent; 
use backend\models\ClassSubject; 
use backend\models\ExamClass; 
use backend\models\Section; 

/* @var $this yii\web\View */
/* @var $model backend\models\ClassInfo */
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
$this->title = 'View Details';
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['manage-grade/teacher_index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
label{
	font-weight :500 !important;
}
.mytable td:last-child {
    width: auto !important;
}
</style>
<div class="class-subject-view">
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
             <div class="box-header">
              <h3 class="box-title"><?php echo ucfirst($model->exam_name); ?></h3>
            </div>
			<div class="box-body">
				<table class="table table-bordered mytable">
				<thead>
					<th>Class</th>
					<th>Section</th>
					<th>Action</th>
				</thead>
				<tbody>
				<?php 
					$maximun = $model->id;				 
					$myroling = ExamClass::find()->where(['exam_id'=>$maximun])->all();
					if(!empty($myroling)){
						$i=0;
					foreach($myroling as $alldata) {
						$i++;
				?>
				
					<tr>
						<td>
							<?php
							
								$getclassname = ClassInfo::find()->where(['class_name'=>$alldata['class_id']])->andwhere(['=','class_section',$alldata['section_id']])->andwhere(['=','academic_year',$alldata['academic_year']])->one();
							$adgetd = AddClass::find()->where(['id'=>$getclassname['class_name']])->one();
							echo ucfirst($adgetd['class_name']);
							?>
						</td>
					<td>
						<?php 
						$getset = Section::find()->where(['id'=>$alldata['section_id']])->one();
						echo ucfirst($getset['section_name']);
						?>
					</td>
					<td>
						
						<a href="<?= Yii::getAlias('@base').'/manage-grade/exam_managing?id='.$getclassname['id'].'&exam_id='.$model->id;?>" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
					
					</td> 
					</tr> 
					
					
					<?php } }
						else{
						?>
						<tr>
						<td colspan="3" style="text-align : center;">No Record Found</td>
					</tr> 
						<?php } ?>
				</tbody>
				 </table>

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


