<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/icon" href="/img/favIconTv.ico">
	<title>@yield('title', 'TEFL-TV')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	@yield('meta')

	<!-- CSS -->
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/myStyle.css') }}
	{{ HTML::style('css/dropdown.enhancement.min.css') }}
	{{ HTML::style('font-awesome/css/font-awesome.min.css') }}
	{{-- HTML::style('css/vid.player.min.css') --}}
	@yield('css')
</head>
<body>
		
		@include('elements/header')
		@include('elements/home/headerNav')
		@include('elements/flash_message')
		
		@yield('content')

		@include('elements/footer')
</body>

<!-- scripts -->
{{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/bootstrap.min.js')}}
{{HTML::script('js/dropdown.enhancement.js')}}
{{HTML::script('js/overlaytext.js')}}
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/upload_cover_photo.js')}}
@if(Auth::check())
{{HTML::script('js/user/realtime-notification.js')}}
@endif
@yield('script') 
@yield('some_script') <!--DONT REMOVE THIS YIELD BY: GRALD-->


<!--list and gri display for my channel-->
<script type="text/javascript">
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

@yield('modal')

<br/>
<center>This page took {{ (microtime(true) - LARAVEL_START) }} seconds to render</center>
<br/>
</html>
