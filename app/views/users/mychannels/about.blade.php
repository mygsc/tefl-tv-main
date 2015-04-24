@extends('layouts.default')

@section('content')
<div class="row">
	<div class="container pageH">
		<br/>
		<div class="row same-H">
			@include('elements/users/profileTop')

			<div class="Div-channel-border White channel-content">

				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('users.channel', 'Home')}}</li>
				    	<li role="presentation" class="active">{{link_to_route('users.about', 'About')}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<!--<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>-->
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  		
				  	</ul><!--tabNav-->

				  	<!-- Tab panes -->
				    <div class="tab-content">
					  	<div role="tabpanel" class="tab-pane active" id="home">
							@include('elements/users/myChannelTabs/tab-About')
					  	</div>				    
				  	</div><!--/.tab-content-->
				</div><!--/.tabpanel-->		
			</div><!--/.div-channel-border-->
			<br/>
		</div><!--/.contentpadding-->
	</div><!--/.container page-->
</div>

@stop
