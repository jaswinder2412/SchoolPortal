<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Classinfo */

$this->title = 'Update Class';
$this->params['breadcrumbs'][] = ['label' => 'Merge Class', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerCssFile('/css/multi-select.css');
$this->registerCssFile('/css/multi-select.dev.css');
$this->registerCssFile('/css/multi-select.dist.css');

?>
<div class="classinfo-update">

    <?= $this->render('_form', [
        'model' => $model, 'second_model' => $second_model,'third_model' => $third_model,'second_count' => $second_count,
    ]) ?>

</div>
<?php

$this->registerJs("  $( function() { 
    $( '#classinfo-academic_year' ).datepicker();
  } );
  
");


	$this->registerJs("jQuery('.maxing').click(function(){
		var idimg = $(this).attr('id');
		var myides = idimg.split('_');
		var midssds = myides['1'];
		$.ajax({
		type :'POST',
        data :{id: midssds},
        url:'/classinfo/deleteid',
        success: function(response){
            console.log(response); 
				location.reload();
        }
    });
		
	})");
	
$this->registerJs("

$('#select-all').click(function(){
  $('#classstudent-student_id').multiSelect('select_all');
  return false;
});
$('#deselect-all').click(function(){
  $('#classstudent-student_id').multiSelect('deselect_all');
  return false;
});
");



$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);


$this->registerJsFile('/js/jquery.multi-select.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJsFile('/js/jquery.quicksearch.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);


$this->registerJsFile('/js/update_class_validate.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

 ?>