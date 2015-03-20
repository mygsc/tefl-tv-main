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
		$('#looking-notification').show();
		$('#loading-notification').show();
		setTimeout(function(){
			$.ajax({
				type: 'POST',
				cache: false,
				url: '/mychannels/loadnotifications',
				data: { 'uid': uid },
				success: function (data){
					var notifications = data;
					if(notifications.length < 1){
						$('#no-notification').remove();
						$('#looking-notification').after('<small id="no-notification">No notification</small>');
					}else{
						$('.notification-item').remove();
						$.each(notifications, function(i, item) {
							$('#looking-notification').after('<li class="notification-item">'+item.notification+'</li>').fadeIn();
						});
						$('#no-notification').remove();
					}
					$('#looking-notification').hide();
					$('#loading-notification').hide();
				}
			});
		}, 1500);
	})
});
