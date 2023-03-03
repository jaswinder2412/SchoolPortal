<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SchoolList */
 
$this->title = 'Add School';
$this->params['breadcrumbs'][] = ['label' => 'School Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-list-create">

    <?= $this->render('_form', [
        'model' => $model,'model_second' => $model_second,
    ]) ?>

</div>


<?php
$this->registerJs("
jQuery('.hide_confirm').hide();
jQuery('.main_pass').hide();
jQuery('.show_check').hide();
jQuery('.spaning_passsd').hide();
jQuery('.passing_quote').hide();
jQuery('#showing_pass_main').hide();
jQuery('#new_gen_pas_upd').hide();

var pass_val = '';


jQuery('#new_gen_pas').click(function(){
	var xis = Math.floor((Math.random() * 11223123) + 1123123);
	jQuery('#signupform-password').val('PTP'+xis);
	jQuery('#signupform-password_repeat').val('PTP'+xis);
	jQuery('#signupform-hidden_password').val('PTP'+xis);
	jQuery('#showing_pass_main').text('PTP'+xis);
	
	jQuery('.passing_quote').show();
	
	pass_val = jQuery('#signupform-password').val();
	});
	
jQuery('#myclicking_fr_show').click(function(){
	jQuery('#showing_pass_main_twoo').hide();
	jQuery('#showing_pass_main').show();
	});
	
	jQuery('#myclicking_fr_copy').click(function() {
		var vpl = jQuery('#showing_pass_main').text();
  var temp = jQuery('<input>');
  $('body').append(temp);
  temp.val(vpl).select();
  document.execCommand('copy');
  temp.remove();
  
  if (window.getSelection && document.createRange) {
        // IE 9 and non-IE
        var range = document.createRange();
        range.selectNodeContents(document.getElementById('showing_pass_main'));
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    } else if (document.body.createTextRange) {
        // IE < 9
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(document.getElementById('showing_pass_main'));
        textRange.select();
    }
  
});
	
	

	jQuery('#school_sub').click(function(){
		if(pass_val == ''){
		jQuery('.spaning_passsd').show();
		}
		else {
			jQuery('.spaning_passsd').hide();
		}
	});

	");

$this->registerJs("jQuery('#reveal-password').change(function(){
	
	jQuery('#signupform-password').attr('type',this.checked?'text':'password');
	jQuery('#signupform-password_repeat').attr('type',this.checked?'text':'password');
	
	})");

	

?>