@extends('layouts.default')
@section('some_script')
	{{HTML::style('css/vid.player.min.css')}}
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/video-player/media.player.min.js')}}
	{{HTML::script('js/homes/convert_specialString.js')}}

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

@section('content')
<div class="row">
	<br/>
	<div class="container White same-H">
		<div class="row ">
			@include('elements/users/profileTop')		
			<div class="channel-content">
				<div>
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs hidden-sm hidden-xs" role="tablist">
				    	<li role="presentation" class="active">{{link_to_route('users.channel', 'Home')}}</li>
				    	<li role="presentation">{{link_to_route('users.about', 'About')}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  	</ul><!--tabNav-->
				  	<nav class="navbar navbar-default visible-sm visible-xs">
					  <div class="container-fluid">
					    <div class="navbar-header">

					      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					      <h4 class="inline mg-t-20">Home</h4>	
					        <span class="fa fa-bars"></span>
					      </button>
			
					    </div>
					    <div class="collapse navbar-collapse" id="myNavbar">
					      <ul class="nav navbar-nav">
					    	<li>{{link_to_route('users.about', 'About')}}</li>
					    	<li>{{link_to_route('users.myvideos', 'My Videos')}}</li>
					    	<li>{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
					    	<li>{{link_to_route('users.watchlater', 'Watch Later')}}</li>
					  		<li>{{link_to_route('users.playlists', 'My Playlists')}}</li>
					  		<li>{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
					  		<li>{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
					      </ul>
					    </div>
					  </div>
					</nav>
				  	
				  	<!-- Tab panes -->
				    <div class="tab-content">
					  	<div role="tabpanel" class="tab-pane active" id="home">
							@include('elements/users/myChannelTabs/myHomeSections/myHome_recentUpload')
							@include('elements/users/myChannelTabs/myHomeSections/myHome_videos')
							@include('elements/users/myChannelTabs/myHomeSections/myHome_playlists')
							<div class="col-md-12">
								<div class="row">
									<div class="row-same-height">
										@include('elements/users/myChannelTabs/myHomeSections/myHome_subscribers')
										@include('elements/users/myChannelTabs/myHomeSections/myHome_subscriptions')
									</div>
									
								</div>
								
							</div>
					  	</div>				    
				  	</div><!--/.tab-content-->
				</div><!--/.tabpanel-->		
			</div><!--/.div-channel-border-->
		</div><!--/.contentpadding-->
	</div><!--/.container page-->
	<br/>
</div>


@stop
