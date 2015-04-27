<!doctype html>
<html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
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
	{{ HTML::style('css/animate.css') }}
	{{ HTML::style('css/dropdown.enhancement.min.css') }}
	{{ HTML::style('font-awesome/css/font-awesome.min.css') }}
	{{-- HTML::style('css/vid.player.min.css') --}}
	@yield('css')
</head>
<body>

<script type="text/javascript">
    window.fbAsyncInit = function() {
        FB.init({appId: '834644693287300', status: true, cookie: true, xfbml: true});
    };
    (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
    }());
 </script>

		
		@include('elements/header')
		@include('elements/home/headerNav')
		<div class="container">
		@include('elements/flash_message')
		</div>
		<div id="content">
			@yield('content')
		</div>
		<div class="footer">
			@include('elements/footer')
		</div>

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
<script type="text/javascript">
	$('.cancelBtn').click(function() {
		$('.signDivH').addClass('hidden');
		$('.loginDivH').removeClass('hidden').addClass('animated zoomIn');

	});
	$('.signBtn').click(function() {
		$('.signDivH').removeClass('hidden').addClass('animated zoomIn');
		$('.loginDivH').addClass('hidden');
	});
</script>
<!-- Facebook Login -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '834644693287300',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

@yield('script') 
@yield('some_script') <!--DONT REMOVE THIS YIELD BY: GRALD-->
@yield('modal')

<!--<br />
	<center><font color="white">This page took {{(microtime(true) - LARAVEL_START)}} ms to render </span></center>
<br />-->

</html>
