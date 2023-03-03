var my_valdsd =  $("#chechk_valuecount").val();

if(my_valdsd !='' && my_valdsd !='0'){
	var counter = my_valdsd;
}else{
	var counter = 0;
}
$('body').on('change', '.apsnd_class .first select', function(e){
	var select = $(this);
	var clasign = $(this).val();
	$.ajax({
	type :'POST',
	data: {class_ids: clasign},
	url:'/exam/getsection',
	success: function(response){
		$(select).parents('.apsnd_class').find('.second select').html(response);
		$(select).parents('.apsnd_class').find('.second select').removeAttr("disabled");
		}
	});
});

var slctionsub = $('#examclass-class_id_min').html();
var slctiontchr = $('#examclass-section_idmin').html();
	$(function(){
		$( '#adding_exms' ).click(function(){
		$('.addition_classing').append('<div class="row"></div><div class="examine chek_examine"><div class="apsnd_class"><div class="col-md-6 first"><div class="form-group"><div class="form-group_first'+counter+' field-examclass-class_'+counter+'"><label class="control-label" for="examclass-class">Class</label><select id="examclass-class_id_'+counter+'" class="form-control" name="ExamClass[class_id][]">'+slctionsub+'</select><div class="help-block_first"></div></div></div></div><div class="col-md-6 second"><div class="form-group"><div class="form-group_second'+counter+' field-examclass-section_'+counter+'"><label class="control-label" for="examclass-section">Section</label><select id="examclass-section_id_'+counter+'" class="form-control" name="ExamClass[section_id][]" disabled="disabled">'+slctiontchr+'</select><div class="help-block_second"></div></div></div></div></div><a class=" pull-right" id="rmvgd"><i class="fa fa-times" aria-hidden="true"></i></a></div>');
		counter++;
		});
	 }); 
 
	$(document).on('click','#rmvgd',function(){
		counter--;
		$(this).closest('.examine').remove(); 
	});

$('#examclassin').click(function(e) {	
	var countersec = 0;
	$( ".chek_examine" ).each(function() {
		var firstselect = $(this).find("#examclass-class_id_"+countersec).val();
		var second = $(this).find("#examclass-section_id_"+countersec).val();
		if(firstselect != '' && second == ''){
			$(this).find('.form-group_second'+countersec).addClass("has-erroring");
			$(this).find('.help-block_second').html('Section is Required.');
			e.preventDefault();
			return false;
		}else{
			$(this).find('.form-group_second'+countersec).removeClass("has-erroring");
			$(this).find('.help-block_second').html('');
		}
		if(second != '' && firstselect == ''){
			$(this).find('.form-group_first'+countersec).addClass("has-erroring");
			$(this).find('.help-block_first').html('Class is Required.');
			e.preventDefault();
			return false;
		}else{
			$(this).find('.form-group_first'+countersec).removeClass("has-erroring");
			$(this).find('.help-block_first').html('');
		}
		countersec++;
	});	 
});	


jQuery('.maxing').click(function(){
		var idimg = $(this).attr('id');
		var myides = idimg.split('_');
		var midssds = myides['1'];
		$.ajax({
		type :'POST',
        data :{id: midssds},
        url:'/exam/deleteidstudent',
        success: function(response){
            console.log(response); 
				location.reload();
        }
    });
		
	});
			 