$(document).ready(function(){

	function create(){
		$('#create-playlist-button').click(function(e){
			var text1 = $('#text1').val()
			var name = $('#create-playlist-text').val();
			var description = "Untitled";
			var privacy = "0";
			e.preventDefault();
			if(name === ""){
				$('#create-playlist-text').focus();
			}else{
			$.post('http://localhost:8000/mychannels/addPlaylist/'+text1, {name:name,description:description,privacy:privacy},function(data){
				 $('#create-playlist-text').val("")
					loader();
				});
			}
		});
	}
	function removeToplaylist(){
		$('button[id^=removeToplaylist]').each(function(){
			$(this).click(function(e){
				var value = $(this).attr('data-encrypt');
				var text1 = $(this).attr('data-encrypt2');
				e.preventDefault();
					$.post('http://localhost:8000/mychannels/removePlaylist/'+text1, {value:value},function(data){
					removeloader();
					});
			});
		});
	}

	function loader(){
	$("#videosContainer").load(window.location.href+' #videosContainer',function(){
		$('body').append('<div id="playlist-div-create"></div>');
			$('#playlist-div-create').html('Sucessfully created');
			$('#playlist-div-create').css({
	         'opacity' : 0.7,
	         'position': 'fixed',
	         'top': 0,
	         'left': 0,
	         'background-color': 'black',
	         'color':'white',
	         'width': '150px',
	         'height':'50px',
	         'z-index': 5000
			});
			setTimeout(function(){
				if ($('#playlist-div-create').length > 0) {
					$('#playlist-div-create').remove();
				}
			}, 2000)
			create();
			removeToplaylist();
		});
	}

	function removeloader(){
	$("#videosContainer").load(window.location.href+' #videosContainer',function(){
		$('body').append('<div id="playlist-div-remove"></div>');
			$('#playlist-div-remove').html('Sucessfully removed');
			$('#playlist-div-remove').css({
	         'opacity' : 0.7,
	         'position': 'fixed',
	         'top': 0,
	         'left': 0,
	         'background-color': 'black',
	         'color':'white',
	         'width': '150px',
	         'height':'50px',
	         'z-index': 5000
			});
			setTimeout(function(){
				if ($('#playlist-div-remove').length > 0) {
					$('#playlist-div-remove').remove();
				}
			}, 2000)
			create();
			removeToplaylist();
		});
	}

	create();
	removeToplaylist();
});