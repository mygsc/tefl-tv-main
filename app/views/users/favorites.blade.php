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
			    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
			    	<li role="presentation" class="active">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
			    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
			  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
			  		<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
			  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
			  	</ul><!--tabNav-->
			</div>

			<div class="">
				<br/>
				<div class="col-md-6">
					<div class="input-group">
						{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
						<span class="input-group-btn">
							{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
						</span>
					</div>
				</div>
				<div class="col-md-5">
					<!--<label>Sort by:</label>
					<button id="sort" class="btn btn-default btn-sm">Likes</button>
					<button id="sort" class="btn btn-default btn-sm">Recent</button>-->
					<select class="form-control" style="width:auto!important;">
						<option value="" selected disabled>Sort By</option>
						<option>Likes</option>
						<option>Recent</option>
					</select>
					&nbsp;&nbsp;
					<button class="btn btn-unsub">Manage Your Favorites</button>
				</div>
		
				<div class="col-md-1 text-right">
					<div class="buttons">
						<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
						<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
					</div>
				</div>

				<br/><br/><hr class="" />

				<div id="videosContainer" class='container'>
					<br/>
					@foreach($showFavoriteVideos as $showFavoriteVideo)
					<div class="col-md-3">
						{{Form::open(array('route' => ['users.post.favorites', $showFavoriteVideo->id]))}}
						{{ Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','id' => 'favoriteVideo','name' => 'Remove from favorites' ,'class'=> 'btn btn-default', 'style' => 'position:absolute;right:20px;')) }}

						<a href="{{route('homes.watch-video', $showFavoriteVideo->id. '%' .$showFavoriteVideo->title)}}">
						<video controls>
							<source src="/videos/{{$showFavoriteVideo->file_name}}.{{$showFavoriteVideo->extension}}" type="video/mp4">
						</video>
						</a>
						<div class="v-Info">
							{{$showFavoriteVideo->title}}
						</div>
						<div class="count">
							by: <a href="{{route('view.users.channel', array($showFavoriteVideo->channel_name))}}">{{$showFavoriteVideo->channel_name}}</a><br/>
							<i class="fa fa-eye"></i> {{$showFavoriteVideo->views}} | <i class="fa fa-thumbs-up"></i> {{$showFavoriteVideo->likes}} | <i class="fa fa-calendar"></i> {{$showFavoriteVideo->created_at}}<br/>
								{{Form::close()}}
							<br/>
						</div>
					</div>
					@endforeach	
				</div><!--videoContainer-->
			</div>
		</div><!--!/.shadow div-channel-border-->
	</div><!--/.row-->
</div><!--/.container page-->
@stop