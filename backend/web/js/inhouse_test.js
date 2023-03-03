		 $('.chkbxs').hide();
		
		$('#inhousetest-class_id').change(function(e){
			var clasign = $(this).val();
			$.ajax({
			type :'POST',
			data: {class_ids: clasign},
			url:'/inhouse-test/getsection',
			success: function(response){
				$('.apnds_classing').html(response);
				}
			});
		});
		
		
		$( document ).ready(function() {
			
			$('#getselectionexam').change(function(){
				$('#toggle-search').submit();
			})
			
			
	$('body').on('click', '#alclassing', function(){
		 
		$(".apnds_classing .mrtzs input[type=checkbox]").not(this).prop('checked', this.checked);
		
		if ($('#alclassing').is(':checked')){
			
		$(".apnds_classing .mrtzs input[type=checkbox]").attr('readonly','readonly');
		}
		else {
			$(".apnds_classing .mrtzs input[type=checkbox]").removeAttr('readonly','readonly');
		}
	});
	
	$('#checkBtn').click(function() {
	 var cuisines = $('#finalexam-class_id').val();
      checked = $(".apnds_classing input[type=checkbox]:checked").length;
		
      if(!checked && cuisines != '') {
       $('.chkbxs').show();
        return false;
      }else{
		  $('.chkbxs').hide();
	  }

    });
	
	var rowminesd = $('#theDaastatable').find('tbody').children('tr:first').find(".wrpe_dis");
	var lineanthigt = $('#theDaastatable').find('tbody').children('tr:first').find(".mrhus");
	var icoind = $('#theDaastatable').find('tbody').children('tr:first').find("i");
		rowminesd.addClass('open');
		icoind.removeClass('fa-plus');
		  icoind.addClass('fa-minus');
		  rowminesd.height(lineanthigt.outerHeight(true));
	
	$(function() {
	  var b = $(".ptr_buton");
	  
	  b.click(function() {
		  var w = $(this).parent('div').find(".wrpe_dis");
			var l = $(this).parent('div').find(".mrhus"); 
			var i = $(this).find('i'); 
		
		if (w.hasClass('open')) {
		  w.removeClass('open');
		  i.removeClass('fa-minus');
		  i.addClass('fa-plus');
		  w.height(0);
		} else {
		  w.addClass('open');
		   i.removeClass('fa-plus');
		  i.addClass('fa-minus');
		  w.height(l.outerHeight(true));
		}

	  });
});
	
});

		$('#finalexam-section_id').change(function(e){
			var sections = $(this).val();
			var clasign = $('#finalexam-class_id').val();
			$.ajax({
			type :'POST',
			data: {class_ids: clasign, section_id: sections},
			url:'/final-exam/getsubject',
			success: function(response){
				$('#finalexam-subject_id').html(response);
				$('#finalexam-subject_id').removeAttr("disabled");
				}
			});
		});
		
		$('.mint_one').find('.exm_dts').each(function(){
			$(this).datepicker({
				minDate: 0,
			});
		});
		
		 $('.max_marks').keyup(function() {
					var $this = $(this);
					$this.val($this.val().replace(/[^\d]/g, ''));        
				});
		 
		$('.add_subjectsd').click(function(e){
			var error = 0;
			var sujbctd = []; var exm_dst = []; var assgn_tech = [];  var maxnumber = [];
			var subjs = $(this).parent('.mint_one').find('.subgtc');
			var techr = $(this).parent('.mint_one').find('.assigning_tech');
			var exam_dt = $(this).parent('.mint_one').find('.exm_dts'); 
			var marksaad = $(this).parent('.mint_one').find('.max_marks'); 
			var idsp = $(this).attr('id');
			var finals_id = idsp.split('_');
				
			subjs.each(function() {
				sujbctd.push($(this).val());
				
				
			});
			
			techr.each(function() {
				assgn_tech.push($(this).val());
				
				
			});
			exam_dt.each(function() {
				exm_dst.push($(this).val());
				var mikers = $(this).val();
				
			}); 
			marksaad.each(function() {
				maxnumber.push($(this).val());
				var mikerss = $(this).val();
			
			});
			var myclsd = $(this).parent('.mint_one').find('.myvalids');
		
		 myclsd.each(function(){
				var mkls = $(this).find('.exm_dts').val();
				var mmards = $(this).find('.max_marks').val();
				if(mkls != '' && mmards == ''){
					$(this).find('.max_marks').parent('div').find('.help-block_second').html('Please enter Maximum Marks.');
					error++;
				}else{
					$(this).find('.max_marks').parent('div').find('.help-block_second').html('');
				}

			});
			
		
			 if(error > 0){
				return false;
			} 
			 
			$.ajax({
			type :'POST',
			data: {exam_id: finals_id[1],subject: sujbctd,exam_date: exm_dst,assigned_teacher: assgn_tech, maximum_numbers: maxnumber},
			url:'/inhouse-test/addsubject',
			success: function(response){
					location.reload(); 
				}
			});
			e.preventDefault(); 
		});


