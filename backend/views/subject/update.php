<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Subject */

$this->title = 'Update Subject';
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subject-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
