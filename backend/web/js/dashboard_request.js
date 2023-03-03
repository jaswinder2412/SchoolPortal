$( document ).ready(function() {
			
			$('#getselectionexams').change(function(){
				
				var exam_ids = $(this).val();
				$.ajax({
				type :'POST',
				data: {exam_id: exam_ids,},
				url:'/site/exam_student',
				success: function(response){
					$('.exam_mine_subjcts').html(response);
					}
				});
			});
			
			$('#getselectiontests').change(function(){
				
				var test_ids = $(this).val();
				$.ajax({
				type :'POST',
				data: {test_id: test_ids,},
				url:'/site/test_student',
				success: function(response){
					$('.testmine_subjcts').html(response);
					}
				});
			});
			
			$('#acadhochnge').change(function(){
				
				$('#toggle-acadsearch').submit();
			});
			
			
			
			
			
			
});  