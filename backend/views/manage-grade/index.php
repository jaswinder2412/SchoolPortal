<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ManageGrade_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
$this->title = 'Manage Grades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manage-grade-index">
 
    <?php /* echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'exam_id:ntext',
            'class_id:ntext',
            'subject:ntext',
            'student:ntext',
            // 'grade:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */ ?>
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Grades</h3>
			   <?php /* echo Html::a('Manage', ['manage-grade/create'], ['class' => 'btn btn-info pull-right'])  */?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Class Name</th>
				  <th>Exam Name</th>
                  <th>Subject</th>
                  <th>No. Of students</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Pre Nursery</td>
                  <td>Second term</td>
                  <td>English</td>
                  <td>25</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Nursery</td>
				  <td>first Term</td>
				   <td>English Poems</td>
                  <td>20</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>First</td>
                  <td>Fourth Term</td>
                  <td>Science</td>
                  <td>35</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>L.K.G</td>
				  <td>first Term</td>
				   <td>Hindi</td>
                  <td>60</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>U.K.G</td>
                  <td>Third term</td>
                  <td>GK</td>
                  <td>30</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Second</td>
				  <td>first Term</td>
				   <td>History</td>
                  <td>29</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Third</td>
                  <td>Second term</td>
                  <td>Chemistry</td>
                  <td>25</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Fourth</td>
				  <td>first Term</td>
				   <td>Physics</td>
                  <td>20</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Fifth</td>
                  <td>Fourth term</td>
                  <td>English</td>
                  <td>25</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Sixth</td>
				  <td>Third Term</td>
				   <td>Science</td>
                  <td>20</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Seventh</td>
                  <td>Second term</td>
                  <td>Civics</td>
                  <td>25</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Eighth</td>
				  <td>first Term</td>
				   <td>Geography</td>
                  <td>20</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Pre Nursery</td>
                  <td>Second term</td>
                  <td>English</td>
                  <td>25</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <tr>
                  <td>Nursery</td>
				  <td>first Term</td>
				   <td>English Poems</td>
                  <td>20</td>
                  <td><a href="/manage-grade/view_exam" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a><a href="#" title="Update" aria-label="Update" data-pjax="0"> <span class="glyphicon glyphicon-pencil"></span> </a> <a href="#" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"> <span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                
                
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
