<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TeacherTestExam */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teacher Test Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-test-exam-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'exam_name:ntext',
            'marks:ntext',
            'school_id:ntext',
            'academic_year:ntext',
            'exam_date:ntext',
            'inhouse_global:ntext',
            'created_date:ntext',
            'updated_date:ntext',
            'last_updated_by:ntext',
        ],
    ]) ?>

</div>
