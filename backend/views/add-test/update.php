<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AddTest */

$this->title = 'Update Test Name: ';
$this->params['breadcrumbs'][] = ['label' => 'Add Tests', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="add-test-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
