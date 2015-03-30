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
			$.post('/mychannels/addPlaylist/'+text1, {name:name,description:description,privacy:privacy},function(data){
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
					$.post('/mychannels/removePlaylist/'+text1, {value:value},function(data){
					removeloader();
					});
			});
		});
	}

	function editTitle(){
		$('#playlistName').mouseenter(function(){
			var count = 0;
			$(this).append(' <span id="buttonEdit" class="fa fa-pencil" style="cursor:pointer"></span>');
				$('#buttonEdit').click(function(){
					count++;
					if(count<2){
						$('#playlistName').off("mouseenter");
						$('#playlistName').off("mouseleave");
						$('#playlistDesc').off("mouseenter");
						$('#playlistDesc').off("mouseleave");
						$('#playlistName').append('<div><input type="text" id="new_playlistName" style="width:150px"value="'+$('#playlistName').text().trim()+'"><input type="button" id="cancel" value="Cancel" class="btn btn-danger"><input type="button" id="submitEdit" value="Update" class="btn btn-info"></div>');
						$('#submitEdit').click(function(e){
							var name = $('#new_playlistName').val()
							var encrypt = $('#encrypt').val();
							e.preventDefault();
							if(name === ""){
								$('#new_playlistName').focus();
							}else{
								$.post('/mychannels/editTitle/'+encrypt,{name:name},function(data){
									editTitleloader();
								});
							}
						});
						$('#cancel').click(function(){
							$("#playlistName").load(window.location.href+' #playlistName',function(){
								create();
								removeToplaylist();
								editTitle();
								editDesc();
							});
						});
					}
				});
		});
		$('#playlistName').mouseleave(function(){
			$('#buttonEdit').remove();
		});
	}
	function editDesc(){
		$('#playlistDesc').mouseenter(function(){
			var count = 0;
			$(this).append(' <span id="buttonEditDesc" class="fa fa-pencil" style="cursor:pointer"></span>');
			$('#buttonEditDesc').click(function(){
			count++;
				if(count<2){
					$('#playlistDesc').off("mouseenter");
					$('#playlistDesc').off("mouseleave");
					$('#playlistName').off("mouseenter");
					$('#playlistName').off("mouseleave");
					$('#playlistDesc').append('<div ><textarea id="new_playlistDesc">'+$('#playlistDesc').text().trim()+'</textarea><input type="button" id="cancelDesc" value="Cancel" class="btn btn-danger"><input type="button" id="submitEditDesc" value="Update" class="btn btn-info"></div>');
					$('#submitEditDesc').click(function(e){
						var description = $('#new_playlistDesc').val();
						var encrypt = $('#encrypt').val();
						e.preventDefault();
						if(description === ""){
							$('#new_playlistDesc').focus();
						}else{
							$.post('/mychannels/editDesc/'+encrypt,{description:description},function(data){
									editDescloader();
							});
						}
					});
					$('#cancelDesc').click(function(){
						$("#playlistDesc").load(window.location.href+' #playlistDesc',function(){
							create();
							removeToplaylist();
							editTitle();
							editDesc();
						});
					});
				}
			});
		});

		$('#playlistDesc').mouseleave(function(){
			$('#buttonEditDesc').remove();
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
				editTitle();
				editDesc();
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
				editTitle();
				editDesc();
		});
	}
	function editTitleloader(){
		$("#playlistName").load(window.location.href+' #playlistName',function(){
			$('body').append('<div id="playlist-span-create"></div>');
				$('#playlist-span-create').html('Sucessfully edited');
				$('#playlist-span-create').css({
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
					if ($('#playlist-span-create').length > 0) {
						$('#playlist-span-create').remove();
					}
				}, 2000)
				create();
				removeToplaylist();
				editTitle();
				editDesc();
			});
		}
	function editDescloader(){
		$("#playlistDesc").load(window.location.href+' #playlistDesc',function(){
			$('body').append('<div id="playlist-span-create"></div>');
				$('#playlist-span-create').html('Sucessfully edited');
				$('#playlist-span-create').css({
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
					if ($('#playlist-span-create').length > 0) {
						$('#playlist-span-create').remove();
					}
				}, 2000)
				create();
				removeToplaylist();
				editTitle();
				editDesc();
			});
		}

	create();
	removeToplaylist();
	editTitle();
	editDesc();
});