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
	{{ HTML::style('css/bootstrap.min.css') }}

</head>
<body>
	<div class="container">	
		@include('elements.header')
		@include('elements.flash_message')
		
		@yield('content')

		@include('elements.footer')
	</div>
</body>
<!-- scripts -->
{{HTML::script('js/jquery.js')}}
{{HTML::script('js/bootstrap.min.js')}}
@yield('script')

</html>