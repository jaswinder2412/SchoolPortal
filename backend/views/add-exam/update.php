<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AddExam */

$this->title = 'Update Exam Name ';
$this->params['breadcrumbs'][] = ['label' => 'Add Exams', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="add-exam-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
