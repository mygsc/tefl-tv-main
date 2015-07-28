()function(){
	var concern = function(){
		return {
			send: function(){
				$.ajax({
					type: 'POST',
					url: $(this).prop('action'),
					cache: false,
					data: $(this).serialize(),
					success: function(){
						alert('success');
					},
					error: function(){
						console.log('Opps error occured.');
					}
					
				});
			}
		}
	}();
	$('form#user-concern').submit(function(){
		concern.send();
	});
}();