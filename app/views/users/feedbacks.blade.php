@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container page">
		<br/>
		<div class="row">
			@include('elements/users/profileTop')
			<br/>
			<div class=" Div-channel-border">
				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('users.channel', 'Home', null)}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<li role="presentation" class="active">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  	</ul><!--tabNav-->
				</div>

				<div class="">
				@foreach($userComments as $userComment)
					{{$userComment->comment}}
					<br/>
					by: {{$userComment->channel_name}}
					<br/>
					 {{date('F d Y', strtotime($userComment->created_at))}}{{date('H:i a', strtotime($userComment->updated_at))}}
				@endforeach
				Type your comment here:
				<br/>
				 <label for="tags">Search: </label>
				<input id="tags1" name="tags1">
				<br/>
				<div id="responsecontainer"></div>
				</div>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
	</div><!--/.container page-->
</div>

	
@stop


@section('script')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/mention.js')}}
<!-- 	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script> -->

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