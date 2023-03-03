var img = $('.thumbnail');

 if (img.attr('src') == '/assets/13212436/img/nophoto.png') {

		$('#hsd').hide();
		$('.tar').show();

}
else{
	  $(document).ready(function(){
		$('#hsd').show();
		$('.tar').hide();
});
}
 $( '.target' ).click(function() {
	$('#hsd').show();
	$('.tar').hide();
	 
}); 
$(document).on('click','input[type=file]',function(){
	$('#hsd').hide(); 
$('.tar').show(); 
	
});

$( '.tgt' ).click(function() {
	$('#hsd').hide();
	$('.tar').show();
});
  