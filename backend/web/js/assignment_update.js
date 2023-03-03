$('.first_type_error').hide();
$('#assignmentclasses-student_id').multiSelect({
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
			  $('#assignmentclasses-student_id').multiSelect('select_all');
			  return false; 
			});
			$('#deselect-all').click(function(){
			  $('#assignmentclasses-student_id').multiSelect('deselect_all');
			  return false;
			});
				$('#gangores').click(function(e){
		var elifin = $('#assignmentclasses-student_id').val();
		
		if((elifin == null) || (elifin == '')){
			$('.first_type_error').show();
			e.preventDefault();
		} else {
			$('.first_type_error').hide();
		}
	});