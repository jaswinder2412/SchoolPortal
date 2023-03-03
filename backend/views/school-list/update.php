<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SchoolList */ 

$this->title = 'Update School';
$this->params['breadcrumbs'][] = ['label' => 'School Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$mids = $_GET['id'];

?>
<div class="school-list-update">


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
jQuery('#new_gen_pas').hide();
jQuery('.mydelete_imaging').hide();

jQuery('.mydelete_imaging_princ').hide();


jQuery('#new_gen_pas_upd').click(function(){
	var xis = Math.floor((Math.random() * 11223123) + 1123123);
	jQuery('#usercustom-password').val('PTP'+xis);
	jQuery('#usercustom-password_repeat').val('PTP'+xis);
	jQuery('#showing_pass_main').text('PTP'+xis);
	
	jQuery('.passing_quote').show();
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
	
	 
	");

$this->registerJs("jQuery('#reveal-password').change(function(){
	
	jQuery('#usercustom-password').attr('type',this.checked?'text':'password');
	jQuery('#usercustom-password_repeat').attr('type',this.checked?'text':'password');
	
	})");

	$this->registerJs("jQuery('#dele_img').click(function(){
		$.ajax({
		type :'POST',
        data: {id:". $mids ." },
        url: '".Yii::getAlias('@base')."/school-list/deleteimage',
        success: function(response){
            console.log(response); 
				jQuery('.mydelete_imaging').show();
				jQuery('#my_mix').hide(); jQuery('.my_mix_2').hide();
        }
    });
	
	})");

	$this->registerJs("jQuery('#dele_img_prince').click(function(){
		$.ajax({
		type :'POST',
        data: {id:". $mids ." },
        url:'".Yii::getAlias('@base')."/school-list/deleteimageprinc',
        success: function(response){
            console.log(response); 
				jQuery('.mydelete_imaging_princ').show();
				jQuery('#my_mix_second').hide(); jQuery('.my_mix_two').hide();
        }
    });
	
	})");

	

?>