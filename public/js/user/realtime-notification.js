function countNotification(uid){
	var returnData = false;

	$.ajax({
		type: 'GET',
		cache: false,
		url: '/mychannels/countnotifications',
		data: { 'uid': uid },
		success: function (data){
			var notifications = data;
			if(notifications.length > 0){
				$('#notification-counter').html(notifications.length);
				returnData = true;
			}
		}
	});
	return returnData;
};

function loadNotifcation(uid){
	$.ajax({
		type: 'POST',
		cache: false,
		url: '/mychannels/loadnotifications',
		data: { 'uid': uid },
		beforeSend: function(){
			$('#loading-notification').show();
			$('.no-notification').remove();
		},
		success: function (data){
			var notifications = data;
			$('.notification-item').remove();

			if(notifications.length < 1){
				$('#loading-notification').after('<small class="no-notification">No notification</small>');
			}else{
				$('#no-notification').remove();
			}

			$.each(notifications, function(i, item) {
				$('#loading-notification').after('<div class="notification-item ">'+item.notification+'</div>').fadeIn();
			});

			$('#loading-notification').hide();
		}
	});
};

function notificationTimer(){
	countNotification(uid);
	setInterval(function(){
		if(countNotification(uid) === true){
			var timer = function(){setInterval(function(){
				countNotification(uid);
			}, 500);
		};
		}else{
			clearInterval(timer);
		}
	},15000);
};

$('#document').ready(function(){
	uid = $('#notif_u_token').val();

	notificationTimer();

	$('#notification').click(function(){
		loadNotifcation(uid);
	});
});

