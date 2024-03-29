<!doctype html>
<html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta charset="utf-8">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<link rel="shortcut icon" type="image/icon" href="/img/favIconTv.ico">
	<title>@yield('title', 'TEFL-TV')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<script src="https://apis.google.com/js/client:platform.js" async defer></script>
	@yield('meta')
	

	<!-- CSS -->

	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/myStyle.css') }}
	{{ HTML::style('css/signin.css') }}
	{{ HTML::style('css/animate.css') }}
	{{ HTML::style('css/dropdown.enhancement.min.css') }}
	{{ HTML::style('font-awesome/css/font-awesome.min.css') }}
	{{ HTML::style('css/m-nav/component.css') }}
	@yield('css')
</head>

<body style="background:#798CB4;">
	
	<div id="fb-root"></div>
	<div class="same-H">
	@include('elements/header')
	@include('elements/home/headerNav')
	@include('elements/mobileNav')
	</div>

		@include('elements.flash_message')
		@yield('content')


</body>

<!-- scripts -->
{{HTML::script('js/jquery.min.js')}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


{{HTML::script('js/dropdown.enhancement.js')}}
{{HTML::script('js/overlaytext.js')}}
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/upload_cover_photo.js')}}
{{HTML::script('js/main.js')}}
{{HTML::script('js/scroll-onpage.js')}}
@if(Auth::check())
{{HTML::script('js/user/realtime-notification.js')}}
@endif
<!--list and gri display for my channel-->
{{HTML::script('js/m-nav/classie.js')}}
{{HTML::script('js/m-nav/modernizr.custom.js')}}
<!--flash message fade-->
<script type="text/javascript">
    $('.fadeThis').delay(3000).fadeOut('slow');
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53463162-2', 'auto');
  ga('send', 'pageview');

</script>

<script type="text/javascript">
	var myVideo = document.getElementById('#cmn-video-demo3__video');
	if (typeof myVideo.loop == 'boolean') { // loop supported
	  myVideo.loop = true;
	} else { // loop property not supported
	  myVideo.addEventListener('ended', function () {
	    this.currentTime = 0;
	    this.play();
	  }, false);
	}
//...
myVideo.play();
</script>


<script>
	$(document).ready(function(){
		$(".search-btn").click(function(){
			$(".search-show").show().addClass('animated slideInLeft');
		});
	});
</script>
<script>
	$(document).ready(function(){
		$(".close-search").click(function(){
			$(".search-show").hide('slow');
		});
	});
</script>

@yield('script') 
@yield('some_script') <!--DONT REMOVE THIS YIELD BY: GRALD-->
@yield('modal')

</html>
