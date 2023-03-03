<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Assignmentclasses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignmentclasses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'section')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Academic_year_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'school_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'student_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'anouncement_title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'anouncement_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fileupload')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'updated')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
