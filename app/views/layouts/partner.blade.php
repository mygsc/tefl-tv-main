<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <!-- title and meta -->
  	<meta charset="utf-8">
  	<meta content="width=device-width,initial-scale=1.0" name="viewport">
  	<title>@yield('title')</title>
	@yield('meta')
	
	<!-- CSS -->
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/partner.css') }}
	{{ HTML::style('css/partnership.css') }}
	{{ HTML::style('css/myStyle.css') }}
	{{ HTML::style('css/animate.css') }}
	{{ HTML::style('css/dropdown.enhancement.min.css') }}
	{{ HTML::style('font-awesome/css/font-awesome.min.css') }}
	@yield('css')
</head>

<body>

	<div class="same-H head-up">
		@include('elements/partners/header')
		@include('elements/partners/partners_nav')
	</div>

		@include('elements/flash_message')
		@yield('content')
		
		@include('elements/footer')


</body>

<!-- scripts -->
{{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/ripple/jquery.ripple-js.js')}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
{{HTML::script('js/dropdown.enhancement.js')}}
{{HTML::script('js/main.js')}}
{{HTML::script('js/wow.js')}}
{{HTML::script('js/jquery.sticky-kit.min.js')}}
{{HTML::script('js/sticky.js')}}

@if(Auth::check())
{{HTML::script('js/user/realtime-notification.js')}}
@endif
<!--list and gri display for my channel-->

<!--flash message fade-->
<script type="text/javascript">
    $('.fadeThis').delay(3000).fadeOut('slow');
</script>


<script>
	wow = new WOW(
	{
			      boxClass:     'wow',      // default
			      animateClass: 'animated', // default
			      offset:       0,          // default
			      mobile:       true,       // default
			      live:         true        // default
			  }
			  )
	wow.init();
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

<script type="text/javascript">
	var contentHeight = jQuery('.content').height();
	var sidebarHeight = jQuery('.sidebar').height();
	if (contentHeight > sidebarHeight) {
	jQuery('.sidebar').height(contentHeight);
	jQuery(".sidebar .enews-widget").stick_in_parent();
	}
</script>

@yield('script') 
@yield('some_script') <!--DONT REMOVE THIS YIELD BY: GRALD-->
@yield('modal')

</html>
