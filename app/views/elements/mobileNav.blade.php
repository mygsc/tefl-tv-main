
<div class="visible-sm visible-xs">
	<div class="fixed-header m-head">
		<div class="brandingHeader">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<a href="/"><img src="/img/logo-sm.png" class="text-left logo-sm" title="redirect to homepage"></a>
						<a href="{{ route('get.upload') }}" class="pull-right sm-ico-up" title="Upload"><img src="/img/icons/upload-sm.png"></a>
					</div><!--/.row-->
				</div><!--/.container mobile-->
			</div>
		</div>
		<div class="search-show animated">
			{{Form::open(array('route' => 'homes.searchresult','method' => 'GET','class' => 'inline'))}}
			{{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'm-search','height' => '25px')) }}
			{{Form::close()}}
			<i class="fa fa-search pull-left search-ico"></i>
			<button class="close-search pull-right "><i class="fa fa-close "></i></button>

		</div>
		<div class="categoryNav">
			<div class="row">
				<button class="search-btn "><i class="fa fa-search" ></i> Search</button>

				@if(Auth::check())
				<ul class="ctgryNav pull-right" style="position:fixed;right:40px;">
					<li>
						<b> {{Auth::User()->channel_name}}</b>
						<a href="{{route('users.notifications')}}"><span class="badge btn-danger" id="notification-counter"></span></a>
					</li>
				</ul>

				@else
				<ul class="ctgryNav pull-right" style="position:fixed;right:20px;">
					<li>
						<span >{{ link_to_route('homes.signin', 'Sign-in / Sign-up', null, array('class' => '')) }}
						</span>
					</li>
				</ul>

				@endif

			</div>
		</div>
	</div>



	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left same-H" id="cbp-spmenu-s1" >
		<span class="">
			<img src="/img/logo-sm.png">
			<button id="showLeft" class="btn-nav"><i class="fa fa-bars" id="nav-hide"></i></button>
		</span> 
		{{ link_to_route('homes.popular', 'Popular', null, array('class' => '')) }}
		{{ link_to_route('homes.latest', 'Latest', null, array('class' => '')) }}
		{{ link_to_route('homes.playlist', 'Playlists', null, array('class' => '')) }}
		{{ link_to_route('homes.top-channels', 'Channels', null, array('class' => '')) }}
		<h3>Legal Terms</h3>
		{{ link_to_route('homes.privacy', 'Privacy', null) }}
		{{ link_to_route('homes.copyright', 'Copyright', null) }}
		{{ link_to_route('homes.termsandconditions', 'Terms and Condition', null) }}
		<h3>Programs</h3>
		{{link_to_route('partners.index','Partners')}}
		{{link_to_route('publishers.index','Publishers')}}
	</nav>

	@if(Auth::check())
	<nav class="cbp-spmenu cbp-spmenu-2 cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
		<span class="">
			<button id="showRight" class="btn-nav-2"><i class="fa fa-bars"></i> 
			</button>
			<b>{{Auth::User()->channel_name}}</b>
			{{link_to_route('users.signout', 'Sign-out', null, array('class' => 'pull-right mg-t--10'))}}
		</span> 
		{{link_to_route('users.channel', 'Home')}}
		{{link_to_route('users.about', 'About')}}
		{{link_to_route('users.myvideos', 'My Videos')}}
		{{link_to_route('users.myfavorites', 'My Favorites')}}
		{{link_to_route('users.watchlater', 'Watch Later')}}
		{{link_to_route('users.playlists', 'My Playlists')}}
		{{link_to_route('users.feedbacks', 'Feedbacks')}}
		{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}
		<h3>Account Settings</h3>

		{{link_to_route('users.edit.channel', 'Update Profile')}}
		{{ link_to_route('users.change-password', 'Change Password', null) }}
		{{ link_to_route('users.change-email', 'Change Email', null) }}
		@if(Auth::User()->role == '3' || Auth::User()->role == '4' || Auth::User()->role == '5')
		{{ link_to_route('users.earnings.settings', 'Earnings Settings', null) }}
		@endif
		{{ link_to_route('users.deactivate', 'Deactivate TEFL TV account', null) }}

	</nav>
	@endif
</div>

<script>
	var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
	menuRight = document.getElementById( 'cbp-spmenu-s2' ),
	showLeft = document.getElementById( 'showLeft' ),
	showRight = document.getElementById( 'showRight' ),

	body = document.body;

	showLeft.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( menuLeft, 'cbp-spmenu-open' );
		disableOther( 'showLeft' );
	};
	showRight.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( menuRight, 'cbp-spmenu-open' );
		disableOther( 'showRight' );
	};


	function disableOther( button ) {
		if( button !== 'showLeft' ) {
			classie.toggle( showLeft, 'disabled' );
		}
		if( button !== 'showRight' ) {
			classie.toggle( showRight, 'disabled' );
		}

	}
</script>



