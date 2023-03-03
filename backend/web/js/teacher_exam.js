$('.help-block_second').hide();

$('#teacherexamclass-subject_id').change(function(e){
	var clasign = $(this).val();
	$.ajax({
	type :'POST',
	data: {subject_ids: clasign},
	url:'/teacher-test-exam/getsubjectforteacher',
	success: function(response){
		$('.apnd_classing').html(response);
		}
	});
});

$( document ).ready(function() {
	$('body').on('click', '#alclassing', function(){
		 
		$(".apnd_classing .mrtzs input[type=checkbox]").not(this).prop('checked', this.checked);
		
		if ($('#alclassing').is(':checked')){
			
		$(".apnd_classing .mrtzs input[type=checkbox]").attr('disabled','disabled');
		}
		else {
			$(".apnd_classing .mrtzs input[type=checkbox]").removeAttr('disabled','disabled');
		}
	});
	
	
	 $('#checkBtn').click(function() {
	 var cuisines = $('#teacherexamclass-subject_id').val();
      checked = $(".apnd_classing input[type=checkbox]:checked").length;

      if(!checked && cuisines != '') {
       $('.help-block_second').show();
        return false;
      }else{
		  $('.help-block_second').hide();
	  }

    });
 	
});