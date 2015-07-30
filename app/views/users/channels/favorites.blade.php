@extends('layouts.default')

@section('title')
    {{$userChannel->channel_name}} | TEFL Tv
@stop

@section('content')
<div class="row">
	<div class="container pageH White">
		<br/>
		<div class="row">
			@include('elements/users/profileTop2')
		
			<div class="Div-channel-border channel-content">
				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
				    	<!-- <li role="presentation" class="active">{{link_to_route('view.users.favorites2', 'Favorites', $userChannel->channel_name)}}</li> -->
				    	<!-- <li role="presentation">{{link_to_route('view.users.watchLater2', 'Watch Later', $userChannel->channel_name)}}</li> -->
				  		<li role="presentation">{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>
				  	</ul><!--tabNav-->
				</div>

				<div class="">
					<br/>
					<!--<div class="col-md-6">
						<div class="input-group">
							{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
							<span class="input-group-btn">
								{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
							</span>
						</div>
					</div>-->
					<div class="col-md-5">
						<!--<label>Sort by:</label>
						<button id="sort" class="btn btn-default btn-sm">Likes</button>
						<button id="sort" class="btn btn-default btn-sm">Recent</button>-->
						<!--<select class="form-control" style="width:auto!important;">
							<option value="" selected disabled>Sort By</option>
							<option>Likes</option>
							<option>Recent</option>
						</select>
						&nbsp;&nbsp;
						<button class="btn btn-unsub">Manage Your Favorites</button>-->
					</div>
			
					<div class="col-md-12 text-right">
						<div class="buttons">
							<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
							<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
						</div>
					</div>

					<br/><br/><hr class="" />

					<div id="videosContainer" class='container'>
						<br/>
						@if(empty($findUsersVideos))
							No Favorites yet.
						@else
						@foreach($findUsersVideos as $showFavoriteVideo)
							{{Form::open(array('route' => ['users.post.favorites', $showFavoriteVideo->id]))}}
						<div id="list" class="col-md-3">
							
							<span class="btn-sq" title="Remove from favorites?">{{ Form::button('<i class="fa fa-trash" title="Remove"></i>', array('type' => 'submit','id' => 'favoriteVideo','name' => 'Remove from favorites' ,'class'=> 'btn btn-default')) }}</span>
							<div class="inlineVid ">
								<a href="{{route('homes.watch-video', $showFavoriteVideo->file_name)}}" target="_blank">
								@if(file_exists(public_path('/videos/'.$userChannel->id.'-'.$userChannel->channel_name.'/'.$showFavoriteVideo->file_name.'/'.$showFavoriteVideo->file_name.'.jpg')) )
									<img src="/videos/{{$userChannel->id.'-'.$userChannel->channel_name.'/'.$showFavoriteVideo->file_name.'/'.$showFavoriteVideo->file_name. '.jpg'}}" width="100%">
									@else
										{{HTML::image('img/thumbnails/video-sm.jpg')}}
									@endif
								</a>
							</div>

							<div class="inlineInfo ">
								<div class="v-Info">
									{{$showFavoriteVideo->title}}
								</div>
								<div class="text-justify desc hide">
									<p>{{$showFavoriteVideo->description}}</p>
									<br/>
								</div>
								<div class="count">
									by: <a href="{{route('view.users.channel', array($showFavoriteVideo->channel_name))}}">{{$showFavoriteVideo->channel_name}}</a><br/>
										{{$showFavoriteVideo->views}} Views | {{$showFavoriteVideo->numberOfLikes}} Likes | {{date("M d Y", strtotime($showFavoriteVideo->created_at))}}<br/>
										{{Form::close()}}
									<br/>
								</div>
							</div>
						</div>
						@endforeach
						@endif
					</div><!--videoContainer-->
				</div>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
	</div><!--/.container page-->
</div>
@stop