@extends('layouts.default')

@section('content')
<div class="row">
	<br/>
	<div class="container">
		<div class="row">

			@include('elements/users/profileTop')
		
			<div class="channel-content">
				<div role="tabpanel">
				 	<ul class="nav nav-tabs visible-lg visible-md White same-H" role="tablist">
				    	<li role="presentation">{{link_to_route('users.channel', 'Home', null)}}</li>
				    	<li role="presentation">{{link_to_route('users.about', 'About Me')}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation" class="active">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  	</ul>
				</div>
			  	<nav class="navbar navbar-default visible-sm visible-xs">
				  <div class="container-fluid">
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				      <h4 class="inline mg-t-20">Favorites</h4>	
				        <span class="fa fa-bars"></span>
				      </button>
				    </div>
				    <div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav">
							<li>{{link_to_route('users.channel', 'Home')}}</li>
							<li>{{link_to_route('users.about', 'About')}}</li>
							<li>{{link_to_route('users.myvideos', 'My Videos')}}</li>
							<li>{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
							<li>{{link_to_route('users.watchlater', 'Watch Later')}}</li>
							<li>{{link_to_route('users.playlists', 'My Playlists')}}</li>
							<li>{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
						</ul>
					</div>
				  </div>
				</nav>


				<div class="top-div_t col-md-12 mg-t-20 pad20t">
					<div class="col-md-6 col-sm-8 col-xs-8">
						{{Form::open(array('route' => 'searchFavorites', 'method' => 'GET'))}}	
						<div class="input-group">
								{{ Form::text('search', null, array('id' => 'category', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
								<span class="input-group-btn">
									{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
								</span>
							{{Form::close()}}
						</div>
					</div>
					
			
					<div class="col-md-6 col-sm-4 col-xs-4 text-right">
						<div class="buttons">
							<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
							<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
						</div>
					</div>
				</div>
				<div class="col-md-12 White same-H channel-content">
					<div id="videosContainer" class='container'>
						<br/>
						@if($findUsersVideos->isEmpty())
							<p class="text-center mg-t-20">You don't have favorites yet.</p>
						@else
						@foreach($findUsersVideos as $showFavoriteVideo)
							{{Form::open(array('route' => ['users.post.favorites', $showFavoriteVideo->id]))}}
						<div id="list" class="col-md-3 col-sm-6 mg-b-10">
							
							<div class="inlineVid ">
								<span class="btn-sq" title="Remove from favorites?">{{ Form::button('<i class="fa fa-trash" title="Remove"></i>', array('type' => 'submit','id' => 'favoriteVideo','name' => 'Remove from favorites' ,'class'=> 'btn-ico btn-default')) }}</span>
								<div class="thumbnail-2">
								<a href="{{route('homes.watch-video', $showFavoriteVideo->file_name)}}" target="_blank">
								@if(file_exists(public_path('/videos/'.$showFavoriteVideo->uploader.'-'.$showFavoriteVideo->uploaders_channel_name.'/'.$showFavoriteVideo->file_name.'/'.$showFavoriteVideo->file_name.'.jpg')) )
									<img src="/videos/{{$showFavoriteVideo->uploader.'-'.$showFavoriteVideo->uploaders_channel_name.'/'.$showFavoriteVideo->file_name.'/'.$showFavoriteVideo->file_name. '.jpg'}}" width="100%" class="hvr-grow-rotate">
									@else
										{{HTML::image('img/thumbnails/video.png', 'alt', array('class' => 'hvr-grow-rotate ', 'style' => 'width:100%') )}}
									@endif
									<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
								</a>
								</div>
							</div>

							<div class="inlineInfo ">
								<a href="{{route('homes.watch-video', array($showFavoriteVideo->file_name))}}" target="_blank">	
									<div class="v-Info">
										
										<span class="visible-lg">{{ Str::limit($showFavoriteVideo['title'],65)}}</span>
										<span class="visible-md">{{ Str::limit($showFavoriteVideo['title'],45)}}</span>
										<span class="visible-xs visible-sm">{{ Str::limit($showFavoriteVideo['title'],30)}}</span>
									</div>
								</a>
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


@section('script')
	{{HTML::script('js/video-player/jquery.form.min.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/upload_cover_photo.js')}}
{{HTML::script('js/user/modalclearing.js')}}
@stop