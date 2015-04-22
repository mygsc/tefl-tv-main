// $('#dropdown').change(function() {

function dynamic_select(dropdown){
	// alert('asd');
	var userId = $('#userChannel_Id').val();
	$.ajax({
		type: 'GET',
		url: '/mychannels/sortvideos',
		data: {'ch': dropdown, 'userid' : userId},
		dataType: 'html',
		success: function(data){
			console.log(data);
			$('#videosContainer').html(data);
		}
// 		}
	});
}
// });

	
