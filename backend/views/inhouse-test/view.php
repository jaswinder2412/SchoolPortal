<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InhouseTest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inhouse Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inhouse-test-view">

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
            'exam_id:ntext',
            'class_id:ntext',
            'section_id:ntext',
            'subject_id:ntext',
            'academic_year:ntext',
            'school_id:ntext',
            'teacher_created_by:ntext',
            'created:ntext',
            'updated:ntext',
        ],
    ]) ?>

</div>
