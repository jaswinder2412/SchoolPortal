$('.next_level').hide();
$('.new_save_buttons').hide();
$('.cancel_once').hide();
$('.succeed_messages').hide();

$(function(){
		$( '.update_once' ).click(function(){
			$(this).closest('tr').find('.next_level').show();
			$(this).closest('tr').find('.show_marks').hide();
			$(this).closest('tr').find('.new_save_buttons').show();
			$(this).closest('tr').find('.cancel_once').show();
			$(this).hide();
		});
		
		$( '.cancel_once' ).click(function(){
			$(this).closest('tr').find('.next_level').hide();
			$(this).closest('tr').find('.show_marks').show();
			$(this).closest('tr').find('.new_save_buttons').hide();
			$(this).closest('tr').find('.update_once').show();
			$(this).hide();
		});
		
		$('.new_save_buttons').click(function(){
			var numbers_in = $('.numbers_in_hidden').attr('value');
			
			var myvariable = $(this);
			if(numbers_in == '0'){
			var markings = [];
			var subjcing = [];
			
			var exam_ids = $(this).closest('tr').find('#exam_iid').val();
			var class_ids = $(this).closest('tr').find('#class_iid').val();
			var student_ids = $(this).closest('tr').find('#student_iid').val();			
			var subjct_idss = $(this).parents('tr').find('.next_level input');
			subjct_idss.each(function(){
				var idsp = $(this).attr('id');
				var subjectsd = idsp.split('_');
				subjcing.push(subjectsd[2]);
				markings.push($(this).val());
			})
			
			$.ajax({
			type :'POST',
			data: {exam_id: exam_ids,class_id: class_ids,student_id: student_ids,subject_id: subjcing,mark_val: markings,},
			url:'/teacher-manage-grade/update_markes',
			success: function(response){
			myvariable.closest('tr').find('.next_level').hide();
				var counter=0;
			myvariable.closest('tr').find('.show_marks').show().each(function(){
				$(this).html(markings[counter]);
				counter++;
			})
			myvariable.hide();
			$('.succeed_messages').show();
			myvariable.closest('tr').find('.cancel_once').hide();
			myvariable.closest('tr').find('.update_once').show();
				}
			});
			}
			else{
				
			var gradings = [];
			var subjcing = [];
			
			var exam_ids = $(this).closest('tr').find('#exam_iid').val();
			var class_ids = $(this).closest('tr').find('#class_iid').val();
			var student_ids = $(this).closest('tr').find('#student_iid').val();			
			var subjct_idss = $(this).parents('tr').find('.next_level select');
			subjct_idss.each(function(){
				var idsp = $(this).attr('id');
				var subjectsd = idsp.split('_')
				subjcing.push(subjectsd[2]);
				gradings.push($(this).val());
			})
			
			$.ajax({
			type :'POST',
			data: {exam_id: exam_ids,class_id: class_ids,student_id: student_ids,subject_id: subjcing,grade_val: gradings,},
			url:'/teacher-manage-grade/update_gradess',
			success: function(response){
			myvariable.closest('tr').find('.next_level').hide();
			var counter=0;
			myvariable.closest('tr').find('.show_marks').show().each(function(){
				$(this).html(gradings[counter]);
				counter++;
			})
			myvariable.hide();
			$('.succeed_messages').show();
			myvariable.closest('tr').find('.cancel_once').hide();
			myvariable.closest('tr').find('.update_once').show();
			//	window.location.reload();
				}
			});
			}
		 
		});
});