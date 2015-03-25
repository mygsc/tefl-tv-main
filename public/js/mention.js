$(document).ready(function(){
	$('#tags1').keypress(function(e) {
		if(e.which == 64){

			$('#tags1').autocomplete({
				source: '/mychannels/post-feedbacks',
				minLength: 0,
				select: function(event, ui) {
					$('#tags1').val(ui.item.label);
				}
			});
			
		}else{
			false;
		}
	});
	
});