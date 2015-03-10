$(document).ready(function() {
	var subscribe = true;
	
		$("#subscribe").click(function() {

				if(subscribe == true) {
					$(this).html('Unsubscribe');
					subscribe = false;
				}else{
					$(this).html('Subscribe');
				subscribe = true;
				}
			});	
});