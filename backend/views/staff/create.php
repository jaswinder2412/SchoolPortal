<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Staff */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->title = 'Add Staff';
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-create">

  

    <?= $this->render('_form', [
        'model' => $model,'model_second' => $model_second,
    ]) ?>

</div>

<?php

$this->registerJs("  $( function() {
    $( '#newstaffdata-dob' ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,
            changeYear: true,});
  } );
  
");

$this->registerJs("  $( function() {
    $( '#newstaffdata-date_of_joining' ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,
            changeYear: true, });
  } );
  
");


$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);


$this->registerJsFile("".Yii::getAlias('@base')."/js/staff_jquery.js", ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);

$this->registerJs("jQuery('#reveal-password').change(function(){
	
	jQuery('#signupform-password').attr('type',this.checked?'text':'password');
	jQuery('#signupform-password_repeat').attr('type',this.checked?'text':'password');
	
	})");

	

?>
