@extends('layouts.default')

@section('content')


<div class="container page">
	<br/>
	<div class="row">
		@include('elements/users/profileTop')

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
				  		@include('elements/users/myChannelTabs/tab-Video')
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

				    	@include('elements/users/myChannelTabs/tab-Subscribers')

				   	</div>

				    <div role="tabpanel" class="tab-pane" id="Subscriptions">
				    	@include('elements/users/myChannelTabs/tab-Subscription')
				    </div> 	
			  </div><!--/.tab-content-->

			</div><!--/.tabpanel-->
				
		</div><!--/.Div-channel-border-->
	</div><!--/.contentpadding-->
	<br/>
</div><!--/.container page-->

@stop
