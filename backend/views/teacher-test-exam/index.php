<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TeacherTestExam_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teacher Test Exams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-test-exam-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Teacher Test Exam', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'exam_name:ntext',
            'marks:ntext',
            'school_id:ntext',
            'academic_year:ntext',
            // 'exam_date:ntext',
            // 'inhouse_global:ntext',
            // 'created_date:ntext',
            // 'updated_date:ntext',
            // 'last_updated_by:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
