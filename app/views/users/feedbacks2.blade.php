@extends('layouts.default')

@section('content')
<div class="row White">
	<div class="container page">
		<br/>
		<div class="row">
			@include('elements/users/profileTop2')
			<br/>
			<div class=" Div-channel-border">
				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation">{{link_to_route('view.users.channel', 'Home', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.about2', 'About', $userChannel->channel_name)}}</li>
				    	<li role="presentation">{{link_to_route('view.users.videos2', 'Videos', $userChannel->channel_name)}}</li>
				    	<!-- <li role="presentation">{{link_to_route('view.users.favorites2', 'My Favorites', $userChannel->channel_name)}}</li> -->
				    	<!-- <li role="presentation">{{link_to_route('view.users.watchLater2', 'Watch Later', $userChannel->channel_name)}}</li> -->
				  		<li role="presentation">{{link_to_route('view.users.playlists2', 'My Playlists', $userChannel->channel_name)}}</li>
				  		<li role="presentation" class="active">{{link_to_route('view.users.feedbacks2', 'Feedbacks', $userChannel->channel_name)}}</li>
				  		<li role="presentation">{{link_to_route('view.users.subscribers2', 'Subscribers/Subscriptions', $userChannel->channel_name)}}</li>
				  	</ul><!--tabNav-->
				</div>

				<div class="feedbackSection">
					<h3>Comments</h3>
				@if($userFeedbacks->isEmpty())
					No feedbacks yet..
					<br/>
					{{Form::open(array('route' => ['post.view.users.comments', $userChannel->channel_name], 'id' => 'postFeedback'))}}
							@if(Auth::check())
							{{Form::hidden('user_id', Auth::User()->id, array('id' => 'user_id'))}}
							{{Form::hidden('channel_id', $userChannel->id, array('id' => 'channel_id'))}}
							@endif
							{{Form::textarea('feedback', null, array('placeholder' => 'Leave a feedback..', 'id' => 'textAreaFeedback'))}}
							{{Form::submit('Leave a feedback', array('id' => 'feedback'))}}
						{{Form::close()}}
				@else
					<div id="feedbacksContainer">
					@foreach($userFeedbacks as $feedbacks)
						<br/>
						{{$feedbacks->feedback}}
						<br/>
						{{$feedbacks->user_id}}
						<br/>
						{{$feedbacks->created_at}}
						<br/>
						<button id="userReply">Reply</button>
						<div id="replybox" style="">
							{{Form::open()}}
								{{Form::textarea('reply', null, ['placeholder' => 'Leave a reply..'])}}
								<br/>
								{{Form::Submit('Reply')}}
							{{Form::close()}}
						</div>
					@endforeach
					</div>
					<br/>
						{{Form::open(array('route' => ['post.view.users.comments', $userChannel->channel_name], 'id' => 'postFeedback'))}}
							@if(Auth::check())
							{{Form::hidden('user_id', Auth::User()->id, array('id' => 'user_id'))}}
							{{Form::hidden('channel_id', $userChannel->id, array('id' => 'channel_id'))}}
							@endif
							{{Form::textarea('feedback', null, array('placeholder' => 'Leave a feedback..', 'id' => 'textAreaFeedback'))}}
							{{Form::submit('Leave a feedback', array('id' => 'feedback'))}}
						{{Form::close()}}
				@endif
				</div>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
	</div><!--/.container page-->
</div>	
@stop


@section('some_script')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/user/channel_comments.js')}}
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