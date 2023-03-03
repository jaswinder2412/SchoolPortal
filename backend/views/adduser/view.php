<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\New_user */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'New Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-user-view">

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
            'first_name:ntext',
            'last_name:ntext',
            'dob:ntext',
            'blood_group:ntext',
            'father_name:ntext',
            'mother_name:ntext',
            'father_ph_no:ntext',
            'mother_phone_no:ntext',
            'address:ntext',
           
			       [
        'attribute' => 'image',
    'label' => 'User-Image',
        'format' => 'html',    
        'value' => function ($data) {
            return Html::img($data['image'],
                ['width' => '150px']);
        },
    ],
        ],
    ]) ?>

</div>
