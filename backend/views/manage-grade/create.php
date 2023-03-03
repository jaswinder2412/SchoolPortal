<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ManageGrade */

$this->title = 'Create Manage Grade';
$this->params['breadcrumbs'][] = ['label' => 'Manage Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manage-grade-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
