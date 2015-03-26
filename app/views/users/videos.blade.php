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
				    	<li role="presentation">{{link_to_route('users.channel', 'Home')}}</li>
				    	<li role="presentation" class="active">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<!--<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>-->
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  		
				  	</ul><!--tabNav-->
				</div>

				<div class="">
					<br/>
					<div class="col-md-5 col-sm-6">
						<div class="input-group" style="margin-bottom:10px;">
							{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
							<span class="input-group-btn">
								{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
							</span>
						</div>
					</div>
					<div class="col-md-7 col-sm-6">
						<!--<label>Sort by:</label>
						<button id="sort" class="btn btn-default btn-sm">Likes</button>
						<button id="sort" class="btn btn-default btn-sm">Recent</button>-->
						<!--<select class="form-control" style="width:auto!important;">
							<option value="" selected disabled>Sort By</option>
							<option>Likes</option>
							<option>Recent</option>
						</select>
						&nbsp;&nbsp;
						<button class="btn btn-unsub">Manage Videos</button>-->

						<div class="buttons pull-right inline">
							<button id="videoButton" class="grid btn btn-default btn-sm" title="Grid"><i class="fa fa-th"></i></button>
							<button id="videoButton" class="list btn btn-default btn-sm" title="List"><i class="fa fa-th-list"></i></button>
						</div>
						<input type="hidden" id="uploaded" value="{{Session::pull('success')}}"/>
					</div>
					
					<br/><br/><hr class="" />

				<div id="videosContainer" class='container'>
				@if($usersVideos->isEmpty())
					No Videos yet.
				@else
					@foreach($usersVideos as $usersVideo)
					<div id='list' class="col-md-3">
						<div class="inlineVid">
							
							<span class="btn-sq">
								<span class="dropdown">
                                   	<span class="dropdown-menu drop pull-right White snBg text-left" style="padding:5px 5px;text-align:center;width:auto;">
                                   		<li>gge</li>
                                   		<li>gfrhgte</li>
                                    </span>
                                </span>

								<a href="edit/{{Crypt::encrypt($usersVideo->id)}}" >
								<span title="Update Video"><button class="btn-ico btn-default" ><i class="fa fa-pencil" ></i></button></span></a>
								{{Form::open(array('style'=>'float:right','route' => array('video.post.delete', Crypt::encrypt($usersVideo->id))))}}&nbsp;
								<span title="Remove Video">{{Form::button('<i class="fa fa-trash" ></i>', array('type' => 'submit','id' => 'favoriteVideo','class'=> 'btn-ico btn-default'))}}</span>
								{{Form::close()}}
							</span>
							
							
							<a href="{{route('homes.watch-video', array($usersVideo->file_name))}}" target="_blank">
							
								
								
									<video poster="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.jpg'}}"  width="100%" >
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.mp4'}}" type="video/mp4" />
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.webm'}}" type="video/webm" />
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$usersVideo->file_name.'/'.$usersVideo->file_name. '.ogg'}}" type="video/ogg" />

									</video>
								
							</a>
						</div>

						<div class="inlineInfo ">
							<div class="v-Info">
								{{$usersVideo->title}}
							</div>
							<div class="text-justify desc hide">
								<p>{{$usersVideo->description}}</p>
								<br/>
							</div>
							<div class="count">
								<i class="fa fa-eye"></i> {{$usersVideo->views}} | <i class="fa fa-thumbs-up"></i> {{$usersVideo->likes}} | <i class="fa fa-calendar"></i> {{$usersVideo->created_at}}
							</div>
						</div>
					</div>
					@endforeach	

				</div>
					@endif
					</div>

				</div>
			</div>
		</div>
	</div>
@stop

@section('script')
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/media.player.js')}}
	{{HTML::script('js/homes/convert_specialString.js')}}

	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

	<script type="text/javascript">
		$(document).ready( function( $ ) {
			var success = $('#uploaded').val();
			if(success == 1){
				$('<div id="success" style="width:400px;height:40px;display:block;color:green">New video has been uploaded successfully.</div>').appendTo('body');
					$('#success').fadeOut(20000);
			}
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


