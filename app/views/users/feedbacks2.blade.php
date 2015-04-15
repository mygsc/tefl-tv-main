@extends('layouts.default')

@section('content')
<div class="row">
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
				@if(empty($userFeedbacks))
					No feedbacks yet..
					<br/>
				@else
					       
	<div class="feedbacks row">
		<textarea id='feedback' class="form-control v-feedback" placeholder="Write your feedback.."></textarea>
		<span id='errorlabel' class='input-error'></span>
		<br/>
		<div class="text-right">
		
	
		@if(!Auth::check())
			{{link_to_route('homes.signin', 'Sign-in to leave a feedback')}}
		@else
			<button id='btnfeedback' class="btn btn-info">Post</button>
			{{Form::hidden('feedbackUser', Auth::User()->id, array('id' => 'feedbackUser'))}}
			{{Form::hidden('feedbackOwner', $userChannel->id, array('id' => 'feedbackOwner'))}}
		
		@endif
		</div>

	<div class="col-md-12 feedbacksarea">
		<div id="appendNewFeedbackHere"></div>
		@foreach($userFeedbacks as $userFeedback)
			<div class="feedbacksarea row">
				<?php
					if(file_exists(public_path('img/user/'.$userFeedback->user_id . '.jpg'))){
						$temp = 'img/user/'.$userFeedback->user_id . '.jpg';
					} else{
						$temp = 'img/user/0.jpg';
					}
				?>

				<div class="feedbackProfilePic col-md-1">
					{{HTML::image($temp, 'alt', array('class' => 'img-responsive inline', 'height' => '48px', 'width' => '48px'))}}
				</div>
				<div class="col-md-11">
					<div class="row">
					{{ link_to_route('view.users.channel', $userFeedback->channel_name, $parameters = array($userFeedback->channel_name), $attributes = array('id' => 'channel_name')) }}
					| &nbsp;<small><?php echo date('M m, Y h:i A', strtotime($userFeedback->created_at)); ?></small> 
					<br/>
					<p class="text-justify">
						{{$userFeedback->feedback}}
					</p>
		
					
					@if(isset(Auth::User()->id))
						<?php
							$likesCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $userFeedback->id, 'status' => 'liked'))->count();
							$dislikeCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $userFeedback->id, 'status' => 'disliked'))->count();

							$ifAlreadyLiked = DB::table('feedbacks_likesdislikes')->where(array(
								'feedback_id' => $userFeedback->id, 
								'user_id' => Auth::User()->id,
								'status' => 'liked'
							))->first();
							$ifAlreadyDisliked = DB::table('feedbacks_likesdislikes')->where(array(
								'feedback_id' => $userFeedback->id, 
								'user_id' => Auth::User()->id,
								'status' => 'disliked'
							))->first();
						?>
						<div class='fa likedup'>
							@if(!$ifAlreadyLiked)
								<span class='fa-thumbs-up'></span>
								<input type="hidden" value="liked" name="status">
							@else
								<span class='fa-thumbs-up blueC'></span>
								<input type="hidden" value="unliked" name="status">
							@endif
							<input type="hidden" value="{{$userFeedback->id}}" name="likeFeedbackId">
							<input type="hidden" value="{{Auth::User()->id}}" name="likeUserId">

							<span class="likescount" id="likescount">{{$likesCount}}</span>
						</div>
						&nbsp;
						<div class='fa dislikedup'>
							<input type="hidden" value="{{$userFeedback->id}}" name="dislikeFeedbackId">
							<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">

							@if(!$ifAlreadyDisliked)
								<input type="hidden" value="disliked" name="status">
								<span class='fa-thumbs-down'></span>
							@else
								<input type="hidden" value="undisliked" name="status">
								<span class='fa-thumbs-down redC'></span>
							@endif
							<span class="dislikescount" id="dislikescounts">{{$dislikeCount}}</span> &nbsp;
						</div>
						&nbsp;
						<?php 
							$getFeedbackReplies = DB::table('feedbacks_replies')
							->join('users', 'users.id', '=', 'feedbacks_replies.user_id')
							->where('feedback_id', $userFeedback->id)->count(); 
						?>
						<span class="repLink hand">{{$getFeedbackReplies}}<i class="fa fa-reply"></i></span>
					@else
						<?php
							$likesCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $userFeedback->id, 'status' => 'liked'))->count();
							$dislikeCount = DB::table('feedbacks_likesdislikes')->where(array('feedback_id' => $userFeedback->id, 'status' => 'disliked'))->count();
						?>
						<span class="likescount" id="likescount">{{$likesCount}} <i class="fa fa-thumbs-up"></i></span> &nbsp;
						<span class="dislikescount" id="dislikescounts">{{$dislikeCount}} <i class="fa fa-thumbs-down"></i></span> &nbsp;
						<?php 
							$getFeedbackReplies = DB::table('feedbacks_replies')
							->join('users', 'users.id', '=', 'feedbacks_replies.user_id')
							->where('feedback_id', $userFeedback->id)->count(); 
						?>
						<span class="repLink hand">{{$getFeedbackReplies}}<i class="fa fa-reply"></i></span>
						<!--end updated by cess 3/26/15-->
					@endif<!--auth user-->
					<?php
						$getFeedbackReplies = DB::table('feedbacks_replies')
							->join('users', 'users.id', '=', 'feedbacks_replies.user_id')
							->orderBy('feedbacks_replies.created_at', 'asc')
							->where('feedback_id', $userFeedback->id)->get(); 
					?>
					<div id="replysection" class="panelReply">
						
							<?php
							foreach($getFeedbackReplies as $getFeedbackReply):
								if(file_exists(public_path('img/user/'.$getFeedbackReply->user_id . '.jpg'))){
									$temp = 'img/user/'.$getFeedbackReply->user_id . '.jpg';
								} else{
									$temp = 'img/user/0.jpg';
								}
								?>

								<div class="feedbackProfilePic col-md-1">
									{{HTML::image($temp, 'alt', array('class' => 'img-responsive', 'height' => '48px', 'width' => '48px'))}}
								</div>
								<div class="col-md-11">
									<div class="row">
										<?php
										echo link_to_route('view.users.channel', $getFeedbackReply->channel_name, $parameters = array($getFeedbackReply->channel_name), $attributes = array('id' => 'channel_name')) . "&nbsp|&nbsp;";
										echo "<small>" . date('M m, Y h:i A',strtotime($getFeedbackReply->created_at)) . "</small><br/>" ;
										echo "<p class='text-justify'>" . $getFeedbackReply->reply . "<br/>" . "</p></hr>";?>
									</div>
								</div>	
							<?php endforeach;?>
						
							@if(!Auth::check())
								{{link_to_route('homes.signin', 'Sign-in to reply to a feedback')}}
							@else
							{{Form::open(array('route'=>'post.viewusers.addreply-feedback','id' => 'addReplyFeedback', 'class' => 'inline'))}}
								@if(Auth::check())
								{{Form::hidden('feedback_id', $userFeedback->id)}}
								{{Form::hidden('user_id', Auth::User()->id)}}
								@endif
								{{Form::textarea('txtreply', '', array('class' =>'form-control txtreply', 'id'=>'txtreply', 'placeholder' => 'Leave a reply...'))}}
								{{Form::submit('Reply', array('class'=> 'btn btn-primary pull-right', 'id'=>'replybutton'))}}

								<span class='replyError inputError'></span>
							{{Form::close()}}
							@endif
					</div><!--/.reply section-->
				</div><!--/.col-md-10-->
				</div><!--/.row-->
			</div><!--/.feedbacksrowarea-->
			<hr/>

		@endforeach
	</div>
</div>

{{HTML::script('js/jquery.js')}}
{{HTML::script('js/showHideToggle.js')}}
{{HTML::script('js/user/reply.js')}}
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
	{{HTML::script('js/homes/comment.js')}}
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