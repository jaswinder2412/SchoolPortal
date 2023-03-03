<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Section */

$this->title = 'Update Section';
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="section-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
