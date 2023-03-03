<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */ 
/* @var $model backend\models\SchoolList */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'School Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-list-view">

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
            'school_name:ntext',
            'school_location:ntext',
            'school_logo:ntext',
            'description:ntext',
            'number_of_student:ntext',
            'status:ntext',
            'created_by:ntext',
            'created_time:ntext',
            'updated:ntext',
        ],
    ]) ?>

</div>
