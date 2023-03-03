<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AddTest */

$this->title = 'Create Test Name';
$this->params['breadcrumbs'][] = ['label' => 'Add Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-test-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
