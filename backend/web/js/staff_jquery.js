
jQuery('.hide_confirm').hide();
jQuery('.main_pass').hide();
jQuery('.show_check').hide();
jQuery('.spaning_passsd').hide();
jQuery('.passing_quote').hide();
jQuery('#showing_pass_main').hide();
jQuery('#new_gen_pas_upd').hide();
jQuery('.mycordinator').hide();
jQuery('.cordi_requ').hide();

var pass_val = '';


jQuery('#new_gen_pas').click(function(){
	var xis = Math.floor((Math.random() * 11223123) + 1123123);
	jQuery('#signupform-password').val('STF'+xis);
	jQuery('#signupform-password_repeat').val('STF'+xis);
	jQuery('#showing_pass_main').text('STF'+xis);
	
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
	
	

	jQuery('#school_sub').click(function(e){
		if(pass_val == ''){
		jQuery('.spaning_passsd').show();
		}
		else {
			jQuery('.spaning_passsd').hide();
		}
		var jkuer = $('#signupform-role_id').val();
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
	
	
jQuery('#signupform-role_id').change(function(){
		var get_tech_val = jQuery('#signupform-role_id').val();
		if(get_tech_val == '5'){
			jQuery('.mycordinator').show();	
		} else {
			jQuery('.mycordinator').hide();
		}
	});
	
	