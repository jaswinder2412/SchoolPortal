<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AddClass */

$this->title = 'Update Class';
$this->params['breadcrumbs'][] = ['label' => 'Add Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="add-class-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
