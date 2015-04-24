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

		<div class="row same-H White">
			@include('elements/users/profileTop2')

				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation" class="active">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.videos2','Videos', $userChannel->channel_name)}}</li>
				    	<!-- <li role="presentation">{{link_to_route('view.users.favorites2', 'My Favorites', $userChannel->channel_name)}}</li> -->
				    	<!-- <li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li> -->
				  		<li role="presentation">{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>
				  	</ul><!--tabNav-->
				  	<br/>

				  	<!-- Tab panes -->
				    <div class="tab-content">
					  	<div role="tabpanel" class="tab-pane active" id="home">
							@include('elements/users/myChannelTabs/tab-HomeViewUsers')
					  	</div>					    

				  </div><!--/.tab-content-->

				</div><!--/.tabpanel-->		
			</div>
		</div><!--/.contentpadding-->
</div>
<br/>
@stop
