@extends('layouts.default')

@section('title')
    {{Auth::User()->channel_name}} | TEFL Tv
@stop

@section('script')
{{--HTML::style('css/vid.player.min.css')--}}
{{HTML::script('js/video-player/jquery.form.min.js')}}
{{--HTML::script('js/video-player/media.player.min.js')--}}
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/upload_cover_photo.js')}}
{{HTML::script('js/user/modalclearing.js')}}
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/homes/convert_specialString.js')}}
{{--HTML::style('css/upload.min.css')--}}
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
<!-- <script src="http://deepliquid.com/projects/Jcrop/js/jquery.min.js"></script> -->
<!-- {{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/jCrop/jquery.Jcrop.js')}} -->
<!-- <script src="http://deepliquid.com/projects/Jcrop/js/jquery.Jcrop.js"></script> -->
<!-- <link rel="stylesheet" href="/css/jCrop/jquery.Jcrop.css" type="text/css" /> -->
<script type="text/javascript">
	// $(function(){
	// 	$('#preview').Jcrop({
	// 		aspectRatio: 1,
	// 		onSelect: updateCoords
	// 	});
	// });

	// function updateCoords(c){
	// 	$('#x').val(c.x);
	// 	$('#y').val(c.y);
	// 	$('#w').val(c.w);
	// 	$('#h').val(c.h);
	// };

	// function checkCoords(){
	// 	if (parseInt($('#w').val())) return true;
	// 	alert('Please select a crop region then press submit.');
	// 	return false;
	// };
</script>
@stop

@section('content')
<div class="row">
	<br/>
	<div class="container">
		<div class="row ">
			@include('elements.users.profileTop')	

			<div class="channel-content">
				<div>

					<!-- Nav tabs -->
					<ul class="nav nav-tabs hidden-sm hidden-xs White same-H" role="tablist">
						<li role="presentation" class="active">{{link_to_route('users.channel', 'Home')}}</li>
						<li role="presentation">{{link_to_route('users.about', 'About Me')}}</li>
						<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
						<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
						<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
						<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
						<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
						<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
					</ul><!--tabNav-->

					<!-- Tab panes -->
					<div class="tab-content">
						<div id="home">
							@include('elements/users/myChannelTabs/myHomeSections/myHome_recentUpload')
							@include('elements/users/myChannelTabs/myHomeSections/myHome_videos')
							@include('elements/users/myChannelTabs/myHomeSections/myHome_playlists')
							<div class="col-md-12">
								<div class="row">
									<div class="row-same-height mg-t-20">
										<div class="col-md-6 col-md-height col-top White same-H ">
											@include('elements/users/myChannelTabs/myHomeSections/myHome_subscribers')
										</div>
										<div class="col-md-6 col-md-height col-top White same-H ">
											@include('elements/users/myChannelTabs/myHomeSections/myHome_subscriptions')
										</div>
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
