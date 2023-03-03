<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\web\assets\AdminLtePluginAsset; 
use common\models\User;
use backend\models\ClassStudent;
use backend\models\ClassInfo;
use backend\models\ClassSubject;
use backend\models\ClassteacherSubject;
use backend\models\Subject;
use backend\models\Section;
use backend\models\AcedemicYear;
use backend\models\AddClass;
use backend\models\newStaffdata;
use backend\models\AddStudent;
use backend\models\SchoolList;
use backend\models\AnnouncementsTeacher;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\New_user_search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
$this->title = 'Manage Students';
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
.table th:first-child{
	width : 8%;
}
label{
	font-weight : 500 !important;
}
</style>
<div class="new-user-index">
 <?php 
 
 $academic_years = AcedemicYear::find()->where(['school_id'=>Yii::$app->user->identity->school_id])->andwhere(['=','status','1'])->one();
 
 
 if((Yii::$app->user->identity->role_id == '5') || (Yii::$app->user->identity->role_id == '3')){ 
	
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
 ?>
	
	<?php 
	 
 }


 if(isset($academics_set) && !empty($academics_set)){
		$presnt_acad = $academics_set;
		$academine = $academics_set;
		$keysacad = $academics_set;
		/* echo $presnt_acad;
		die; */
	}else {
		if (Yii::$app->user->identity->role_id == 1) {
        $presnt_acadi = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
		$presnt_acad = $presnt_acadi['id'];
		$academine = $presnt_acadi['id'];
		$keysacad = $presnt_acadi['id'];
		} else {
			$presnt_acadi = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			$presnt_acad = $presnt_acadi['id'];
			$academine = $presnt_acadi['id'];
			$keysacad = $presnt_acadi['id'];
		}
	}
	
	

?>

<div class="row pull-right" style="margin-bottom : 7px;">
	<div class="col-md-12">
		<?php $form = ActiveForm::begin(['id' => 'toggle-acadsearch']); ?>
		<span class="margileftplus">Acedemic Year :</span>
		<span>
			<select name="newacademic" id="acadhochnge">
				<option value="">Please Select</option>
				<?php $acadchnge = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->orderBy(['status' => SORT_DESC])->all(); 
				
					foreach($acadchnge as $racadchng){ 
					if($keysacad == $racadchng->id){
						$mikilwer = "selected = 'selected'";
					}
					else {
						$mikilwer = "";
					}
					?>
					
					
					<option value="<?php echo $racadchng->id; ?>" <?php echo $mikilwer; ?> ><?php echo $racadchng->from."-".$racadchng->to; ?></option>
					<?php } ?>
			</select>
		</span>
		<div class="button-group">
                    <button type="submit" style="display:none;" class="oceanSearch" name="signup-button">Search  </button>
		</div>
            <?php ActiveForm::end(); ?>

	</div>
