<!doctype html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/icon" href="/img/favIconTv.ico">
	<title>@yield('title', 'TEFL-TV')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	@yield('meta')

	<!-- CSS -->
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/myStyle.css') }}
	{{ HTML::style('css/vid.player.css') }}
	{{ HTML::style('font-awesome/css/font-awesome.min.css') }}

</head>
<body>
		@include('elements/admins/header-admin')
		@include('elements/flash_message')
		
		@yield('content')

</body>
<!-- scripts -->
{{HTML::script('js/jquery.js')}}
{{HTML::script('js/bootstrap.min.js')}}
{{HTML::script('js/media.player.js')}}
@yield('script')

</html>