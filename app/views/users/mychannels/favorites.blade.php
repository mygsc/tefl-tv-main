@extends('layouts.default')

@section('content')
<div class="row">
	<div class="container pageH">
		<br/>
		<div class="row same-H">
			@include('elements/users/profileTop')
		
			<div class="Div-channel-border channel-content">
				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('users.channel', 'Home', null)}}</li>
				    	<li role="presentation">{{link_to_route('users.about', 'About')}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation" class="active">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<!--<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>-->
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
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
							<p class="text-center">You don't have favorites yet.</p>
						@else
						@foreach($findUsersVideos as $showFavoriteVideo)
							{{Form::open(array('route' => ['users.post.favorites', $showFavoriteVideo->id]))}}
						<div id="list" class="col-md-3 mg-b-10">
							
							<div class="inlineVid ">
								<span class="btn-sq" title="Remove from favorites?">{{ Form::button('<i class="fa fa-trash" title="Remove"></i>', array('type' => 'submit','id' => 'favoriteVideo','name' => 'Remove from favorites' ,'class'=> 'btn btn-default')) }}</span>
							
								<a href="{{route('homes.watch-video', $showFavoriteVideo->file_name)}}" target="_blank">
								@if(file_exists(public_path('/videos/'.$showFavoriteVideo->uploader.'-'.$showFavoriteVideo->uploaders_channel_name.'/'.$showFavoriteVideo->file_name.'/'.$showFavoriteVideo->file_name.'.jpg')) )
									<img src="/videos/{{$showFavoriteVideo->uploader.'-'.$showFavoriteVideo->uploaders_channel_name.'/'.$showFavoriteVideo->file_name.'/'.$showFavoriteVideo->file_name. '.jpg'}}" width="100%">
									@else
										{{HTML::image('img/thumbnails/video.png')}}
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
									by: <a href="{{route('view.users.channel', array($showFavoriteVideo->uploaders_channel_name))}}">{{$showFavoriteVideo->uploaders_channel_name}}</a><br/>
									<i class="fa fa-eye"></i> {{$showFavoriteVideo->views}} | <i class="fa fa-thumbs-up"></i> {{$showFavoriteVideo->likes}} | <i class="fa fa-calendar"></i> {{date("M d Y", strtotime($showFavoriteVideo->created_at))}}<br/>
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
		<br/>
	</div><!--/.container page-->
</div>
@stop