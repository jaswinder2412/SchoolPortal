<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InhouseTest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inhouse-test-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'exam_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'class_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'section_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subject_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'academic_year')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'school_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'teacher_created_by')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'updated')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
