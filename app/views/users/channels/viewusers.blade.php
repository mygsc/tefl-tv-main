@extends('layouts.default')

@section('script')
	{{HTML::script('js/jquery.min.js')}}
	{{HTML::script('js/video-player/media.player.min.js')}}
	{{HTML::style('css/vid.player.min.css')}}
	{{HTML::script('js/subscribe.js')}}
@stop
@section('content')
<div class="row">
	<br/>
	<div class="container">
		<div class="row">
			@include('elements.users.profileTop2')

				<div class="">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs hidden-sm hidden-xs White same-H" role="tablist">
				    	<li role="presentation" class="active">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.videos2','Videos', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.playlists2', 'Playlists', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>
				  	</ul><!--tabNav-->
		
				  	<nav class="navbar navbar-default visible-sm visible-xs">
					  <div class="container-fluid">
					    <div class="navbar-header">

					      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					      <h4 class="inline mg-t-20">Home</h4>	
					        <span class="fa fa-bars"></span>
					      </button>
			
					    </div>
					    <div class="collapse navbar-collapse" id="myNavbar">
					      <ul class="nav navbar-nav">
					    	<li>{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
					    	<li>{{link_to_route('view.users.videos2','Videos', $userChannel->channel_name)}}</li>
					    	<li>{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
					  		<li>{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
					  		<li>{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>
					      </ul>
					    </div>
					  </div>
					</nav>

				  	<!-- Tab panes -->
				    <div class="tab-content">
					  	<div role="tabpanel" class="tab-pane active" id="home">
							@include('elements/users/viewUser/homeSections/viewUser_homeSec_recentUpload')
							@include('elements/users/viewUser/homeSections/viewUser_homeSec_videos')
							@include('elements/users/viewUser/homeSections/viewUser_homeSec_playlists')
							<div class="col-md-12">
								<div class="row">
									<div class="row-same-height mg-t-20">
										<div class="col-md-6 col-md-height col-top  White same-H">
											@include('elements/users/viewUser/homeSections/viewUser_homeSec_subscribers')
										</div>
										<div class="col-md-6 col-md-height col-top  White same-H">
											@include('elements/users/viewUser/homeSections/viewUser_homeSec_subscriptions')
										</div>
						  			</div>
						  		</div>
						  	</div>
					  	</div>					    
				  </div><!--/.tab-content-->

				</div><!--/.tabpanel-->		
			</div>
		</div><!--/.contentpadding-->
</div>
<br/>
@stop
