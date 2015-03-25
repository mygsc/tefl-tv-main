var checkTimeout = function($param1, $param2){

}

$('#document').ready(function(){
	uid = $('#notif_u_token').val();

	setInterval(function(){
		$.ajax({
			type: 'POST',
			cache: false,
			url: '/mychannels/countnotifications',
			data: { 'uid': uid },
			success: function (data){
				var notifications = data;
				$('#notification-counter').html(notifications.length);
			}
		});
	}, 5000);

	$('#notification').click(function(){
		$.ajax({
			type: 'POST',
			cache: false,
			url: '/mychannels/loadnotifications',
			data: { 'uid': uid },
			beforeSend: function(){
				$('#loading-notification').show();
			},
			success: function (data){
				var notifications = data;
				$('.notification-item').remove();

				if(notifications.length < 1){
					$('#loading-notification').after('<small id="no-notification">No notification</small>');
				}else{
					$('#no-notification').remove();
				}

				$.each(notifications, function(i, item) {
					$('#loading-notification').after('<li class="notification-item">'+item.notification+'</li>').fadeIn();
				});

				$('#loading-notification').hide();
			}
		});
	});
});