</div>


 
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th>Admission Number</th>
					  <th>Name</th>
					  <th>class</th>
					  <th>Section</th>
					  <th>Father Name</th>
					  <th>Mother Name</th>
					  <th>Date of Birth</th>
					  <th>Last Login</th> 
					  <th>Last Updated By</th> 
					  <th>Action</th>
					</tr>
                </thead>
                <tbody>
    
     <?php 
	 
	 $model = ClassteacherSubject::find()->where(['Assigned_teacher_id'=>Yii::$app->user->getId()])->groupby(['class_id'])->all();
	 foreach($model as $class_student) {
		 $model_student = ClassStudent::find()->where(['class_id'=> $class_student->class_id])->andwhere(['=','Academic_year_id',$presnt_acad])->all();
		foreach($model_student as $getstudetails){
			$mystudent = AddStudent::find()->where(['user_id'=> $getstudetails->student_id])->one();
			
			
			?>
			  <tr>
                  <td><?php echo $mystudent['admission_number']; ?></td>
                  <td><?php
					if($mystudent['image'] != ''){
					  $hdsd = $mystudent['image'];
				   } else {
					   $hdsd = 'dummy-profile.png';
				   }
				   $user_statusQuery = User::find()->select(['email'])->where(['id'=>$mystudent['user_id']])->one();
				  echo "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px','class' => 'bord_img'])  
			    . "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $mystudent['first_name']  ." ". $mystudent['last_name']  . " <p class='schl_para'>" . $user_statusQuery->email . "<p></span></div>"; ?></td>
                  <td><?php 
						
					   
				   
				   $getclass = ClassStudent::find()->where(['student_id'=>$mystudent['user_id']])->andwhere(['Academic_year_id'=>$academine])->one();
				   $getclassname = ClassInfo::find()->where(['id'=>$getclass['class_id']])->one();
				   if(!empty($getclassname['class_name'])){
					  $nockout  = $getclassname['class_name'];
					   $myclassfind = AddClass::find()->where(['id'=>$nockout])->one();
					   $getclks = ucfirst($myclassfind['class_name']);
				   }else {
					   $getclks = 'NA';
				   }
				  echo $getclks; ?></td>
                  <td><?php 
					
					
					$getclasssection = ClassStudent::find()->where(['student_id'=>$mystudent['user_id']])->andwhere(['Academic_year_id'=>$academine])->one();
				   $getclassnamesection = ClassInfo::find()->where(['id'=>$getclasssection['class_id']])->one();
					$getsubject = Section::find()->where(['id'=>$getclassnamesection['class_section']])->one();
					 if(!empty($getsubject['section_name'])){
					   $getsubjicts = ucfirst($getsubject['section_name']);
				   }else {
					   $getsubjicts = 'NA';
				   }
				  
				  echo $getsubjicts; ?></td>
                  <td><?php 
						if($mystudent['father_name'] !='' && $mystudent['father_ph_no'] !=''){
					   $miners = "<div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . ucfirst($mystudent['father_name']) . " <p class='schl_para'>Phone : " . $mystudent['father_ph_no'] . "<p></span></div>";
				   }
				   else {
					   $miners = '';
				   } 
				  echo $miners; ?></td>
				  
                  <td><?php 
					if($mystudent['mother_name'] !='' && $mystudent['mother_phone_no'] !=''){  
			   $mthr = "<div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . ucfirst($mystudent['mother_name']) . " <p class='schl_para'>Phone : " . $mystudent['mother_phone_no'] . "<p></span></div>";
			   }
				   else {
					   $mthr = '';
				   }
				  
				  echo $mthr; ?></td>
                  <td><?php 
					$date = new DateTime($mystudent['dob']);
				   
				  echo $date->format('d-M-Y'); ?></td>
                  <td><?php 
					$user_statusQuery = User::find()->select(['last_login'])->where(['id'=>$mystudent['user_id']])->one();
				   $stasdat =  $user_statusQuery->last_login; 
					   if(!empty($stasdat)){
						   $myd = date('d-M-Y', $stasdat);	
					   }else{
						   $myd = 'NA';
					   }
				  echo $myd; ?></td>
				  <td>
				  <?php
				  
					$rolname ='';
				   $user_statusQuery = User::find()->where(['id'=>$mystudent->last_updated_by])->one();
				   $dx = 'NA';
				   if($user_statusQuery['role_id'] == '1'){
					   $rolname = '(Principal)';
					   $staff_nme = SchoolList::find()->where(['school_user_id'=>$mystudent->last_updated_by])->one();
						$dx = $staff_nme['first_name'] . " " . $staff_nme['last_name']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '2'){
					   $rolname = '(Vice Principal)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$mystudent->last_updated_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '3'){
					   $rolname = '(Co-Ordinator)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$mystudent->last_updated_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }else if($user_statusQuery['role_id'] == '4'){
					   $rolname = '(office Staff)';
					   $staff_nme = newStaffdata::find()->where(['user_id'=>$mystudent->last_updated_by])->one();
						$dx = $staff_nme['fname'] . " " . $staff_nme['lname']. "<p class='schl_para'>".$rolname."</p>";
				   }
					echo $dx;
					
				  
					?>
				  </td>
                  <td><a href="/adduser/myprofile/<?php echo $mystudent['id']; ?>" title="view"><span class="fa fa-eye"></span></a></td>
			  </tr>
		<?php	
			
			
		}
		 
	 }
	 
	 /* echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'class_id:ntext',
            'subject_id:ntext',
            'Assigned_teacher_id:ntext',
            'created_date:ntext',
            // 'updated_date:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */ ?> 
	
	            
              
               
                </tbody>
                
              </table>
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
  
");

$this->registerJsFile('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile(''.Yii::getAlias('@base').'/js/dashboard_request.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);


 ?>
	