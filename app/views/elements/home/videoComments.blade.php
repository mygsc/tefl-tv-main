       


<div class="comments">
	<div class="top-div same-H pad-v-10">
		<div class="row">
			<div class="content-padding">
				<h3 class="whiteC">Write a comment</h3>  
				@if(isset(Auth::User()->id))
					<span id='errorlabel' class='input-error'></span>
					<textarea id='comment' class="form-control v-comment" placeholder="Share your thoughts.."></textarea>
					<div class="text-right">
						<button id='btncomment' class="btn btn-primary">Post</button>
					</div>

					{{Form::hidden('commentVideo', $videoId, array('id'=>'commentVideo'))}}
					{{Form::hidden('commentUser', Auth::User()->id, array('id'=>'commentUser'))}}
				@else
					<a href="{{route('homes.signin')}}">
						<textarea id='comment' class="form-control v-comment" placeholder="Share your thoughts. Click this to login."></textarea>
					</a>
				@endif
			</div>
		</div>
	</div>

	<div class="White same-H pad-v-10 mg-t-10">
		<div class="row">
			<div class="content-padding">
				<h3>All Comments ({{$getVideoCommentsCounts}}) </h3>
				<div class="row commentsarea mg-lr-5" id="mainCommentBody">
					<div id="appendNewCommentHere"></div>
					@foreach($getVideoComments as $getVideoComment)
					<div class="commentsarea row commentDeleteArea">
						<div class="row-same-height " style="border-top:1px solid #cecece!important;margin-top:2px;">
							<div class="commentProfilePic c-userBg col-md-1 col-md-height ">
								{{HTML::image($getVideoComment->profile_picture, 'alt', array('class' => 'img-responsive inline', 'height' => '48px', 'width' => '48px','class' => 'mg-t-20'))}}
							</div>
							<div class="col-md-11 col-md-height">
								<div class="row content-padding">
									<b>{{ link_to_route('view.users.channel', $getVideoComment->channel_name, $parameters = array($getVideoComment->channel_name), $attributes = array('id' => 'channel_name')) }}</b>
									| &nbsp;<small>{{$getVideoComment->time_difference}}</small> 
									<br/>
									<p class="text-justify">{{$getVideoComment->comment}}</p>

									<div class='tooltipDelete inline hand'>
										<div class="wv-icon trashC">
											@if(isset(Auth::User()->id))
												@if(Auth::User()->id == $getVideoComment->user_id)
													<span class="deleteComment fa fa-trash" title="Delete this comment">	
														{{Form::hidden('comment_id', Crypt::encrypt($getVideoComment->id), array('id' => 'comment_id'))}}
														{{Form::hidden('video_id', Crypt::encrypt($getVideoComment->video_id), array('id' => 'video_id'))}}
														{{Form::hidden('user_id', Crypt::encrypt($getVideoComment->user_id), array('id' => 'user_id'))}}
													</span>
												@endif
											@endif
										</div>
									</div>
									@if(isset(Auth::User()->id))									
									<div class='fa commentlikedup thumbUpC'>
										<span class="likescount" id="likescount">{{$getVideoComment->likesCount}}</span>
										@if(!$getVideoComment->ifAlreadyLiked)
											<span class='fa-thumbs-up thumbUpC hand'></span>
											<input type="hidden" value="liked" name="status">
										@else
											<span class='fa-thumbs-up blueC active-ico hand'></span>
											<input type="hidden" value="unliked" name="status">
										@endif
										<input type="hidden" value="{{$getVideoComment->id}}" name="likeCommentId">
										<input type="hidden" value="{{Auth::User()->id}}" name="likeUserId">
										<input type="hidden" value="{{$videoId}}" name="video_id">
									</div>
									&nbsp;
									<div class='fa commentdislikedup thumbDownC'>
										<span class="dislikescount" id="dislikescounts">{{$getVideoComment->dislikeCount}}</span>
										<input type="hidden" value="{{$getVideoComment->id}}" name="dislikeCommentId">
										<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">
										<input type="hidden" value="{{$videoId}}" name="video_id">
										@if(!$getVideoComment->ifAlreadyDisliked)
											<input type="hidden" value="disliked" name="status">
											<span class='fa-thumbs-down hand thumbDownC'></span>
										@else
											<input type="hidden" value="undisliked" name="status">
											<span class='fa-thumbs-down redC active-ico hand'></span>
										@endif&nbsp;
									</div>&nbsp;
									@else
										<span class="likescount thumbUpC" id="likescount">{{$getVideoComment->likesCount}} <i class="fa fa-thumbs-up"></i></span> &nbsp;
										<span class="dislikescount thumbDownC" id="dislikescounts">{{$getVideoComment->dislikeCount}} <i class="fa fa-thumbs-down"></i></span> &nbsp;
										
										<!--end updated by cess 3/26/15-->
									@endif<!--auth user-->

									<span class="repLink hand wv-counts replyC"><i class="fa fa-reply"></i> {{$getVideoComment->getCommentRepliesCount}} Replies</span>
									<div id="replysection" class="panelReply">
										@foreach($getVideoComment->getCommentReplies as $getCommentReply)
										<div class="deleteReplyArea">
											<div class="commentProfilePic col-md-1">
												{{HTML::image($getCommentReply->profile_picture, 'alt', array('class' => 'img-responsive', 'height' => '48px', 'width' => '48px'))}}
											</div>
											<div class="col-md-11 text-left">
												<div class="">
													{{link_to_route('view.users.channel', $getCommentReply->channel_name, $parameters = array($getCommentReply->channel_name), $attributes = array('id' => 'channel_name'))}} aw&nbsp;|&nbsp;
													<small> {{$getCommentReply->time_difference}} </small><br/> 
													<p class='text-justify'>{{$getCommentReply->reply}} <br/></p></hr>
												</div>
												<div class='tooltipDelete inline hand'>
													<div class="wv-icon trashC">
														@if(isset(Auth::User()->id))
															@if(isset($getCommentReply->user_id))
																@if(Auth::User()->id == $getCommentReply->user_id)
																<span class="deleteReply fa fa-trash" title="Delete this reply">	
																	{{Form::hidden('c_id', Crypt::encrypt($getCommentReply->commentreplyid), array('id' => 'c_id'))}}
																	{{Form::hidden('comment_id', Crypt::encrypt($getCommentReply->comment_id), array('id' => 'comment_id'))}}
																	{{Form::hidden('user_id', Crypt::encrypt($getCommentReply->user_id), array('id' => 'user_id'))}}
																</span>
																@endif
															@endif
														@endif
													</div>
												</div>

												<!-- //////////////////Comment Reply Thumbs up/down section///////////////// -->

												@if(isset(Auth::User()->id))
													<div class='fa replylikedup thumbUpC'>
														<span class="likescount" id="likescount">{{$getCommentReply->likesCountReply}}</span>
														@if(!$getCommentReply->ifAlreadyLiked)
															<span class='fa-thumbs-up hand thumbUpC'></span>
															<input type="hidden" value="liked" name="status">
														@else
															<span class='fa-thumbs-up blueC active-ico hand'></span>
															<input type="hidden" value="unliked" name="status">
														@endif
														<input type="hidden" value="{{$getCommentReply->commentreplyid}}" name="likeCommentId">
														<input type="hidden" value="{{Auth::User()->id}}" name="likeUserId">
														<input type="hidden" value="{{$videoId}}" name="video_id">
													</div>
													&nbsp;
													<div class='fa replydislikedup inline thumbDownC'>
														<span class="dislikescount" id="dislikescounts">{{$getCommentReply->dislikeCountReply}}</span>
														<input type="hidden" value="{{$getCommentReply->commentreplyid}}" name="dislikeCommentId">
														<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">
														<input type="hidden" value="{{$videoId}}" name="video_id">
														@if(!$getCommentReply->ifAlreadyDisliked)
															<input type="hidden" value="disliked" name="status">
															<span class='fa-thumbs-down thumbDownC hand'></span>
														@else
															<input type="hidden" value="undisliked" name="status">
															<span class='fa-thumbs-down redC active-ico hand'></span>
														@endif
														&nbsp;
													</div>&nbsp;
												@else
													<span class="likescount thumbUpC" id="likescount">{{$getCommentReply->likesCountReply}} <i class="fa fa-thumbs-up"></i></span> &nbsp;
													<span class="dislikescount thumbDownC" id="dislikescounts">{{$getCommentReply->dislikeCountReply}} <i class="fa fa-thumbs-down"></i></span> &nbsp;
												@endif<!--auth user-->
												<!-- //////////////////Comment Reply Thumbs up/down section///////////////// -->
												<hr/>
											</div>
										</div>	
									@endforeach
									@if(isset(Auth::User()->id))

									<hr/>
									{{Form::open(array('route'=>'post.addreply', 'id' =>'video-addReply', 'class' => 'inline'))}}
									{{Form::hidden('comment_id', $getVideoComment->id)}}
									{{Form::hidden('user_id', Auth::User()->id)}}
									{{Form::hidden('video_id', $videoId)}}
									{{Form::textarea('txtreply', '', array('class' =>'form-control txtreply', 'id'=>'txtreply'))}}
									{{Form::submit('Reply', array('class'=> 'btn btn-primary pull-right mg-t-10', 'id'=>'replybutton'))}}
									<span class='replyError inputError'></span>
									{{Form::close()}} 


									@endif
								</div><!--/.reply section-->
							</div><!--/.row-->
						</div><!--/.col-md-11-->
					</div>

				</div><!--/.commentsrowarea-->

				@endforeach
			</div>
		</div>
	</div>
</div>

</div>
{{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/showHideToggle.js')}}