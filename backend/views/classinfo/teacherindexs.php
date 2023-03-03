<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\AcedemicYear;
use backend\models\ClassSubject;
use backend\models\ClassInfo;
use backend\models\ClassStudent;
use backend\models\Subject;
use backend\models\Section;
use backend\models\AddStudent;
use backend\models\newStaffdata;
use backend\models\AddClass;
use backend\models\AnnouncementsTeacher;
use backend\models\AnouncementTeachersUserids;
use common\models\User;
use backend\models\SchoolList;

$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Classinfo_search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Manage Classes';
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
 }

	$acadyears = array();
	$getacadid = '';
    if (Yii::$app->user->identity->role_id == 1) {
        $saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->all(); 
    } else {
		$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->all();
    }
    foreach ($saddfs as $dfsdfsdfg) {
		$getacadid = $dfsdfsdfg->id;
        $rol_idsfds = $dfsdfsdfg->id;
        $rol_ifds = $dfsdfsdfg->from;
        $rol_idsdfds = $dfsdfsdfg->to;
		$acadyears[$rol_idsfds] = $rol_ifds . ' - ' . $rol_idsdfds;
    }


 ?>
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
			
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <?php  
	if(Yii::$app->user->identity->role_id == 5) {
		$getclass_ids = ClassSubject::find()->where(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$getacadid])->andwhere(['=','Assigned_teacher_id',Yii::$app->user->identity->id])->groupBy(['class_id'])->all();
		
		?>
		
		<table id="example1" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Class Name</th>
					<th>Section</th>
					<th>Academic Year</th>
					<th>No. Of Students</th>
					<th class="action-column">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$il = 1;
			foreach ($getclass_ids as $myclassonly){
				$classinfos = Classinfo::find()->where(['=','id',$myclassonly->class_id])->andwhere(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['=','academic_year',$getacadid])->one();
			?>
				<tr>
					<td>
					<?php echo $il; ?>
					</td>
					<td>
					<?php $myclassfind = AddClass::find()->where(['id'=>$classinfos['class_name']])->one();
				   $salclass =  ucfirst($myclassfind['class_name']);
					 echo $salclass;
				   ?>
				   </td>
					<td><?php 
						$user_sectioning = Section::find()->where(['id'=>$classinfos['class_section']])->one();
					 
					$getsection =  ucfirst($user_sectioning['section_name']); 
					echo $getsection;
					?></td>
					<td>
					
					<?php
					 if($classinfos['academic_year'] !=''){
					$user_statusQuerys =	AcedemicYear::find()->where(['id'=>$classinfos['academic_year']])->one();
				   $stasdat =  $user_statusQuerys['from']; 
					$stasdatsss =  $user_statusQuerys['to']; 
					$hjssd = $stasdat. ' - '. $stasdatsss;
				   }
				  	 else {
						 $hjssd = 'NA';
						 
					 }
				   echo  $hjssd;

					?>
					
					</td>
					<td>
					<?php

						$ids = $classinfos['id'];
				  $total = ClassStudent::find()->where(['class_id'=>$ids])->all();
				  $inters = array();
				  foreach($total as $totaling){
					  $miklor = AddStudent::find()->where(['user_id'=>$totaling->student_id])->andwhere(['=','status','10'])->one();
					  if(!empty($miklor)){
						  $inters[$miklor['id']] = $miklor['id'];
					  }
					  
				  }
						echo count($inters);

					?>
					</td>
					<td>
						<?php 
						
						$url = Url::to(['classinfo/class_view', 'id' => $classinfos['id']]);
					echo Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']); ?>
					</td>
				</tr>
			<?php $il++; } ?>
			</tbody>
		</table>
		
		<?php

	}
	?>
	
	</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>

</div>
<?php

$this->registerJs("$('#example1').dataTable( {
  'ordering': false
} );

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

$this->registerJsFile('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);


 ?>
