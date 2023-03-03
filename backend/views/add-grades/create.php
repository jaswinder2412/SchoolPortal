<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AddGrades */

$this->title = 'Create Grade';
$this->params['breadcrumbs'][] = ['label' => 'Add Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-grades-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
