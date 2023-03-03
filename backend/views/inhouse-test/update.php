<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InhouseTest */

$this->title = 'Update Inhouse Test: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inhouse Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inhouse-test-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
