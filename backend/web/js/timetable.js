	var base_url = window.location.origin;

	$('#getclass_id').attr('disabled', true);
	$('#getsubjectsd_id').attr('disabled', true);  
	$('#getsect_id').attr('disabled', true);  
	$('.lunch_session').hide();  
	
	
	
	$(function(){
		$( '.modal_button' ).click(function(){
			var new_id = $(this).attr('id');
			var splition = new_id.split('_');
			var dya_id = splition[1];
			var lecture_id = splition[2];
			$('#dayd_id').val(dya_id);
			$('#lectures_id').val(lecture_id);
			var migrt = $('.newbrks').attr('id');
			//alert(migrt);
			 if(migrt == undefined){
				var olking = '';
			}else{
				var getmarksings = migrt.split('_');
			var olking = getmarksings[1];
			} 
			
			  if(olking == lecture_id){
				$('.lunch_session').show();
			}else{
				if(lecture_id == '5' || lecture_id == '6' || lecture_id == '7' ){
				if(olking == ''){
				   $('.lunch_session').show(); 	
				}else{
					$('.lunch_session').hide(); 	
				}
				 
			}else {
				$('.lunch_session').hide(); 
			}
			} 
			 /* if(lecture_id == '5' || lecture_id == '6' || lecture_id == '7' ){
				$('.lunch_session').show();  
			}else {
				$('.lunch_session').hide(); 
			}  */
		});
		
		$('#getclass_id').change(function(e){
			var clasign = $(this).val();
			$.ajax({
			type :'POST',
			data: {class_ids: clasign},
			url:'/timetable/getsection',
			success: function(response){
				$('#getsect_id').html(response);
				$('#getsect_id').attr('disabled', false);  
				}
			});
			
		});
		
		$('.getrdsio input[type="radio"]').click(function(){
			var inputValue = $(this).attr("value");
			if(inputValue == '1'){
				$('#getclass_id').attr('disabled', false);
				$('.lunch_session input[type="checkbox"]').attr('disabled', true);
			}
			else{
			$('#getclass_id').attr('disabled', true);
				$('#getsubjectsd_id').attr('disabled', true);  
				$('#getsect_id').attr('disabled', true);  
				$('.lunch_session input[type="checkbox"]').attr('disabled', false);
			}
			
		});
		
		$('.lunch_session input[type="checkbox"]').click(function(){
			var inputValues = $('.lunch_session input[type="checkbox"]:checked').length;
			if(inputValues == '1'){
				$('.getrdsio input[type="radio"]').attr('disabled', true);
			}
			else{
			$('.getrdsio input[type="radio"]').attr('disabled', false); 
			}
			
		});
		
		$('#getsect_id').change(function(e){
			var classing_three = $('#getclass_id').val();
			var sectignh = $(this).val();
			$.ajax({
			type :'POST',
			data: {class_ids: classing_three,sectionsd: sectignh},
			url:'/timetable/getsubject',
			success: function(response){
				$('#getsubjectsd_id').html(response);
				$('#getsubjectsd_id').attr('disabled', false);  
				}
			});
		})
		
		$( '.submition_button' ).click(function(e){
			
			var rdiosval = $('input[name=status]:checked').val();
			var class_names = $('#getclass_id').val();
			var section_names = $('#getsect_id').val();
			var subject_names = $('#getsubjectsd_id').val();
			var acasd_nms = $('#getacad_id').val();
			var techr_oid = $('#teach_id').val();
			var day_isd = $('#dayd_id').val();
			var lectds_id = $('#lectures_id').val();
			var lect_statlngth = $('input[name=status]:checked').length;
			var brek = $('input[name=breaklunch]:checked').val();
			var breklenght = $('input[name=breaklunch]:checked').length;
			
			if(lect_statlngth <= 0 && breklenght != 1 )
			{
			 alert("Please select Lecture Status");
			
			}else
			if((rdiosval != '0' && rdiosval != '' && breklenght != 1) && (class_names == '')){
				alert("Please select Class");
				
			}
			else if((rdiosval != '0' && rdiosval != '' && breklenght != 1) && (class_names != '') && (section_names == '')){
				alert("Please select Section");
				
			}
		 	else if((rdiosval != '0' && rdiosval != '' && breklenght != 1) && (section_names != '') && (subject_names == '')){
				alert("Please select Subject");
				
			}else {
				$.ajax({ 
			type :'POST',
			data: {class_ids: class_names,section_ids: section_names,subject_ids: subject_names,academic_ids: acasd_nms,techr_ids: techr_oid,day_ids: day_isd,lectr_ids: lectds_id, stets: rdiosval, brkpoint: brek,},
			url:'/timetable/create',
			success: function(response){
				if(response == 'done'){
				location.reload();	
				}
				}
			}); 
			}
		 	 			
			e.preventDefault();
		});
		
	});
	