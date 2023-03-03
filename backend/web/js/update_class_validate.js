var my_valdsd =  $("#chechk_valuecount").val();
if(my_valdsd !='' && my_valdsd !='0'){
	var counter = my_valdsd;
}else{
	var counter = 0;
}
 var slctionsub = $('.apsnd_class_update').find('#classsubject-subject_id').html();
var slctiontchr = $('.apsnd_class_update').find('#classsubject-assigned_teacher_id').html();
	$(function(){
		$( '#adding_cls' ).click(function(){
		counter++;
		$('.addition_clsdd').append('<div class="row"></div><div class="myclone chek_select"><div class="apsnd_class"><div class="col-md-6 "><div class="form-group'+counter+'"><div class="form-group_first'+counter+' field-classsubject-subject_id_'+counter+'"><label class="control-label" for="classsubject-subject_id_'+counter+'">Subject</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div><select id="classsubject-subject_id_'+counter+'" class="form-control rate" name="ClassSubject[subject_id][]">'+slctionsub+'</select></div><div class="help-block_first"></div></div></div></div><div class="col-md-6"><div class="form-group_'+counter+'"><div class="form-group_second'+counter+' field-classsubject-assigned_teacher_id_'+counter+'"><label class="control-label" for="classsubject-assigned_teacher_id">Assign Teacher</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div><select id="classsubject-assigned_teacher_id_'+counter+'" class="form-control rate_second" name="ClassSubject[Assigned_teacher_id][]">'+slctiontchr+'</select></div><div class="help-block_second"></div></div></div></div></div><a class=" pull-right" id="rmvgd"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');
		
		});
	 }); 
 
	$(document).on('click','#rmvgd',function(){
		
	counter--;
				$(this).closest('.myclone').remove(); 
	
		});

$('#hum').click(function(e) {


var i;
for (i = 0; i < my_valdsd; i++) {
	
   var myfirstclass = $("#classsubject-subject_id_"+i).val();
		var mysecond = $("#classsubject-assigned_teacher_id_"+i).val();
		if(myfirstclass != '' && mysecond == ''){
			$('.form-group_second_doin_'+i).addClass("has-erroring");
			$('.help-block_second_doin_'+i).html('Teacher is Required.');
			e.preventDefault();
			return false;
		}else{
			$('.form-group_second_doin_'+i).removeClass("has-erroring");
			$('.help-block_second_doin_'+i).html('');
		}
		if(mysecond != '' && myfirstclass == ''){
			$('.form-group_first_doin_'+i).addClass("has-erroring");
			$('.help-block_first_doin_'+i).html('Subject is Required.');
			e.preventDefault();
			return false;
		}else{
			$('.form-group_first_doin_'+i).removeClass("has-erroring");
			$('.help-block_first_doin_'+i).html('');
		}
			
}



if(my_valdsd !='' && my_valdsd !='0'){
	
	var countersec = my_valdsd;
}else{
	var countersec = 0; 
}

	$( ".chek_select" ).each(function() {
		countersec++;
		var firstselect = $(this).find("#classsubject-subject_id_"+countersec).val();
		var second = $(this).find("#classsubject-assigned_teacher_id_"+countersec).val();
		if(firstselect != '' && second == ''){
			$(this).find('.form-group_second'+countersec).addClass("has-erroring");
			$(this).find('.help-block_second').html('Teacher is Required.');
			e.preventDefault();
			return false;
		}else{
			$(this).find('.form-group_second'+countersec).removeClass("has-erroring");
			$(this).find('.help-block_second').html('');
		}
		if(second != '' && firstselect == ''){
			$(this).find('.form-group_first'+countersec).addClass("has-erroring");
			$(this).find('.help-block_first').html('Subject is Required.');
			e.preventDefault();
			return false;
		}else{
			$(this).find('.form-group_first'+countersec).removeClass("has-erroring");
			$(this).find('.help-block_first').html('');
		}
		
	});
});	
			 
		
$('.importing_selection').hide();


$('#importing').click(function(e) { 
$('.importing_selection').show();
});	

$('#acad_select').change(function(e) { 
var acad_val = $(this).val();
if(acad_val !=''){
			$.ajax({
		type :'POST',
        data: {acad_id: acad_val},
        url:'/classinfo/view',
        success: function(response){
            console.log(response); 
			$('.orignal_select').hide();
			$('.custom_selections').html(response);
			$('#classstudent-student_id_second').multiSelect({
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
$('#select-all_new').click(function(){
  $('#classstudent-student_id_second').multiSelect('select_all');
  return false; 
});
$('#deselect-all_new').click(function(){
  $('#classstudent-student_id_second').multiSelect('deselect_all');
  return false;
});

        }
    });
}

});



$('#classstudent-student_id').multiSelect({
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


	