$('.submit_button').hide();
var backup_section = $('#announcementsparent-section').html();
$(document).ready(function(){
 
 $('#markerDiv').click(function(e){
	 e.preventDefault();
  if ($('#checked_announce').is(":checked")) {

    $('#checked_announce').attr("checked", false);
  }
  else {
      $('#checked_announce').prop("checked", true);
  }
	
	  var goks =$('this').length;
	
if ($('#checked_announce').is(':checked')){
	$('#announcementsparent-class_id').attr('disabled','disabled');
	$('#announcementsparent-section').attr('disabled','disabled');
	$('#announcementsparent-section').html('<option value="0">All Section</option>');
		$('.apnd_student').html('All Classes Select');
		$('.submit_button').show();
}
else{
	$('#announcementsparent-class_id').removeAttr('disabled','disabled');
	$('#announcementsparent-section').removeAttr('disabled','disabled');
	$('#announcementsparent-section').html(backup_section);
		$('.apnd_student').html('');
		$('.submit_button').hide();
}
});


 $('#checked_announce').click(function(e){
	
	  var goks =$('this').length;
	
if ($('#checked_announce').is(':checked')){
	$('#announcementsparent-class_id').attr('disabled','disabled');
	$('#announcementsparent-section').attr('disabled','disabled');
	$('#announcementsparent-section').html('<option value="0">All Section</option>');
		$('.apnd_student').html('All Classes Select');
		$('.submit_button').show();
}
else{
	$('#announcementsparent-class_id').removeAttr('disabled','disabled');
	$('#announcementsparent-section').removeAttr('disabled','disabled');
	$('#announcementsparent-section').html(backup_section);
		$('.apnd_student').html('');
		$('.submit_button').hide();
}
});

});
$('#announcementsparent-class_id').change(function(){
	var backup_section_second = $('#announcementsparent-section').html();
	var mygetval = $(this).val();
	var goingrole = $('#getin_rolsd').val();
	if(goingrole != '5'){
			if(mygetval.length > 1){
			$('#announcementsparent-section').attr('disabled','disabled');
			$('#announcementsparent-section').html('<option value="0">All Section</option>');
			$('.apnd_student').html('Few classes and all section select.');
			$('.submit_button').show();
		}
		else {
			$('#announcementsparent-section').removeAttr('disabled','disabled');
			$('#announcementsparent-section').html(backup_section);
			$('.apnd_student').html('');
			$('.submit_button').hide();
		}
	}

});
$('#announcementsparent-section').change(function(){
	var class_id = $('#announcementsparent-class_id').val();
	var section = $(this).val();
	
	var academic = $('#announcementsparent-academic_year_id').val();
	var school = $('#announcementsparent-school_id').val();
	if(class_id != ''){
		$.ajax({
		type :'POST',
        data: {acad_id: academic, classi : class_id, sect : section, schl : school},
        url:'/anouncements/comm_getval',
        success: function(response){
			console.log(response);
			$('.apnd_student').html(response);
			if(response != 'No Result Found'){
				$('.submit_button').show();
			}else{
				$('.submit_button').hide();
			}
			
			$('#announcementsparent-student_id').multiSelect({
			  selectableHeader: '<input type=\'text\' class=\'search-input mysrchwidth\' autocomplete=\'off\' placeholder=\'Search\'>',
			  selectionHeader: '<input type=\'text\' class=\'search-input mysrchwidth\' autocomplete=\'off\' placeholder=\'Search\'>',
			  afterInit: function(ms){
				var that = this,
					$selectableSearch = that.$selectableUl.prev(),
					$selectionSearch = that.$selectionUl.prev(),
					selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
					selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

				that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
				.on('keydown', function(e){
				  if (e.which === 40){
					that.$selectableUl.focus();
					return false;
				  }
				});

				that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
				.on('keydown', function(e){
				  if (e.which == 40){
					that.$selectionUl.focus();
					return false;
				  }
				});
			  },
			  afterSelect: function(){
				this.qs1.cache();
				this.qs2.cache();
			  },
			  afterDeselect: function(){
				this.qs1.cache();
				this.qs2.cache();
			  }
			});
			$('#select-all').click(function(){
			  $('#announcementsparent-student_id').multiSelect('select_all');
			  return false; 
			});
			$('#deselect-all').click(function(){
			  $('#announcementsparent-student_id').multiSelect('deselect_all');
			  return false;
			});
		}
		});
	}
	else{
		alert('Please Select Class First');

	}
});
$('#announcementsparent-class_id').change(function(){
	var section = $('#announcementsparent-section').val();
	var class_id = $(this).val();
	
	var academic = $('#announcementsparent-academic_year_id').val();
	var school = $('#announcementsparent-school_id').val();
	$.ajax({
		type :'POST',
        data: {acad_id: academic, classi : class_id, sect : section, schl : school},
        url:'/anouncements/comm_getval',
        success: function(response){
			console.log(response);
			$('.apnd_student').html(response);
			if(response != 'No Result Found'){
				$('.submit_button').show();
			}else{
				$('.submit_button').hide();
			}
			
			$('#announcementsparent-student_id').multiSelect({
			  selectableHeader: '<input type=\'text\' class=\'search-input mysrchwidth\' autocomplete=\'off\' placeholder=\'Search\'>',
			  selectionHeader: '<input type=\'text\' class=\'search-input mysrchwidth\' autocomplete=\'off\' placeholder=\'Search\'>',
			  afterInit: function(ms){
				var that = this,
					$selectableSearch = that.$selectableUl.prev(),
					$selectionSearch = that.$selectionUl.prev(),
					selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
					selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

				that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
				.on('keydown', function(e){
				  if (e.which === 40){
					that.$selectableUl.focus();
					return false;
				  }
				});

				that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
				.on('keydown', function(e){
				  if (e.which == 40){
					that.$selectionUl.focus();
					return false;
				  }
				});
			  },
			  afterSelect: function(){
				this.qs1.cache();
				this.qs2.cache();
			  },
			  afterDeselect: function(){
				this.qs1.cache();
				this.qs2.cache();
			  }
			});
			$('#select-all').click(function(){
			  $('#announcementsparent-student_id').multiSelect('select_all');
			  return false; 
			});
			$('#deselect-all').click(function(){
			  $('#announcementsparent-student_id').multiSelect('deselect_all');
			  return false;
			});
		}
		});
});