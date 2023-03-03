<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\ClassInfo;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AcedemicYear_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Manage Academic';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acedemic-year-index">
	<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
			  <?= Html::a('Add', ['acedemic-year/create'], ['class' => 'btn btn-info pull-right']) ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
   
   <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
			[
			  'attribute' => 'academic_name',
			  'format' => 'raw',
			  'label' => 'Academic Name',
			   'value' => function ($model) {
				 return $model->academic_name;
			   },
			],
			
			[
			  'attribute' => 'from',
			  'format' => 'raw',
			  'filter' => false,
			  'label' => 'From - To',
			   'value' => function ($model) {
				   return $model->from ." - ". $model->to;
			   },
			],
			[
			  'attribute' => 'status',
			  'format' => 'raw',
			  'filter' => false,
			  'label' => 'Status',
			   'value' => function ($model) {
				   $stat = $model->status;
				   if ($stat == '1'){
					   $jh = '<span class="micond"><i class="fa fa-check-circle" aria-hidden="true"></i> Active</span>';
				   }
				   else {
					   $jh = '<span class="disicon"><i class="fa fa-times-circle" aria-hidden="true"></i> Inactive</span>';
				   }
				   return $jh;
			   },
			],
           //['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
		   
		   [
			'class'    => 'yii\grid\ActionColumn',
			'template' => '{leadUpdate} {leadDelete}',
			'buttons'  => [
				
				'leadUpdate' => function ($url, $model) {
					
							$url = Url::to(['acedemic-year/update', 'id' => $model->id]);
						$mike= Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'update']);
						
						return $mike;
					
				},
				'leadDelete' => function ($url, $model) {
					$acd_count = ClassInfo::find()->where(['academic_year'=>$model->id])->count();
					if($acd_count > 0){
					$mike = '';
						
					}else {
							$url = Url::to(['acedemic-year/delete', 'id' => $model->id]);
					$mike= Html::a('<span class="fa fa-trash"></span>', $url, [
						'title'        => 'delete',
						'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'data-method'  => 'post',
					]);
						
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


