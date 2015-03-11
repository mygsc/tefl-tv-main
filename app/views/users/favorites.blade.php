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
		

			<button id="sort" class="btn btn-info">Sort by Most Likes</button>
			<button id="sort" class="btn btn-info">Sort by Recent</button>

			<div class="row">
				<br/>
				<div class="col-md-6 pull-right">
					<div class="input-group">
						{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
						<span class="input-group-btn">
							{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
						</span>
					</div>
				</div>
				<br/>
				<div id="videosContainer" class='container'>
					<div class="buttons">
						<button id="videoButton" class="grid">Grid View</button>
						<button id="videoButton" class="list">List View</button>
					</div>
					@foreach($usersVideos as $usersVideo)
					<div id='list' class="col-md-3">
						&nbsp;
						<video height="auto" width="100%" class="h-video" controls>
							<source src="/videos/{{$usersVideo->file_name}}.{{$usersVideo->extension}}" type="video/mp4" />		 
							</video>
							<div class="v-Info">
								{{$usersVideo->title}}
							</div>
							<div class="count">
								{{$usersVideo->views}} Views, {{$usersVideo->likes}} Likes
							</div>
						</div>
						@endforeach	
					</div>
				</div>
			</div>
		</div>
	</div>
@stop