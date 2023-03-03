<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AcedemicYear */
$this->registerCssFile('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.css');
$this->registerCssFile('//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css');
$this->title = 'Academic Year';
$this->params['breadcrumbs'][] = ['label' => 'Acedemic Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acedemic-year-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php

$this->registerJs("  

  $('#acedemicyear-from').datetimepicker({
    	format: 'YYYY',
		  
		  viewMode: 'months'
});


$('#acedemicyear-to').datetimepicker({
    	format: 'YYYY',
		  
		  viewMode: 'months'
});
");


$this->registerJsFile('//cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

 ?>