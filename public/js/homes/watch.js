$(document).ready(function(){
	$('a[id^="videourl"]').each(function(){
		var url = $(this).attr('href');
		$(this).each(function(){
		var new_url = url.replace(/[\*\^\'\!\@\#\$\&\(\)\/]/g, '').replace(/ /g,'+');
			$(this).attr('href',new_url);
		});
	});
	function addToFavorites(){
		$('#addToFavorites').click(function(){
			var text1 = $('#text1').val();
			$.post('http://localhost:8000/mychannels/addToFavorites/'+text1,function(data){
					addfavoriteLoader();
				});
		});
	}
	function removeToFavorites(){
		$('#removeToFavorites').click(function(){
			var text1 = $('#text1').val();
			$.post('http://localhost:8000/mychannels/removeToFavorites/'+text1,function(data){
					removefavoriteLoader();
				});
		});
	}
	function addToWatchLater(){
		$('#addToWatchLater').click(function(){
			var text1 = $('#text1').val();
			$.post('http://localhost:8000/mychannels/addToWatchLater/'+text1,function(data){
					addwatchLaterLoader();
				});
		});
	}
	function removeToWatchLater(){
		$('#removeToWatchLater').click(function(){
			var text1 = $('#text1').val();
			$.post('http://localhost:8000/mychannels/removeToWatchLater/'+text1,function(data){
					removewatchLaterLoader();
				});
		});
	}
	function deletelist(){
	$('input[id^="playlist"]').each(function(){
		var list = $(this);
		list.click(function(e){
			var text1 = $('#text1').val();
			var value = list.val();
				$.post('http://localhost:8000/mychannels/removePlaylist/'+text1, {value:value},function(data){
					deleteLoader();
				});
			});

		});
	}
	function addToPlaylist(){
	$('input[id^="availablePlaylist"]').each(function(){
		var list = $(this);
		list.click(function(e){
			var text1 = $('#text1').val();
			var value = list.val();
				$.post('http://localhost:8000/mychannels/addChkBoxPlaylist/'+text1, {value:value},function(data){
					addLoader();
				});
			});
		});
	}
	function createPlaylist(){
		var count = 0;
		$('#createPlaylist').click(function(){
			var create = $(this);
			count++;
			if(count<2){
				createtext(create);
				
			}
		});
	}
	function createtext(create){
		$('#list').append('<input type="text" name="playlist" id="create" placeholder="Create playlist"><textarea placeholder="Description" id="description"></textarea><select id="privacy"><option value="1">Publish</option><option value="0">Unpublish</option></select><br/><button id="back">Back</button><input type="submit" id="submit" value="Create"/>');
			create.hide();
			$('#list-checkbox').hide();
			$('#search-playlist').hide();
			$('#back').click(function(){
				backlist(create);	
			});
			$('#submit').click(function(e){
			var text1 = $('#text1').val();
			var name = $('input[id=create]').val();
			var description = $('textarea[id=description]').val();
			var privacy = $('select[id=privacy]').val();
			if(name === ""){
				$('input[id=create]').focus();
			}
			else if(description === ""){
				$('textarea[id=description]').focus();
			}
			else{
				e.preventDefault();
				$.post('http://localhost:8000/mychannels/addPlaylist/'+text1, {name:name,description:description,privacy:privacy},function(data){
					loader();
				});
			}
			});
			
	}
	function backlist(create){
		
			create.show();
			$('#list-checkbox').show();
			$('#search-playlist').show();
			$('#create').hide();
			$('#description').hide();
			$('#privacy').hide();
			$('#back').hide();
			$('#submit').hide();
			createPlaylist2();
		
	}
	function createPlaylist2(){
		var count = 0;
		$('#createPlaylist').click(function(){
			var create = $(this);
			count++;
			if(count<2){
				create.hide();
				$('#create').show();
				$('#description').show();
				$('#privacy').show();
				$('#back').show();
				$('#submit').show();
				$('#list-checkbox').hide();
				$('#search-playlist').hide();
				$('#back').click(function(){
					backlist(create);	
				});
				$('#submit').click(function(e){
				var text1 = $('#text1').val();
				var name = $('input[id=create]').val();
				var description = $('textarea[id=description]').val();
				var privacy = $('select[id=privacy]').val();
					e.preventDefault();
					$.post('http://localhost:8000/mychannels/addPlaylist/'+text1, {name:name,description:description,privacy:privacy},function(data){
						loader();
					});
				});
			}
		});
	}
	function like(){
		$('#like').click(function(e){
			var text1 = $('#text1').val();
				$.post('http://localhost:8000/mychannels/likeVideo/'+text1,function(data){
					likeLoader();
				});
			});
		}
	function unlike(){
		$('#unlike').click(function(e){
			var text1 = $('#text1').val();
				$.post('http://localhost:8000/mychannels/unlikeVideo/'+text1,function(data){
					likeLoader();
				});
			});
		}
	function loader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
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
				addToPlaylist();
				createPlaylist();
				deletelist();
				addToFavorites();
				removeToFavorites();
				addToWatchLater();
				removeToWatchLater();
				like();
				unlike();
		});
	}
	function deleteLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('body').append('<div id="playlist-div-remove"></div>');
			$('#playlist-div-remove').html('Sucessfully removed on your playlist');
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
				addToPlaylist();
				createPlaylist();
				deletelist();
				addToFavorites();
				removeToFavorites();
				addToWatchLater();	
				removeToWatchLater();
				like();
				unlike();
		});
	}

	function addLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('body').append('<div id="playlist-div-add"></div>');
			$('#playlist-div-add').html('Sucessfully added on your playlist');
			$('#playlist-div-add').css({
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
				if ($('#playlist-div-add').length > 0) {
					$('#playlist-div-add').remove();
				}
			}, 2000)
				addToPlaylist();
				createPlaylist();
				deletelist();
				addToFavorites();
				removeToFavorites();
				addToWatchLater();
				removeToWatchLater();	
				like();
				unlike();
		});
	}

	function addfavoriteLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('body').append('<div id="favoriteLoader"></div>');
			$('#favoriteLoader').html('Sucessfully added on your favorites');
			$('#favoriteLoader').css({
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
				if ($('#favoriteLoader').length > 0) {
					$('#favoriteLoader').remove();
				}
			}, 2000)
			addToPlaylist();
			createPlaylist();
			deletelist();
			addToFavorites();
			removeToFavorites();
			addToWatchLater();	
			removeToWatchLater();
			like();
			unlike();
		});
	}
	function removefavoriteLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('body').append('<div id="favoriteLoader"></div>');
			$('#favoriteLoader').html('Sucessfully removed on your favorites');
			$('#favoriteLoader').css({
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
				if ($('#favoriteLoader').length > 0) {
					$('#favoriteLoader').remove();
				}
			}, 2000)
			addToPlaylist();
			createPlaylist();
			deletelist();
			addToFavorites();
			removeToFavorites();
			addToWatchLater();	
			removeToWatchLater();
			like();
			unlike();
		});
	}	
	function addwatchLaterLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('body').append('<div id="watchLaterLoader"></div>');
			$('#watchLaterLoader').html('Sucessfully added in your watch later list');
			$('#watchLaterLoader').css({
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
				if ($('#watchLaterLoader').length > 0) {
					$('#watchLaterLoader').remove();
				}
			}, 2000)
			addToPlaylist();
			createPlaylist();
			deletelist();
			addToFavorites();
			removeToFavorites();
			addToWatchLater();
			removeToWatchLater();
			like();
			unlike();
		});	
	}
	function removewatchLaterLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('body').append('<div id="watchLaterLoader"></div>');
			$('#watchLaterLoader').html('Sucessfully removed in your watch later list');
			$('#watchLaterLoader').css({
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
				if ($('#watchLaterLoader').length > 0) {
					$('#watchLaterLoader').remove();
				}
			}, 2000)
			addToPlaylist();
			createPlaylist();
			deletelist();
			addToFavorites();
			removeToFavorites();
			addToWatchLater();
			removeToWatchLater();
			like();
			unlike();
		});	
	}
	function likeLoader(){
		$("#like-span").load(window.location.href+' #like-span',function(){
			$("#like-counter").load(window.location.href+' #like-counter',function(){
				addToPlaylist();
				createPlaylist();
				deletelist();
				addToFavorites();
				removeToFavorites();
				addToWatchLater();
				removeToWatchLater();
				like();
				unlike();
			});
		});
	}
	addToPlaylist();
	createPlaylist();
	deletelist();
	addToFavorites();
	removeToFavorites();
	addToWatchLater();
	removeToWatchLater();
	like();
	unlike();
});