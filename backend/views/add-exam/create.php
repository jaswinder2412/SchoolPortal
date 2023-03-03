<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AddExam */

$this->title = 'Create Exam Name';
$this->params['breadcrumbs'][] = ['label' => 'Add Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-exam-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
