<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\newStaffdata;
use backend\models\AddStudent;
use backend\models\Subject;
use backend\models\AddClass;
use backend\models\Section;
use backend\models\AcedemicYear;
use common\models\User;
use backend\models\Classinfo; 
use backend\models\ClassStudent; 
use backend\models\SchoolList; 
use backend\models\ClassSubject; 

/* @var $this yii\web\View */
/* @var $model backend\models\ClassInfo */
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
$this->title = 'View Details';
$this->params['breadcrumbs'][] = ['label' => 'Class Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
label{
	font-weight :500 !important;
}
</style>
<div class="class-subject-view">
<?php if(Yii::$app->user->identity->role_id != '5'){ ?>
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
             <div class="box-header">
              <h3 class="box-title">Assigned Teachers</h3>
            </div>
			<div class="box-body">
				<table class="table table-bordered mytable">
				<thead>
					<th>Subject</th>
					<th>Teachers</th>
				</thead>
				<tbody>
				<?php 
					$myroling = ClassSubject::find()->where(['class_id' => $model->id])->all();
					if(!empty($myroling)){
					foreach($myroling as $alldata) {
				?>
				
					<tr>
						<td><?php $subjct = Subject::find()->where(['id' => $alldata->subject_id])->one();
						echo ucfirst($subjct['subject_name']);
						?></td>
						<td><?php $newStaffdata = newStaffdata::find()->where(['user_id' => $alldata->Assigned_teacher_id])->one();
						echo ucfirst($newStaffdata['fname']) . " " .ucfirst($newStaffdata['lname']);
						?></td>
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



<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
             <div class="box-header">
              <h3 class="box-title">Students Details</h3>
            </div>
			<div class="box-body">
				<table id="example1" class="table table-bordered mytablesecond">
				<thead>
					<th>Student Name</th>
					<th>Admission Number</th>
				</thead>
				<tbody>
				<?php 
					$myrodling = ClassStudent::find()->where(['class_id' => $model->id])->all();
					if(!empty($myrodling)){
					foreach($myrodling as $studata) {
					$studatas = AddStudent::find()->where(['user_id' => $studata->student_id])->AndWhere(['=', 'status', '10'])->one();
					if(!empty($studatas)){
				?>
				
					<tr>
						<td><?php
						if($studatas['image'] != ''){
						  $hdsd = '/uploads/'.$studatas['image'];
					   } else {
						   if(isset($studatas['gender'])){
							   if($studatas['gender'] =='0'){
								   $hdsd = '/dummy_users/dummyusers.png';
							   }
							   else{
								   $hdsd = '/dummy_users/girluser.jpg';
							   }
						   }else {
							  $hdsd = '/dummy_users/dummyusers.png'; 
						   }
					   }
						echo "<div class='mytree'>".Html::img(Yii::getAlias('@base').$hdsd,['width' => '70px','class' => 'bord_img']). "</div><div class='verti-align'>".ucfirst($studatas['first_name'])." ".ucfirst($studatas['last_name'])."  <p>(".ucfirst($studatas['father_name']).")</p></div>";
						?></td>
						<td><?php 
						echo $studatas['admission_number'];
						?></td>
					</tr> 
					
					
					<?php } } }
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
<?php }

else {

 ?>
 <div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
             <div class="box-header">
              <h3 class="box-title"><?php
			  $myclassfind = AddClass::find()->where(['id'=>$model->class_name])->one();
				   $salclass =  ucfirst($myclassfind['class_name']);
				   $user_sectioning = Section::find()->where(['id'=>$model->class_section])->one();
					 
					$getsection =  ucfirst($user_sectioning['section_name']); 
					
					 echo "Class : " .$salclass." ".$getsection;
				

			  ?></h3>
            </div>
			<div class="box-body">
				<table id="example1" class="table table-bordered mytablesecond">
				<thead>
					<th>Admission Number</th>
					<th>Student Name</th>
					<th>Father Name</th>
					<th>Mother Name</th>
					<th>Date of Birth</th>
					<th>Last Login</th> 
					<th>Last Updated By</th> 
					<th>Action</th>
				</thead>
				<tbody>
				<?php 
					$myrodling = ClassStudent::find()->where(['class_id' => $model->id])->all();
					if(!empty($myrodling)){
					foreach($myrodling as $studata) {
					$studatas = AddStudent::find()->where(['user_id' => $studata->student_id])->AndWhere(['=', 'status', '10'])->one();
					if(!empty($studatas)){
				?>
				
					<tr>
						<td><?php 
						echo $studatas['admission_number'];
						?></td>
						<td><?php
						if($studatas['image'] != ''){
						  $hdsd = '/uploads/'.$studatas['image'];
					   } else {
						   if(isset($studatas['gender'])){
							   if($studatas['gender'] =='0'){
								   $hdsd = '/dummy_users/dummyusers.png';
							   }
							   else{
								   $hdsd = '/dummy_users/girluser.jpg';
							   }
						   }else {
							  $hdsd = '/dummy_users/dummyusers.png'; 
						   }
					   }
						echo "<div class='mytree'>".Html::img(Yii::getAlias('@base').$hdsd,['width' => '70px','class' => 'bord_img']). "</div><div class='verti-align'>".ucfirst($studatas['first_name'])." ".ucfirst($studatas['last_name'])."  <p>(".ucfirst($studatas['father_name']).")</p></div>";
						?></td>
						<td>
						
						<?php 
						if($studatas['father_name'] !='' && $studatas['father_ph_no'] !=''){
					   $miners = "<div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . ucfirst($studatas['father_name']) . " <p class='schl_para'>Phone : " . $studatas['father_ph_no'] . "<p></span></div>";
						   }
						   else {
							   $miners = 'NA';
						   } 
						  echo $miners; ?>
						</td>
						
						  <td><?php 
					if($studatas['mother_name'] !='' && $studatas['mother_phone_no'] !=''){  
			   $mthr = "<div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . ucfirst($studatas['mother_name']) . " <p class='schl_para'>Phone : " . $studatas['mother_phone_no'] . "<p></span></div>";
			   }
				   else {
					   $mthr = '';
				   }
				  
				  echo $mthr; ?></td>
                  <td><?php 
					$date = new DateTime($studatas['dob']);
				   
				  echo $date->format('d-M-Y'); ?></td>
                  <td><?php 
					$user_statusQuerys = User::find()->select(['last_login'])->where(['id'=>$studatas['user_id']])->one();
				   $stasdat =  $user_statusQuerys->last_login; 
					   if(!empty($stasdat)){
						   $myd = date('d-M-Y', $stasdat);	
					   }else{
						   $myd = 'NA';
					   }
				  echo $myd; ?></td>
				  <td>
				  <?php
				  
					$rolname ='';
				   $user_statusQuery = User::find()->where(['id'=>$studatas['last_updated_by']])->one();
				   $dx = 'NA';
				   if($user_statusQuery['role_id'] == '1'){
					   $rolname = '(Principal)';
					   $staff_nme = SchoolList::find()->where(['school_user_id'=>$studatas['last_updated_by']])->one();
						$dx = $staff_nme['first_name'] . " " . $staff_nme['last_name']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '2'){
					   $rolname = '(Vice Principal)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$studatas['last_updated_by']])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '3'){
					   $rolname = '(Co-Ordinator)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$studatas['last_updated_by']])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '4'){
					   $rolname = '(office Staff)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$studatas['last_updated_by']])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }
					echo $dx;
					
				  
					?>
				  </td>
                  <td><a href="/adduser/myprofile/<?php echo $studatas['id']; ?>" title="view"><span class="fa fa-eye"></span></a></td>
						
					</tr> 
					
					
					<?php } } }
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
 
 
<?php } ?>
<?php

$this->registerJs("$('#example1').dataTable( {
  'ordering': false
} );
  
");

$this->registerJsFile('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

 ?>
</div>


