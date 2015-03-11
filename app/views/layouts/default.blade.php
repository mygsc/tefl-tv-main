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
	{{ HTML::style('css/videoGallery.css') }}
	{{ HTML::style('css/dropdown.enhancement.css') }}
	{{ HTML::style('font-awesome/css/font-awesome.min.css') }}
	{{ HTML::style('css/vid.player.css') }}
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
{{HTML::script('js/jquery.js')}}
{{HTML::script('js/user/upload.js')}}
{{HTML::script('js/bootstrap.min.js')}}
{{HTML::script('js/dropdown.enhancement.js')}}

<<<<<<< HEAD

=======
>>>>>>> 2b917822066ebb05b1fd100bb1ff8ae4f140c593

@yield('script')

</html>