<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Staff */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->title = 'Update Staff'  ;
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
$mids = $model->id;
?>

<div class="staff-update">


    <?= $this->render('_form', [
        'model' => $model,'model_second' => $model_second,
    ]) ?>

</div>


<?php

$this->registerJs("  $( function() {
    $( '#newstaffdata-dob' ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,
            changeYear: true, });
  } );
  
");

$this->registerJs("  $( function() {
    $( '#newstaffdata-date_of_joining' ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,
            changeYear: true, });
  } );
  
");


$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['position' => yii\web\View::POS_END, 'depends' => ['yii\web\JqueryAsset']]);


$this->registerJs("
jQuery('.hide_confirm').hide();
jQuery('.main_pass').hide();
jQuery('.show_check').hide();
jQuery('.spaning_passsd').hide();
jQuery('.passing_quote').hide();
jQuery('#showing_pass_main').hide();
jQuery('#new_gen_pas').hide();
jQuery('.mydelete_imaging').hide();
jQuery('.cordi_requ').hide();

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
var get_tecsh_val = jQuery('#usercustom-role_id').val();
		if(get_tecsh_val == '5'){
			jQuery('.mycordinator').show();	
		} else {
			jQuery('.mycordinator').hide();
		}

	jQuery('#usercustom-role_id').change(function(){
		var get_tech_val = jQuery('#usercustom-role_id').val();
		if(get_tech_val == '5'){
			jQuery('.mycordinator').show();	
		} else {
			jQuery('.mycordinator').hide();
		}
	});
	
	
	
	jQuery('#school_sub').click(function(e){
		
		
		var jkuer = $('#usercustom-role_id').val();
		var cdgntr = $('#newstaffdata-co_ordinator_id').val();
		
		if(jkuer == '5' && cdgntr == ''){
			
			$('.field-newstaffdata-co_ordinator_id').removeClass('has-success');
			jQuery('.cordi_requ').show();
			e.preventDefault();
			return false;
		}else{
			jQuery('.cordi_requ').hide();
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
        url:'".Yii::getAlias('@base')."/staff/deleteimage',
        success: function(response){
            console.log(response); 
				jQuery('.mydelete_imaging').show();
				jQuery('#my_mix').hide(); jQuery('.my_mix_2').hide();
        }
    });
	
	})");

	

?>