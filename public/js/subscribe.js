$(document).ready(function() {
	var subscribe = true;


	// $("button").click(function() {
	// 	$("button").attr( "id=subscribe",function(arr) {
	// 		return arr;
	// 	)}.each(function() {
	// 		alert(arr);
	// 	})
	// });

	$("#subscribe").click(function() {

		if(subscribe == true) {
			$(this).html('Unsubscribe');
			subscribe = false;
		}else{
			$(this).html('Subscribe');
			subscribe = true;
		}
	});	
	$('form#subscribe-userChannel').on('submit', function(e){
		e.preventDefault();
		var url = $(this).prop('action');
		$.ajax({
			type: 'POST',
			url: url,
			cache: false, 
            data: $(this).serialize(),//{
	        success: function(data){
        		$('input[name=status]').val(data['status']);
        		$('input[id=subscribebutton]').val(data['label']);
	        	alert(data['status']);
            	// window.location.href = 'search/product?'+q;
           	}
	    });
	});
});