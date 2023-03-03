<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ManageGrade */

$this->title = 'Update Exam: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Manage Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manage-grade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
