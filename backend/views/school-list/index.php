<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\SchoolList_search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Manage Schools';
$this->params['breadcrumbs'][] = $this->title;
/* $this->params['breadcrumbs'][] = $this->title; */
?>
<div class="school-list-index">
<div class="row ">

		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
   
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            
       
			[
			  'attribute' => 'school_name',
			  'format' => 'raw',
			  'label' => 'School Name & Address',
			   'value' => function($model) {
				   if($model['school_logo'] != ''){
					  $hdsd = $model['school_logo'];
				   } else {
					   $hdsd = 'dummy_logo_school.png';
				   }
			   return "<div class='mytree'>".Html::img(Yii::getAlias('@base').'/uploads/'.$hdsd,['width' => '70px'])  
			    . "</div><div class='col-md-9 mar-left-non_secnd'> <span class='schl_spn'> " . $model->school_name  . "<p class='schl_para'>" . $model->school_location . "<p></span></div>";
			   },
			],
			
			[
			  'attribute' => 'first_name',
			  'format' => 'raw',
			  'label' => 'Principal Name',
			   'value' => function($model) {
				$user_statusQuery = User::find()->select(['email'])->where(['id'=>$model->school_user_id])->one();
			   return "<span class='schl_spn'>" . $model->first_name  . " " . $model->last_name . "<p class='schl_spn_para'>" . $user_statusQuery->email ."</p></span>";},
			],
			[
			  'attribute' => 'number_of_student',
			  'format' => 'raw',
			  'label' => 'Number of Students',
			   'value' => function ($model) {
				   return  "<span class='schl_spn'>" .$model->number_of_student."</span>";
			   },
			],
			[
			  'attribute' => 'status',
			  'format' => 'raw',
			  'label' => 'Status',
			  'filter'=>array("10"=>"Active","0"=>"Inactive"),
			   'value' => function ($model) {
				   $user_statusQuery = User::find()->select(['status'])->where(['id'=>$model->school_user_id])->one();
				   $stat =  $user_statusQuery->status;
				   if ($stat == '10'){
					   $jh = '<span class="micond"><i class="fa fa-check-circle" aria-hidden="true"></i> Active</span>';
				   }
				   else {
					   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Inactive</span>';
				   }
				   return $jh;
			   },
			], 
			[
			  'attribute' => 'last_login',
			  'format' => 'raw',
			  'label' => 'Last Login',
			   'value' => function ($model) {
				   $user_statusQuery = User::find()->select(['last_login'])->where(['id'=>$model->school_user_id])->one();
				   $stasdat =  $user_statusQuery->last_login; 
			   if(!empty($stasdat)){
				   $myd = date('d-M-Y', $stasdat);	
			   }else{
				   $myd = 'NA';
			   }
					
				   return $myd;
			   },
			],
			
			
            ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
        ],
    ]);   ?>
	
			</div>
		</div>
	</div>
</div>
	

</div>

