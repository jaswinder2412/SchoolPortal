<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AddGrades */

$this->title = 'Update Grade ';
$this->params['breadcrumbs'][] = ['label' => 'Add Grades', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="add-grades-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
