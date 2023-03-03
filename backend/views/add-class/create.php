<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AddClass */

$this->title = 'Add Class';
$this->params['breadcrumbs'][] = ['label' => 'Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-class-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
