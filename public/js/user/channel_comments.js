$(document).ready(function() {
	$('form#postFeedback').on('submit',function(e) {
		e.preventDefault();

		var url = $(this).prop('action');

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: $(this).serialize(),
				success: function(data){
					if(data['status'] == 'error'){
						alert(data['label']);
					}else{
						console.log(data);
						$('#feedbacksContainer').append(data);
						$('#textAreaFeedback').val('');
					}
					
				}

		});
	});
});