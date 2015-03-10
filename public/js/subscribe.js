$(document).ready(function() {
	var subscribe = true;


	// $("button").click(function() {
	// 	$("button").attr( "id=subscribe",function(arr) {
	// 		return arr;
	// 	)}.each(function() {
	// 		alert(arr);
	// 	})
	// });
	
		$("button").click(function() {

				if(subscribe == true) {
					$(this).html('Unsubscribe');
					subscribe = false;
				}else{
					$(this).html('Subscribe');
				subscribe = true;
				}
			});	
});