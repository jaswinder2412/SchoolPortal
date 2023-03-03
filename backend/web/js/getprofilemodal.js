
/* alert(document.URL); */

$('.gting_data').click(function(){
	var mod_id = $(this).attr('rel');
		$.ajax({
			type :'POST',
			data: {id: mod_id},
			url:'/staff/profile_data',
			success: function(response){
				$('.modals_dats').html(response);
				}
			});
	
});