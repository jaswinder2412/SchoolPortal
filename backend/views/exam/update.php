<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Exam */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->title = 'Update Exam';
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exam-update">


    <?= $this->render('_form', [
        'model' => $model,'model_second' => $model_second,
    ]) ?>

</div>
<?php 
$this->registerJs("  $( function() {
    $( '#exam-exam_date' ).datepicker({
    minDate: 0,
});
  } );
  
");


$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile('/js/exam_edit_clonning.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

?>