<!doctype html>
<html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/icon" href="/img/favIconTv.ico">
	<title>@yield('title', 'TEFL-TV')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<script src="https://apis.google.com/js/client:platform.js" async defer></script>
	@yield('meta')
	

	<!-- CSS -->
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/myStyle.css') }}
	{{ HTML::style('css/animate.css') }}
	{{ HTML::style('css/dropdown.enhancement.min.css') }}
	{{ HTML::style('font-awesome/css/font-awesome.min.css') }}
	@yield('css')
</head>

<body>
	<div id="fb-root"></div>
	{{HTML::script('js/facebook.js')}}
	{{HTML::script('js/google.js')}}

	@include('elements/header')
	@include('elements/home/headerNav')
	<div class="container">
		@include('elements.flash_message')
		@yield('content')
	</div>
	@include('elements/footer')

</body>

<!-- scripts -->
{{HTML::script('js/jquery.min.js')}}

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
{{HTML::script('js/dropdown.enhancement.js')}}
{{HTML::script('js/overlaytext.js')}}
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/upload_cover_photo.js')}}
{{HTML::script('js/main.js')}}
@if(Auth::check())
{{HTML::script('js/user/realtime-notification.js')}}
@endif
<!--list and gri display for my channel-->
<script type="text/javascript">
	setCorrectTimezone();

	$('.grid').click(function() {
		$('#videosContainer #list').removeClass('col-md-12').addClass('col-md-3 col-sm-4 col-xs-6');
		$('.inlineVid').removeClass('col-md-4 col-sm-5 col-xs-6');
		$('.inlineInfo').removeClass('col-md-8 col-sm-7 col-xs-6');
		$('.desc').addClass('hide');
	});
	$('.list').click(function() {
		$('#videosContainer #list').removeClass('col-md-3 col-sm-4 col-xs-6').addClass('col-md-12');
		$('.inlineVid').addClass('col-md-4 col-sm-5 col-xs-6');
		$('.inlineInfo').addClass('col-md-8 col-sm-7 col-xs-6');
		$('.desc').removeClass('hide');
	});
</script>
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



@yield('script') 
@yield('some_script') <!--DONT REMOVE THIS YIELD BY: GRALD-->
@yield('modal')

</html>
