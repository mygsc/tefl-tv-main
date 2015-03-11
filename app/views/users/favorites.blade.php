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
			    	<li role="presentation">{{link_to_route('users.channel', 'Home', null)}}</li>
			    	<li role="presentation" class="active">{{link_to_route('users.myvideos', 'My Videos')}}</li>
			    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
			    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
			  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
			  		<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
			  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers')}}</li>
			  		
			  	</ul><!--tabNav-->
			</div>

			<div class="container">
				<div class="row">
					@foreach($showFavoriteVideos as $showFavoriteVideo)
					<div class="col-md-4">
						<video controls>
							<source src="/videos/{{$showFavoriteVideo->file_name}}.{{$showFavoriteVideo->extension}}" type="video/mp4">
							</video>
							<br/>
							{{$showFavoriteVideo->title}}<br/>
							{{$showFavoriteVideo->description}}<br/>
							{{$showFavoriteVideo->views}} Views, {{$showFavoriteVideo->likes}} Likes
							{{Form::open(array('route' => 'post.remove-favorites'))}}
							{{Form::submit('Remove from your Favorites', array('id' => 'favoriteVideo'))}}
							{{Form::close()}}
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div><!--!/.shadow div-channel-border-->
	</div><!--/.row-->
</div><!--/.container page-->
@stop