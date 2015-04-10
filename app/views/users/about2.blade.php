@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container pageH">

		<br/>
		<div class="row same-H">
			@include('elements/users/profileTop2')

			<div class="Div-channel-border White">

				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
				    	<li role="presentation" class="active">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.favorites2', 'My Favorites', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.watchLater2', 'Watch Later', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  	</ul><!--tabNav-->

				  	<!-- Tab panes -->
				    <div class="tab-content">
					  	<div role="tabpanel" class="tab-pane active" id="home">
							@include('elements/users/myChannelTabs/tab-AboutViewUsers')
					  	</div>				    
				  	</div><!--/.tab-content-->
				</div><!--/.tabpanel-->		
			</div><!--/.div-channel-border-->
			<br/>
		</div><!--/.contentpadding-->
	</div><!--/.container page-->
</div>

@stop

