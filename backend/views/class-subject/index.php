<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClassteacherSubject_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Classteacher Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classteacher-subject-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Classteacher Subject', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
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
    ]); ?>
</div>
