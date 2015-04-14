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
					       
	<div class="comments row">
		@if(isset(Auth::User()->id))
		<span id='errorlabel' class='input-error'></span>
		<textarea id='comment' class="form-control v-comment" placeholder="Write your comment.."></textarea>
		<div class="text-right">
			<button id='btncomment' class="btn btn-info">Post</button>
		</div>

		{{Form::hidden('commentUser', Auth::User()->id, array('id'=>'commentUser'))}}
		@endif

	<div class="col-md-12 commentsarea">
		<div id="appendNewCommentHere"></div>
		@foreach($userFeedbacks as $userFeedback)
			<div class="commentsarea row">
				<?php
					if(file_exists(public_path('img/user/'.$userFeedback->user_id . '.jpg'))){
						$temp = 'img/user/'.$userFeedback->user_id . '.jpg';
					} else{
						$temp = 'img/user/0.jpg';
					}
				?>

				<div class="commentProfilePic col-md-1">
					{{HTML::image($temp, 'alt', array('class' => 'img-responsive inline', 'height' => '48px', 'width' => '48px'))}}
				</div>
				<div class="col-md-11">
					<div class="row">
					{{ link_to_route('view.users.channel', $userFeedback->channel_name, $parameters = array($userFeedback->channel_name), $attributes = array('id' => 'channel_name')) }}
					| &nbsp;<small><?php echo date('M m, Y h:i A', strtotime($userFeedback->created_at)); ?></small> 
					<br/>
					<p class="text-justify">
						{{$userFeedback->comment}}
					</p>
		
					
					@if(isset(Auth::User()->id))
						<?php
							$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $userFeedback->id, 'status' => 'liked'))->count();
							$dislikeCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $userFeedback->id, 'status' => 'disliked'))->count();

							$ifAlreadyLiked = DB::table('comments_likesdislikes')->where(array(
								'comment_id' => $userFeedback->id, 
								'user_id' => Auth::User()->id,
								'status' => 'liked'
							))->first();
							$ifAlreadyDisliked = DB::table('comments_likesdislikes')->where(array(
								'comment_id' => $userFeedback->id, 
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
							<input type="hidden" value="{{$userFeedback->id}}" name="likeCommentId">
							<input type="hidden" value="{{Auth::User()->id}}" name="likeUserId">

							<span class="likescount" id="likescount">{{$likesCount}}</span>
						</div>
						&nbsp;
						<div class='fa dislikedup'>
							<input type="hidden" value="{{$userFeedback->id}}" name="dislikeCommentId">
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
							$getCommentReplies = DB::table('comments_reply')
							->join('users', 'users.id', '=', 'comments_reply.user_id')
							->where('comment_id', $userFeedback->id)->count(); 
						?>
						<span class="repLink hand">{{$getCommentReplies}}<i class="fa fa-reply"></i></span>
					@else
						<?php
							$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $userFeedback->id, 'status' => 'liked'))->count();
							$dislikeCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $userFeedback->id, 'status' => 'disliked'))->count();
						?>
						<span class="likescount" id="likescount">{{$likesCount}} <i class="fa fa-thumbs-up"></i></span> &nbsp;
						<span class="dislikescount" id="dislikescounts">{{$dislikeCount}} <i class="fa fa-thumbs-down"></i></span> &nbsp;
						<?php 
							$getCommentReplies = DB::table('comments_reply')
							->join('users', 'users.id', '=', 'comments_reply.user_id')
							->where('comment_id', $userFeedback->id)->count(); 
						?>
						<span class="repLink hand">{{$getCommentReplies}}<i class="fa fa-reply"></i></span>
						<!--end updated by cess 3/26/15-->
					@endif<!--auth user-->
					<?php
						$getCommentReplies = DB::table('comments_reply')
							->join('users', 'users.id', '=', 'comments_reply.user_id')
							->orderBy('comments_reply.created_at', 'asc')
							->where('comment_id', $userFeedback->id)->get(); 
					?>
					<div id="replysection" class="panelReply">
						
							<?php
							foreach($getCommentReplies as $getCommentReply):
								if(file_exists(public_path('img/user/'.$userFeedback->user_id . '.jpg'))){
									$temp = 'img/user/'.$getCommentReply->user_id . '.jpg';
								} else{
									$temp = 'img/user/0.jpg';
								}
								?>

								<div class="commentProfilePic col-md-1">
									{{HTML::image($temp, 'alt', array('class' => 'img-responsive', 'height' => '48px', 'width' => '48px'))}}
								</div>
								<div class="col-md-11">
									<div class="row">
										<?php
										echo link_to_route('view.users.channel', $getCommentReply->channel_name, $parameters = array($getCommentReply->channel_name), $attributes = array('id' => 'channel_name')) . "&nbsp|&nbsp;";
										echo "<small>" . date('M m, Y h:i A',strtotime($getCommentReply->created_at)) . "</small><br/>" ;
										echo "<p class='text-justify'>" . $getCommentReply->reply . "<br/>" . "</p></hr>";?>
									</div>
								</div>	
							<?php endforeach;?>
						
									
						@if(isset(Auth::User()->id))
							{{Form::open(array('route'=>'post.addreply', 'id' =>'video-addReply', 'class' => 'inline'))}}
								{{Form::hidden('comment_id', $userFeedback->id)}}
								{{Form::hidden('user_id', Auth::User()->id)}}
								{{Form::textarea('txtreply', '', array('class' =>'form-control txtreply', 'id'=>'txtreply'))}}
								{{Form::submit('Reply', array('class'=> 'btn btn-primary pull-right', 'id'=>'replybutton'))}}

								<span class='replyError inputError'></span>
							{{Form::close()}} 
						@endif

					</div><!--/.reply section-->
				</div><!--/.col-md-10-->
				</div><!--/.row-->
			</div><!--/.commentsrowarea-->
			<hr/>

		@endforeach
	</div>
</div>

{{HTML::script('js/jquery.js')}}
{{HTML::script('js/showHideToggle.js')}}

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