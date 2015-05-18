<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	
	{{HTML::style('css/videoplayer.css')}}
	{{HTML::script('js/jquery.js')}}
	{{HTML::script('js/gscvideoplayer.js')}}
	<script type='text/javascript'>
	$(document).ready(function() {
		$('video').gscvideoplayer({
			'videoPlayerWidth' : 0.95,
			'videoClass' : 'video'	
		});
	});
</script>
</head>
<body>
	<h3>Custom Video Player</h3>
	<hr>
	<div class="wrapper">
	      <div class="video-title"><h2 style="color:#fff">Title: Graphic Studio Central</h2>  <img style="position:absolute;top:0;right:0;margin-right:10px;" width="50" height="50" src="/img/logos/teflTv.png"> </div>
		<video width="700" height="400" poster="/img/thumbnails/v5.png">
			<source src="/videos/movie.mp4" type="video/mp4">
			<source src="/videos/movie.ogg" type="video/ogg">
			<source src="/videos/movie.webm" type="video/webm">			
		</video>

				
				
		  
	</div>
		
		
		
</body>
</html>


