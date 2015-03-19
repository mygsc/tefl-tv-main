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
		});
	}
	create();
});