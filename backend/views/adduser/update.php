<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\New_user */
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->title = 'Update Student';
$this->params['breadcrumbs'][] = ['label' => 'Student List', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
$mids = $model->id;
?>
<div class="new-user-update">


    <?= $this->render('_form', [
        'model' => $model,'model_second' => $model_second,'model_thirds' => $model_thirds,
    ]) ?>

</div>
<?php

$this->registerJs("  $( function() {
    $( '#addstudent-dob' ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,
            changeYear: true, });
  } );
  
");

$this->registerJs("  $( function() {
    $( '#newstaffdata-date_of_joining' ).datepicker({dateFormat: 'dd-mm-yy',changeMonth: true,
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
jQuery('.help-block-secton').hide();


jQuery('#new_gen_pas_upd').click(function(){
	var xis = Math.floor((Math.random() * 11223123) + 1123123);
	jQuery('#usercustom-password').val('STUD'+xis);
	jQuery('#usercustom-password_repeat').val('STUD'+xis);
	jQuery('#showing_pass_main').text('STUD'+xis);
	
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
	
			$( '#classassignedstudent-class_id' ).change(function(){
			var class_id = $(this).val();
			$.ajax({
				type :'POST',
				data: {class_ids: class_id},
				url:'".Yii::getAlias('@base')."/adduser/getsection',
				success: function(response){
					
					$('#classassignedstudent-section_id').html(response);
					$('#classassignedstudent-section_id').removeAttr('disabled');
					
					}
				});
		});
		
		
	jQuery('#school_sub').click(function(e){
		var classvalsd = $( '#classassignedstudent-class_id' ).val();
		var sectionvalsd = $( '#classassignedstudent-section_id' ).val();
		
		if(classvalsd != '' && sectionvalsd == ''){
			
			jQuery('.help-block-secton').show();
			return false;
			e.preventDefault();
		}else {
			jQuery('.help-block-secton').hide();
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
        url:'".Yii::getAlias('@base')."/adduser/deleteimage',
        success: function(response){
			
            console.log(response); 
				jQuery('.mydelete_imaging').show();
				jQuery('#my_mix').hide(); jQuery('.my_mix_2').hide(); 
        }
    });
	
	})");

	

?>