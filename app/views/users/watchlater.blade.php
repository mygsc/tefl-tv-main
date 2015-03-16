@extends('layouts.default')
<style type="text/css">
body {
  padding-top: 50px;
}
 
.thumbnail {
    position:relative;
    overflow:hidden;
}

.pad10 {
    margin-bottom: 10px;}
 
.caption {
    position:absolute;
    padding:15px 0;
    background:rgba(152, 217, 255, 0.50	);
 	width: 90%;
  	height: auto;
    display: none;
    text-align: center;
    color:#fff !important;
    z-index:2;
}


.caption-inner {
display: table;
width: 100%;
height: 100%;
}
.caption-content {
vertical-align: middle;
text-align: center;
}

</style>

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

				<div class="row">
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
						<button class="btn btn-unsub">Manage Your Watch Later Videos</button>
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
							<div class="watch">
								<input type="hidden" id="user_id" value="{{Auth::User()->id}}">
								<input type="hidden" id="video_id" value="{{$watchLater->id}}">
								<div class="caption">
									<div class="caption-inner">
										<p class="caption-content">
										<br/>
										<h1>Watched</h1>
										<br/>
										</p>
									</div>
								</div>
								{{Form::open()}}
								{{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','id' => 'favoriteVideo','class'=> 'btn btn-default', 'style' => 'position:absolute;right:20px;z-index:99;'))}}
								{{Form::close()}}
								<a href="{{route('homes.watch-video', $watchLater->id . '%' . $watchLater->title)}}" target="_blank">
									<video controls>
										<source src="/videos/{{$watchLater->file_name}}.{{$watchLater->extension}}" type="video/mp4">
									</video>
								</a>
								
							</div>


						<a href="{{route('homes.watch-video', $watchLater->id . '%' . $watchLater->title)}}" target="_blank">
						<div class="v-Info">
							{{$watchLater->title}}
						</div>
						</a>
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
@stop

@section('script')
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/media.player.js')}}
	{{HTML::script('js/homes/watch.js')}}
	{{HTML::script('js/overlaytext.js')}}
	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

	<script type="text/javascript">
		$('.grid').click(function() {
		    $('#videosContainer #list').removeClass('col-md-12').addClass('col-md-3');
		});
		$('.list').click(function() {
		    $('#videosContainer #list').removeClass('col-md-3').addClass('col-md-12');
		});
		$(document).ready( function( $ ) {
			$('#form-add-setting').on('submit', function() {
		        //.....
		        //show some spinner etc to indicate operation in progress
		        //.....
		        $.post(
		        	$(this).prop( 'action' ),{
		        		"_token": $( this ).find( 'input[name=_token]' ).val(),
		        		"setting_name": $( '#setting_name' ).val(),
		        		"setting_value": $( '#setting_value' ).val()
		        	},
		        	function( data ) {
		                //do something with data/response returned by server
		            },'json'
		        );
		        //.....
		        //do anything else you might want to do
		        //.....

		        //prevent the form from actually submitting in browser
		        return false;
		    } );
		} );
	</script>
@stop

