
	$(function(){

		$( '#classassignedstudent-class_id' ).change(function(){
			var class_id = $(this).val();
			$.ajax({
				type :'POST',
				data: {class_ids: class_id},
				url:'/adduser/getsection',
				success: function(response){
					
					$('#classassignedstudent-section_id').html(response);
					$('#classassignedstudent-section_id').removeAttr('disabled');
					
					}
				});
		});
	 }); 
	 		
 
	