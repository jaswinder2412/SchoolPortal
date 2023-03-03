<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ClassSubject */

$this->title = 'Assign Class';
$this->params['breadcrumbs'][] = ['label' => 'Assign Class', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-subject-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
