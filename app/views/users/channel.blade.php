@extends('layouts.default')

@section('content')


<div class="container page">
	<br/>
	<div class="row">
		<div style="border:5px solid #8b9dc1;" class="shadow">
			<div class="col-md-2 hidden-xs">
				<div class="row">
					<img src="/img/user/u4.png" class="pic-Dp">
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">

					<div class="" style="background-image:url(/img/user/cover.jpg); height:224px;">
						<div class="">
							<div class="overlay-cover">
								<span class="infoCounts">
									<label>12k Subscribers</label>
									<label>100 Videos</label> &nbsp;
									<label>13k Views</label>
								</span>
								

								<span class="pull-right" >

									<a href=""><img src="/img/icons/fb.png"></a>
									<a href=""><img src="/img/icons/tr.png"></a>
									<a href=""><img src="/img/icons/gp.png"></a>
									<a href=""><img src="/img/icons/yt.png"></a>
									<a href=""><img src="/img/icons/wl.png"></a>
 	
									<button class="btn btn-primary" style="margin-top:5px;">Subscribe</button>
								</span>	
							</div>
						</div>	
					</div>
				</div>
			</div>



			
			<div class="c-about" style="padding:10px 10px;margin-top:0;">
				<div class="labelThis">
					Christina Miller
				</div>
				<ul class="nav nav-tabs" role="tablist inline">
			    	<li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab"><small>About</small></a></li>
			    	<li role="presentation" class=""><a href="#learn" aria-controls="learn" role="tab" data-toggle="tab"><small>Learn More</small></a></li>
				</ul>
				<div class="tab-content inline">
				  	<div role="tabpanel" class="tab-pane active" id="about">
						<div class="" style="margin-top:20px;">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="learn">
						<div class="" style="margin-top:20px;">
						display info here
						</div>
					</div>
				</div>
			</div>
		</div>
		<br/>
		<div class="shadow Div-channel-border">

			<div role="tabpanel">
			  <!-- Nav tabs -->
			 	<ul class="nav nav-tabs" role="tablist">
			    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
			    	<li role="presentation"><a href="#Videos" aria-controls="Videos" role="tab" data-toggle="tab">Videos</a></li>
			    	<li role="presentation"><a href="#MyFavorites" aria-controls="MyFavorites" role="tab" data-toggle="tab">My Favorites</a></li>
			    	<li role="presentation"><a href="#WatchLater" aria-controls="WatchLater" role="tab" data-toggle="tab">Watch Later</a></li>
			  		<li role="presentation"><a href="#Playlists" aria-controls="Playlists" role="tab" data-toggle="tab">Playlists</a></li>
			  		<li role="presentation"><a href="#Feedbacks" aria-controls="Feedbacks" role="tab" data-toggle="tab">Feedbacks</a></li>
			  		<li role="presentation"><a href="#Subscribers" aria-controls="Subscribers" role="tab" data-toggle="tab">Subscribers</a></li>
			  		<li role="presentation"><a href="#Subscriptions" aria-controls="Subscriptions" role="tab" data-toggle="tab">Subscriptions</a></li>
			  	</ul><!--tabNav-->

			  	<!-- Tab panes -->
			    <div class="tab-content">
				  	<div role="tabpanel" class="tab-pane active" id="home">
						@include('elements/users/myChannelTabs/tab-Home')
				  	</div>
				    <div role="tabpanel" class="tab-pane" id="Videos">
				    	Videos
				    </div>
				    <div role="tabpanel" class="tab-pane" id="MyFavorites">
				    	My Favorites
				    </div>
				    <div role="tabpanel" class="tab-pane" id="WatchLater">
				    	Watch Later
				    </div>
				    <div role="tabpanel" class="tab-pane" id="Playlists">
				    	Playlists
				    </div>
				    <div role="tabpanel" class="tab-pane" id="Feedbacks">
				    	Feedbacks
				    </div>
				    <div role="tabpanel" class="tab-pane" id="Subscribers">
				    	Subscribers
				    </div>
				    <div role="tabpanel" class="tab-pane" id="Subscriptions">
				    	Subscriptions
				    </div>
			  </div><!--/.tab-content-->

			</div><!--/.tabpanel-->
				
		</div>
	</div><!--/.contentpadding-->
	<br/>
</div><!--/.container page-->

@stop




	
@stop
