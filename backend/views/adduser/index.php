<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\web\assets\AdminLtePluginAsset; 
use common\models\User;
use backend\models\ClassStudent;
use backend\models\ClassInfo;
use backend\models\ClassSubject;
use backend\models\newStaffdata;
use backend\models\Subject;
use backend\models\Section;
use backend\models\AcedemicYear;
use backend\models\AddClass;
use backend\models\SchoolList;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\New_user_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.table {
	overflow : scroll;
}
.table th:first-child{
	width : 8%;
}
.table td:nth-child(2){
	min-width : 300px;
}
.table td:nth-child(5){
	width : 213px;
}


</style>
<div class="new-user-index">
<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
			'admission_number',
            [
			  'attribute' => 'first_name',
			  'format' => 'raw',
			  'label' => 'Name',
			   'value' => function($model) {
				   if($model['image'] != ''){
					  $hdsd = '/uploads/'.$model['image'];
				   } else {
					   if(isset($model->gender)){
						   if($model->gender =='0'){
							   $hdsd = '/dummy_users/dummyusers.png';
						   }
						   else{
							   $hdsd = '/dummy_users/girluser.jpg';
						   }
					   }else {
						  $hdsd = '/dummy_users/dummyusers.png'; 
					   }
					   
					   
				   }
				   $user_statusQuery = User::find()->select(['email'])->where(['id'=>$model->user_id])->one();
			   return "<div class='mytree'>".Html::img(Yii::getAlias('@base').$hdsd,['width' => '70px','height' => '70px','class' => 'bord_img'])  
			    . "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $model->first_name  ." ". $model->last_name  . " </span> <p class='schl_para'>" . $user_statusQuery->email . "<p></div>";
			   },
			],
			[
			  'attribute' => 'id',
			  'format' => 'raw',
			  'label' => 'Class',
			   'filter' => false,
			   'value' => function($model) {
				    if(Yii::$app->user->identity->role_id == 1){
				    $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
				   }else{
					   $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
				   }
				   $getclass = ClassStudent::find()->where(['student_id'=>$model->user_id])->andwhere(['Academic_year_id'=>$academine['id']])->one();
				   $getclassname = ClassInfo::find()->where(['id'=>$getclass['class_id']])->one();
				   if(!empty($getclassname['class_name'])){
					  $nockout  = $getclassname['class_name'];
					   $myclassfind = AddClass::find()->where(['id'=>$nockout])->one();
					   $getclks = $myclassfind['class_name'];
				   }else {
					   $getclks = 'NA';
				   }
					return $getclks;
			   },
			],
			[
			  'attribute' => 'id',
			  'format' => 'raw',
			  'label' => 'Section',
			  'filter' => false,
			   'value' => function($model) {
				   if(Yii::$app->user->identity->role_id == 1){
				    $academinesection = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
				   }else{
					   $academinesection = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
						
				   }

					$getclasssection = ClassStudent::find()->where(['student_id'=>$model->user_id])->andwhere(['Academic_year_id'=>$academinesection['id']])->one();
				   $getclassnamesection = ClassInfo::find()->where(['id'=>$getclasssection['class_id']])->one();
					$getsubject = Section::find()->where(['id'=>$getclassnamesection['class_section']])->one();
					 if(!empty($getsubject['section_name'])){
					   $getsubjicts = ucfirst($getsubject['section_name']);
				   }else {
					   $getsubjicts = 'NA';
				   }
					return $getsubjicts;
			   },
			],
			[
			  'attribute' => 'father_name',
			  'format' => 'raw',
			  'label' => 'Parent Details',
			   'value' => function($model) {
				   
				   if($model->father_name !='' && $model->father_ph_no !=''){
					   $miners = "<div class='col-md-12 mar-left-non_secnd'> <span class='schl_spn'>Father Name :  " . $model->father_name . " <p class='schl_para'>Phone : " . $model->father_ph_no . "<p></span></div>";
				   }
				   else {
					   $miners = '';
				   }
				   if($model->mother_name !='' && $model->mother_phone_no !=''){  
			   $miners1 = "<div class='col-md-12 mar-left-non_secnd'> <span class='schl_spn'>Mother Name : " . $model->mother_name . " <p class='schl_para'>Phone : " . $model->mother_phone_no . "<p></span></div>";
			   }
				   else {
					   $miners1 = '';
				   }
					return $miners . $miners1;
			   },
			],
			
            [
			  'attribute' => 'dob',
			  'format' => 'raw',
			  'label' => 'Date Of Birth',
			   'filter' => false,
			   'value' => function ($model) {
				   $date = new DateTime($model->dob);
				   return $date->format('d-M-Y');
			   },
			],
			[
			  'attribute' => 'last_login',
			  'format' => 'raw',
			  'label' => 'Last Login',
			   'value' => function ($model) {
				   $user_statusQuery = User::find()->select(['last_login'])->where(['id'=>$model->user_id])->one();
				   $stasdat =  $user_statusQuery->last_login; 
			   if(!empty($stasdat)){
				   $myd = date('d-M-Y', $stasdat);	
			   }else{
				   $myd = 'NA';
			   }
					
				   return $myd;
			   },
			],
			[
			  'attribute' => 'status',
			  'format' => 'raw',
			  'label' => 'Status',
			  'filter'=> false,
			   'value' => function ($model) {
				   $user_statusQuery = User::find()->select(['status'])->where(['id'=>$model->user_id])->one();
				   $stat =  $user_statusQuery->status;
				   if ($stat == '10'){
					   $jh = '<span class="micond"><i class="fa fa-check-circle" aria-hidden="true"></i> Active</span>';
				   }
				   
				   else {
					   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Deactivated</span>';
				   }
				   return $jh;
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
           // ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
		   
		   [
			'class'    => 'yii\grid\ActionColumn',
			'template' => '{leadView} {leadUpdate} {leadDelete}',
			'buttons'  => [
				'leadView'   => function ($url, $model) {
					$url = Url::to(['adduser/myprofile', 'id' => $model->id]);
					return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']);
				},
				'leadUpdate' => function ($url, $model) {
					$url = Url::to(['adduser/update', 'id' => $model->id]);
					return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'update']);
				},
				'leadDelete' => function ($url, $model) {
					$user_statusQuery = User::find()->select(['status'])->where(['id'=>$model->user_id])->one();
				   $stat =  $user_statusQuery->status;
				   if($stat != '10'){
					$url = Url::to(['adduser/delete', 'id' => $model->id]);
					$mike = Html::a('<span class="fa fa-trash"></span>', $url, [
						'title'        => 'delete',
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method'  => 'post',
					]);
				   } else {
					    $mike = '';
				   }
				   return $mike;
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
</div>	
<?php 

$this->registerJsFile(''.Yii::getAlias('@base').'/js/bootstrap_notify.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile(''.Yii::getAlias('@base').'/js/customdelete.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

?>