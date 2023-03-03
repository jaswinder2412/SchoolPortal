<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Assignmentclasses */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Assignmentclasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignmentclasses-view">

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
            'class_id:ntext',
            'section:ntext',
            'Academic_year_id:ntext',
            'school_id:ntext',
            'student_id:ntext',
            'anouncement_title:ntext',
            'anouncement_description:ntext',
            'status:ntext',
            'created_by:ntext',
            'fileupload:ntext',
            'created:ntext',
            'updated:ntext',
        ],
    ]) ?>

</div>
