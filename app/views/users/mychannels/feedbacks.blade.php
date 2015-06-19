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
					<br/><br/>
					@if($userFeedbacks->isEmpty())
					<h3 class="text-center">No feedbacks yet..</h3>
					@endif

					<div class="feedbacks row">
						<div class="col-md-12 feedbacksarea">
							<div id="appendNewFeedbackHere"></div>
							@foreach($userFeedbacks as $userFeedback)
							@if($userFeedback->spam < 5)
							<div class="feedbacks_section row" id="feedback{{$userFeedback->id}}">
				
								<div class="feedbackProfilePic col-md-1">
									{{HTML::image($userFeedback->profile_picture, 'alt', array('class' => 'userRep'))}}
								</div>
								<div class="col-md-11">
									<div class="row">
										{{ link_to_route('view.users.channel', $userFeedback->channel_name, $parameters = array($userFeedback->channel_name), $attributes = array('id' => 'channel_name')) }}
										| &nbsp;<small><?php echo date('M m, Y', strtotime($userFeedback->created_at)); ?></small> 
										<br/>
										<p class="text-justify">
											{{$userFeedback->feedback}}
										</p>


										@if(isset(Auth::User()->id))

										<div class='fa likedup'>
											@if(!$userFeedback->ifAlreadyLiked)
											<span class='fa-thumbs-up'></span>
											<input type="hidden" value="liked" name="status">
											@else
											<span class='fa-thumbs-up blueC'></span>
											<input type="hidden" value="unliked" name="status">
											@endif
											<input type="hidden" value="{{$userFeedback->id}}" name="likeFeedbackId">
											<input type="hidden" value="{{Auth::User()->id}}" name="likeUserId">

											<span class="likescount" id="likescount">{{$userFeedback->likesCount}}</span>
										</div>
										&nbsp;
										<div class='fa dislikedup'>
											<input type="hidden" value="{{$userFeedback->id}}" name="dislikeFeedbackId">
											<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">

											@if(!$userFeedback->ifAlreadyDisliked)
											<input type="hidden" value="disliked" name="status">
											<span class='fa-thumbs-down'></span>
											@else
											<input type="hidden" value="undisliked" name="status">
											<span class='fa-thumbs-down redC'></span>
											@endif
											<span class="dislikescount" id="dislikescounts">{{$userFeedback->dislikeCount}}</span> &nbsp;
										</div>
										&nbsp;

										<!--<span class="repLink hand">{{$userFeedback->countFeedbackReplies}}
										<i class="fa fa-reply"></i></span>-->
										@else

										<span class="likescount" id="likescount">{{$userFeedback->likesCount}} <i class="fa fa-thumbs-up"></i></span> &nbsp;
										<span class="dislikescount" id="dislikescounts">{{$userFeedback->dislikeCount}} <i class="fa fa-thumbs-down"></i></span> &nbsp;

										<!--<span class="repLink hand">{{$userFeedback->countFeedbackReplies}}<i class="fa fa-reply"></i></span>-->
										<!--end updated by cess 3/26/15-->
										@endif<!--auth user-->
										@if(Auth::check())
										@if(Auth::User()->id == $userFeedback->user_id)
										<span class="nav_div">
											<button class="delete fa fa-trash btn-trans" title="remove" id="feedback{{$userFeedback->id}}">
												{{Form::hidden('channel_id', $userFeedback->channel_id, array('id' => 'channel_id'))}}
												{{Form::hidden('user_id', Auth::User()->id, array('id' => 'user_id'))}}
												{{Form::hidden('feedback_id', $userFeedback->id, array('id' => 'feedback_id'))}}
											</button>
										</span>
										@endif
										@endif
										<div id="replysection" class="panelReply">

											@foreach($userFeedback->getFeedbackReplies as $getFeedbackReply)
											<div class="col-md-11">
												<div class="row" id="reply{{$getFeedbackReply->id}}">
													<div class="feedbackProfilePic col-md-1">
														@if(file_exists(public_path('img/user/'.$getFeedbackReply->user_id . '.jpg')))
														{{HTML::image('img/user/'.$getFeedbackReply->user_id . '.jpg', 'alt', array('class' => 'userRep'))}}
														@else
														{{HTML::image('img/user/0.jpg','alt', array('class' => 'userRep'))}}
														@endif
													</div>
													
													{{link_to_route('view.users.channel', $getFeedbackReply->channel_name, $parameters = array($getFeedbackReply->channel_name), $attributes = array('id' => 'channel_name'))."&nbsp;|&nbsp;"}}
													<small>{{date('M m, Y h:i A',strtotime($getFeedbackReply->created_at))}}</small>
													@if(Auth::check())
													@if(Auth::User()->id == $getFeedbackReply->user_id)
													<span class="nav_div" >	
														<button class="replyDelete btn-trans fa fa-trash" title="remove" id="reply{{$getFeedbackReply->id}}" value="{{$getFeedbackReply->id}}">
															{{Form::hidden('deleteReply_user_id', Auth::User()->id, array('id' => 'deleteReply_user_id'))}}
															{{Form::hidden('deleteReply_feedback_id', $getFeedbackReply->feedback_id, array('id' => 'deleteReply_feedback_id'))}}
														</button>
													</span>
													@endif
													@endif
													<br/>
													<p class='text-justify'>{{$getFeedbackReply->reply}}<br/></p><hr/><br/>
												</div>
											</div>	
											@endforeach

											@if(!Auth::check())
											{{link_to_route('homes.signin', 'Sign-in to reply to a feedback')}}
											@else
											{{Form::open(array('route'=>'post.viewusers.addreply-feedback','id' => 'addReplyFeedback', 'class' => 'inline'))}}
											@if(Auth::check())
											{{Form::hidden('feedback_id', $userFeedback->id)}}
											{{Form::hidden('user_id', Auth::User()->id)}}
											@endif
											{{Form::textarea('txtreply', '', array('class' =>'form-control txtreply', 'id'=>'txtreply', 'placeholder' => 'Leave a reply...'))}}

											{{Form::submit('Reply', array('class'=> 'btn btn-primary pull-right mg-t-10', 'id'=>'replybutton'))}}

											<span class='replyError inputError'></span>
											{{Form::close()}}
											@endif
										</div><!--/.reply section-->
									</div><!--/.col-md-10-->
								</div><!--/.row-->
							</div><!--/.feedbacksrowarea-->
							<hr/>
							@endif
							@endforeach
						</div>
					</div>
					


				</div>
			</div><!--!/.shadow div-channel-border-->
		</div><!--/.row-->
		<br/>
	</div><!--/.container page-->
</div>	
@stop


@section('some_script')
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/user/channel_comments.js')}}
{{HTML::script('js/mention.js')}}
{{HTML::script('js/showHideToggle.js')}}
{{HTML::script('js/user/reply.js')}}
