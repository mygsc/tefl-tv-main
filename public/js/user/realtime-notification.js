function countNotification(){
	var returnData = false;

	$.ajax({
		type: 'GET',
		cache: false,
		url: '/mychannels/countnotifications',
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

function loadNotifcation(){
	$.ajax({
		type: 'POST',
		cache: false,
		url: '/mychannels/loadnotifications',
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
	countNotification();
	setInterval(function(){
		if(countNotification() === true){
			var timer = function(){setInterval(function(){
				countNotification();
			}, 500);
		};
		}else{
			clearInterval(timer);
		}
	},15000);
};

$('#document').ready(function(){
	notificationTimer();

	$('#notification').click(function(){
		loadNotifcation();
	});
});

