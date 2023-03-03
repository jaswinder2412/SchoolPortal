<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TeacherManageGrade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-manage-grade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'exam_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'class_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subject_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'student_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'grade')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'marks')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
