$('.anounceerroing').hide();

$('#announcementsteacher-announcements_to').multiSelect({
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

$('#select-all_anounce').click(function(){
  $('#announcementsteacher-announcements_to').multiSelect('select_all');
  return false; 
});
$('#deselect-all_anounce').click(function(){
  $('#announcementsteacher-announcements_to').multiSelect('deselect_all');
  return false;
});



$('#announcementsteacher-announcements_to_second').multiSelect({
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

$('#select-all_anounce_second').click(function(){
  $('#announcementsteacher-announcements_to_second').multiSelect('select_all');
  return false; 
});
$('#deselect-all_anounce_second').click(function(){
  $('#announcementsteacher-announcements_to_second').multiSelect('deselect_all');
  return false;
});

$('#announcementsteacher-announcements_to_third').multiSelect({
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

$('#select-all_anounce_third').click(function(){ 
  $('#announcementsteacher-announcements_to_third').multiSelect('select_all');
  return false; 
});
$('#deselect-all_anounce_third').click(function(){
  $('#announcementsteacher-announcements_to_third').multiSelect('deselect_all');
  return false;
});


 $('#hermiyni').click(function(e){
	var get_value =$('#announcementsteacher-announcements_to_second').val();
	var get_value_second =$('#announcementsteacher-announcements_to_third').val();
	if((get_value =='' || get_value == null) && (get_value_second =='' || get_value_second == null) && (!jQuery("#checkboxig").is(":checked"))){
		$('.anounceerroing').show();
		e.preventDefault();
	}else {
		$('.anounceerroing').hide();
		
	}
	
	
	
});