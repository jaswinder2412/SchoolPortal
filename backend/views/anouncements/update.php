<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Anouncements */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerCssFile('/css/multi-select.css');
$this->registerCssFile('/css/multi-select.dev.css');
$this->registerCssFile('/css/multi-select.dist.css');
$this->title = 'Update Anouncements';
$this->params['breadcrumbs'][] = ['label' => 'Anouncements', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anouncements-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php 

$this->registerJs("  $( function() {
    $( '#announcementsteacher-start_date' ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
  
");
$this->registerJs("  $( function() {
    $( '#announcementsteacher-end_date' ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
  
");
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);


$this->registerJsFile('/js/jquery.multi-select.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/jquery.quicksearch.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/anouncelents_multislct.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

?>