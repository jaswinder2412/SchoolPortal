<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ManageGrade_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
$this->title = 'Enter Grades';
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
            'class_name:ntext',
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
              <h3 class="box-title">Enter Grades</h3>
			   
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Image</th>
				  <th>Name</th>
                  <th style=" text-align : center;">English<br/><span style="font-weight : 500; font-size : 13px;"> Grades | Marks</span></th>
                  <th style=" text-align : center;">Hindi<br/><span style="font-weight : 500; font-size : 13px;"> Grades | Marks</span></th>
                  <th style=" text-align : center;">Mathematics<br/><span style="font-weight : 500; font-size : 13px;"> Grades | Marks</span></th>
                  <th style=" text-align : center;">Science<br/><span style="font-weight : 500; font-size : 13px; "> Grades | Marks</span></th>
                  <th style=" text-align : center;">Social Studies<br/><span style="font-weight : 500; font-size : 13px;"> Grades | Marks</span></th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/1.png" alt=""></span></td>
                  <td>Erick Salvon</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/2.png" alt=""></span></td>
                  <td>Jim Hook</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/4.png" alt=""></span></td>
                  <td>Ramzie Christopher</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/34.png" alt=""></span></td>
                  <td>Reo Patrick</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/32.png" alt=""></span></td>
                   <td>Leono Maria</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/31.png" alt=""></span></td>
                   <td>Victor Joseph</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/24.png" alt=""></span></td>
                  <td>Henry Salvon</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/20.png" alt=""></span></td>
                   <td>Jim Hook</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/18.png" alt=""></span></td>
                   <td>Maria De'souza</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/14.png" alt=""></span></td>
                   <td>Dom Johnson</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/16.png" alt=""></span></td>
                  <td>Roman Jeric</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/1.png" alt=""></span></td>
                   <td>Jim Hook</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
                </tr>
                 <tr>
                  <td><span><img style="border-radius: 75px;" src="/images/34.png" alt=""></span></td>
                   <td>Jim Hook</td>
                  <td style="text-align : center;">A&nbsp;&nbsp; | &nbsp;&nbsp;60</td> 
                  <td style="text-align : center;">B&nbsp;&nbsp; | &nbsp;&nbsp;25</td>
                  <td style="text-align : center;">A+&nbsp;&nbsp; | &nbsp;&nbsp;70</td>
                 <td style="text-align : center;">C+&nbsp;&nbsp; | &nbsp;&nbsp;18</td>
                 <td style="text-align : center;">B-&nbsp;&nbsp; | &nbsp;&nbsp;20</td>
                  <td><?= Html::a('Update Grades', ['manage-grade/addgrade'], ['class' => 'btn btn-info ']) ?></td>
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
