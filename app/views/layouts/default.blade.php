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
	<div id="fb-root"></div>

<script>
	window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '834644693287300', // App ID
	      channelUrl : 'https://localhost:8000/mychannels/edit-channe/connect.facebook.net/en_US/all.js"', // Channel File
	      status     : true, // check login status
	      cookie     : true, // enable cookies to allow the server to access the session
	      xfbml      : true  // parse XFBML
	    });

	    FB.Event.subscribe('auth.authResponseChange', function(response) 
			{
		 	 if (response.status === 'connected') 
		  	{
		  		document.getElementById("message").innerHTML +=  "<br>Connected to Facebook";
		  	}else if (response.status === 'not_authorized') {
		    	document.getElementById("message").innerHTML +=  "<br>Failed to Connect";
	    }else{
		    	document.getElementById("message").innerHTML +=  "<br>Logged Out";
		    }
			});	
	};

	function Login() {
		FB.login(function(response) {
			if(response.authResponse){
				FB.api('/me', function(response) {
					console.log(response);
					 var str="<b>Name</b> : "+response.name+"<br>";
	  	  str +="<b>Link: </b>"+response.link+"<br>";
	  	  str +="<b>Username:</b> "+response.username+"<br>";
	  	  str +="<b>id: </b>"+response.id+"<br>";
	  	  str +="<b>Email:</b> "+response.email+"<br>";
	  	  str +="<input type='button' value='Get Photo' onclick='getPhoto();'/>";
	  	  str +="<input type='button' value='Logout' onclick='Logout();'/>";
	  	  document.getElementById("status").innerHTML=str;
				});
			}else{
				console.log('User cancelled login or did not fully authorize.');
   		}},{scope: 'email,user_photos,user_videos'});
			}

	function Logout()
	{
		FB.logout(function(){
			window.location.reload();
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
<div id="fb-root"></div>
        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({appId: '834644693287300', status: true, cookie: true, xfbml: true});
 
                /* All the events registered */
                FB.Event.subscribe('auth.login', function(response) {
                    // do something with response
                    login();
                });
                FB.Event.subscribe('auth.logout', function(response) {
                    // do something with response
                    logout();
                });
 
                FB.getLoginStatus(function(response) {
                    if (response.session) {
                        // logged in and connected user, someone you know
                        login();
                    }
                });
            };
            (function() {
                var e = document.createElement('script');
                e.type = 'text/javascript';
                e.src = document.location.protocol +
                    '//connect.facebook.net/en_US/all.js';
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
            }());
 
            function login(){
                FB.api('/me', function(response) {
                    document.getElementById('login').style.display = "block";
                    document.getElementById('login').innerHTML = response.name + " succsessfully logged in!";
                });
            }
            function logout(){
                document.getElementById('login').style.display = "none";
            }
 
            //stream publish method
            function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){
                FB.ui(
                {
                    method: 'stream.publish',
                    message: '',
                    attachment: {
                        name: name,
                        caption: '',
                        description: (description),
                        href: hrefLink
                    },
                    action_links: [
                        { text: hrefTitle, href: hrefLink }
                    ],
                    user_prompt_message: userPrompt
                },
                function(response) {
 
                });
 
            }
            function showStream(){
                FB.api('/me', function(response) {
                    //console.log(response.id);
                    streamPublish(response.name, 'Thinkdiff.net contains geeky stuff', 'hrefTitle', 'http://thinkdiff.net', "Share thinkdiff.net");
                });
            }
 
            function share(){
                var share = {
                    method: 'stream.share',
                    u: 'http://thinkdiff.net/'
                };
 
                FB.ui(share, function(response) { console.log(response); });
            }
 
            function graphStreamPublish(){
                var body = 'Reading New Graph api & Javascript Base FBConnect Tutorial';
                FB.api('/me/feed', 'post', { message: body }, function(response) {
                    if (!response || response.error) {
                        alert('Error occured');
                    } else {
                        alert('Post ID: ' + response.id);
                    }
                });
            }
 
            function fqlQuery(){
                FB.api('/me', function(response) {
                     var query = FB.Data.query('select name, hometown_location, sex, pic_square from user where uid={0}', response.id);
                     query.wait(function(rows) {
 
                       document.getElementById('name').innerHTML =
                         'Your name: ' + rows[0].name + "<br />" +
                         '<img src="' + rows[0].pic_square + '" alt="" />' + "<br />";
                     });
                });
            }
 
            function setStatus(){
                status1 = document.getElementById('status').value;
                FB.api(
                  {
                    method: 'status.set',
                    status: status1
                  },
                  function(response) {
                    if (response == 0){
                        alert('Your facebook status not updated. Give Status Update Permission.');
                    }
                    else{
                        alert('Your facebook status updated');
                    }
                  }
                );
            }
        </script>

@yield('script') 
@yield('some_script') <!--DONT REMOVE THIS YIELD BY: GRALD-->
@yield('modal')

<br />
	<center><font color="white">This page took {{(microtime(true) - LARAVEL_START)}} ms to render </span></center>
<br />

</html>
