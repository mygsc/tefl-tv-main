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
	{{ HTML::style('css/dropdown.enhancement.min.css') }}
	{{ HTML::style('font-awesome/css/font-awesome.min.css') }}
	{{-- HTML::style('css/vid.player.min.css') --}}
	@yield('css')
</head>
<body>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '834644693287300',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
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
