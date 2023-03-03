<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InhouseTest */

$this->title = 'Create Inhouse Test';
$this->params['breadcrumbs'][] = ['label' => 'Inhouse Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inhouse-test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
