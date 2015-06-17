@extends('layouts.default')

@section('content')
<div class="row">
	<br/>
	<div class="container">
		<div class="row same-H White">
			@include('elements/users/profileTop')

			<div class="White channel-content">
				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs visible-lg visible-md" role="tablist">
				    	<li role="presentation">{{link_to_route('users.channel', 'Home', null)}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<li role="presentation" class="active">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  	</ul><!--tabNav-->
				</div>
				<nav class="navbar navbar-default visible-sm visible-xs">
					<div class="container-fluid">
						<div class="navbar-header">

							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<h4 class="inline mg-t-20">Feedbacks</h4>	
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
								<li>{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
							</ul>
						</div>
					</div>
				</nav>

				<div class="feedbackSection content-padding">
					
	@if($userFeedbacks->isEmpty())
		<h3 class="text-center">No feedbacks yet..</h3>
	@else
					       
	<div class="feedbacks row mg-t-20">
		@if(Auth::check())
		<br/><br/>
		{{ Form::open(array('routes' => 'post.users.feedbacks'))}}
		<textarea id='feedback' class="form-control v-feedback" placeholder="Write your feedback.."></textarea>
		<span id='errorlabel' class='input-error'></span>
		<br/><br/>
		<div class="text-right">s
				<button id='btnfeedback' class="btn btn-info">Post</button>
				{{Form::hidden('feedbackUser', Auth::User()->id, array('id' => 'feedbackUser'))}}
				{{Form::hidden('feedbackOwner', Auth::User()->id, array('id' => 'feedbackOwner'))}}
				{{Form::submit('Post Feedback', array('class' => 'btn btn-info'))}}
		</div>
		{{Form::close()}}
		@endif
	<div class="col-md-12 feedbacksarea" id="mainCommentBody">
		<div id="appendNewFeedbackHere"></div>
		@foreach($userFeedbacks as $userFeedback)
			<div class="feedbacks_section row" id="feedback{{$userFeedback->id}}">
				<div class="feedbackProfilePic col-md-1">
					{{HTML::image($temp, 'alt', array('class' => 'userRep'))}}
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
							$getFeedbackReplies = DB::table('feedback_replies')
							->join('users', 'users.id', '=', 'feedback_replies.user_id')
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
							$getFeedbackReplies = DB::table('feedback_replies')
							->join('users', 'users.id', '=', 'feedback_replies.user_id')
							->where('feedback_id', $userFeedback->id)->count(); 
						?>
						<span class="repLink hand">{{$getFeedbackReplies}}<i class="fa fa-reply"></i></span>
						<!--end updated by cess 3/26/15-->
					@endif<!--auth user-->
					<?php
						$getFeedbackReplies = DB::table('feedback_replies')
							->join('users', 'users.id', '=', 'feedback_replies.user_id')
							->orderBy('feedback_replies.created_at', 'asc')
							->where('feedback_id', $userFeedback->id)->get(); 
					?>
					@if(Auth::check())
					<div class="nav_div inline">
						<button class="spam fa fa-flag btn-trans" title="report" id="spam{{$userFeedback->id}}">
							{{Form::hidden('spam_feedback_id', $userFeedback->id, array('id' => 'spam_feedback_id'))}}
						</button>
						<!--<button class="delete btn-trans fa fa-trash" title="remove" id="feedback{{$userFeedback->id}}">	
							{{Form::hidden('channel_id', $userFeedback->channel_id, array('id' => 'channel_id'))}}
							{{Form::hidden('user_id', Auth::User()->id, array('id' => 'user_id'))}}
							{{Form::hidden('feedback_id', $userFeedback->id, array('id' => 'feedback_id'))}}
						</button>-->
					</div>
					@endif
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
									{{HTML::image($temp, 'alt', array('class' => 'userRep'))}}
								</div>
								<div class="col-md-11">
									<div class="row">
										
										<?php
										echo link_to_route('view.users.channel', $getFeedbackReply->channel_name, $parameters = array($getFeedbackReply->channel_name), $attributes = array('id' => 'channel_name')) . "&nbsp|&nbsp;";
										echo "<small>" . date('M m, Y h:i A',strtotime($getFeedbackReply->created_at)) . "</small><br/>" ;
										echo "<p class='text-justify'>" . $getFeedbackReply->reply . "<br/>" . "</p></hr><br/>";?>
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
{{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/showHideToggle.js')}}
{{HTML::script('js/user/feedback.js')}}
	@endif
				</div>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
		<br/>
	</div><!--/.container page-->
</div>

	
@stop


@section('script')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/mention.js')}}
<!-- 	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script> -->
@stop