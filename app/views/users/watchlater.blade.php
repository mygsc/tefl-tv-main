@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container page">
		<br/>
		<div class="row">
			@include('elements/users/profileTop')
			<br/>
			<div class="Div-channel-border">
				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('users.channel', 'Home', null)}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation" class="active">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
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
						@foreach($videosWatchLater as $watchLater)
						<div class="col-md-3">
							{{Form::open()}}
							{{ Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','id' => 'favoriteVideo','class'=> 'btn btn-default', 'style' => 'position:absolute;right:20px;')) }}

							{{Form::close()}}
							<video controls>
								<source src="/videos/{{$watchLater->file_name}}.{{$watchLater->extension}}" type="video/mp4">
							</video>
							<div class="v-Info">
								{{$watchLater->title}}
							</div>
							<div class="count">
								by: <a href="{{route('view.users.channel', array($watchLater->channel_name))}}">{{$watchLater->channel_name}}</a><br/>
								<i class="fa fa-eye"></i> {{$watchLater->views}} | <i class="fa fa-thumbs-up"></i> {{$watchLater->likes}} | <i class="fa fa-calendar"></i> {{$watchLater->created_at}}<br/>
								<br/>

							</div>
						</div>
						@endforeach	
					</div><!--videoContainer-->
				</div>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
	</div><!--/.container page-->
</div>
	@stop