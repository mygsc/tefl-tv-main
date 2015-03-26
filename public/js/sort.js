// $('#dropdown').change(function() {

function dynamic_select(dropdown){
	// alert('asd');
	$.ajax({
		type: 'GET',
		url: '/mychannels/sortvideos',
		data: 'ch=' + dropdown,
		dataType: 'html',
		success: function(data){
			console.log(data);
			$('$videosContainer').html(data);
		}
// 		}
	});
}
// });

	
