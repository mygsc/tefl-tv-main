       

	
	<div class="comments">
		<div class="grey same-H pad-v-10">
			<div class="row">
				<div class="content-padding">
					<h3 class="tBlue">Write a comment</h3>  
					@if(isset(Auth::User()->id))
						<span id='errorlabel' class='input-error'></span>
						<textarea id='comment' class="form-control v-comment" placeholder="Share your thoughts.."></textarea>
						<div class="text-right">
							<button id='btncomment' class="btn btn-info">Post</button>
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

		<div class="White same-H pad-v-10">
			<div class="row">
				<div class="content-padding">
					<h3>All Comments ({{$getVideoCommentsCounts}}) </h3>
					<div class="row commentsarea mg-lr-5" id="mainCommentBody">
						<div id="appendNewCommentHere"></div>
						@foreach($getVideoComments as $getVideoComment)
						<div class="commentsarea row commentDeleteArea">
							<?php
							if(file_exists(public_path('img/user/'.$getVideoComment->user_id . '.jpg'))){
								$temp = 'img/user/'.$getVideoComment->user_id . '.jpg';
							} else{
								$temp = 'img/user/0.jpg';
							}
							?>

							<div class="commentProfilePic col-md-1">
								{{HTML::image($temp, 'alt', array('class' => 'img-responsive inline', 'height' => '48px', 'width' => '48px'))}}
							</div>
							<div class="col-md-11">
								<div class="row">
									<b>{{ link_to_route('view.users.channel', $getVideoComment->channel_name, $parameters = array($getVideoComment->channel_name), $attributes = array('id' => 'channel_name')) }}</b>
									| &nbsp;<small><?php echo date('M m, Y h:i A', strtotime($getVideoComment->created_at)); ?></small> 
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

									<?php
										$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $getVideoComment->id, 'status' => 'liked'))->count();
										$dislikeCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $getVideoComment->id, 'status' => 'disliked'))->count();
									?>
									@if(isset(Auth::User()->id))
									<?php
										$ifAlreadyLiked = DB::table('comments_likesdislikes')->where(array(
											'comment_id' => $getVideoComment->id, 
											'user_id' => Auth::User()->id,
											'status' => 'liked'
											))->first();
										$ifAlreadyDisliked = DB::table('comments_likesdislikes')->where(array(
											'comment_id' => $getVideoComment->id, 
											'user_id' => Auth::User()->id,
											'status' => 'disliked'
											))->first();
									?>
										
										<div class='fa commentlikedup thumbUpC'>
											<span class="likescount" id="likescount">{{$likesCount}}</span>
											@if(!$ifAlreadyLiked)

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
											<span class="dislikescount" id="dislikescounts">{{$dislikeCount}}</span>
											<input type="hidden" value="{{$getVideoComment->id}}" name="dislikeCommentId">
											<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">
											<input type="hidden" value="{{$videoId}}" name="video_id">
											@if(!$ifAlreadyDisliked)
											<input type="hidden" value="disliked" name="status">
											<span class='fa-thumbs-down hand thumbDownC'></span>

											@else
												<input type="hidden" value="undisliked" name="status">
												<span class='fa-thumbs-down redC active-ico hand'></span>
											@endif
											 &nbsp;
										</div>&nbsp;
										@else
										<span class="likescount thumbUpC" id="likescount">{{$likesCount}} <i class="fa fa-thumbs-up"></i></span> &nbsp;
										<span class="dislikescount thumbDownC" id="dislikescounts">{{$dislikeCount}} <i class="fa fa-thumbs-down"></i></span> &nbsp;
										
										<!--end updated by cess 3/26/15-->
										@endif<!--auth user-->
										<?php
										$getCommentRepliesCount = DB::table('comments_reply')
										->join('users', 'users.id', '=', 'comments_reply.user_id')
										->where('comment_id', $getVideoComment->id)->count(); 

										$getCommentReplies = DB::table('comments_reply')
										->select('users.id', 'users.channel_name', 'comments_reply.id as commentreplyid', 'comments_reply.user_id', 'comments_reply.comment_id', 'comments_reply.reply', 'comments_reply.created_at as commentreplycreated_at')
										->join('users', 'users.id', '=', 'comments_reply.user_id')
										->orderBy('comments_reply.created_at', 'asc')
										->where('comments_reply.comment_id', $getVideoComment->id)->get();
										?>
							
										<span class="repLink hand wv-counts replyC"><i class="fa fa-reply"></i> {{$getCommentRepliesCount}} Replies</span>
										<div id="replysection" class="panelReply">
											<?php
											foreach($getCommentReplies as $getCommentReply):
												if(file_exists(public_path('img/user/'.$getVideoComment->user_id . '.jpg'))){
													$temp = 'img/user/'.$getCommentReply->user_id . '.jpg';
												} else{
													$temp = 'img/user/0.jpg';
												}
												?>
												<div class="deleteReplyArea">
													<div class="commentProfilePic col-md-1">
														{{HTML::image($temp, 'alt', array('class' => 'img-responsive', 'height' => '48px', 'width' => '48px'))}}
													</div>
													<div class="col-md-11 text-left">
														<div class="">
															<?php
															echo link_to_route('view.users.channel', $getCommentReply->channel_name, $parameters = array($getCommentReply->channel_name), $attributes = array('id' => 'channel_name')) . "&nbsp|&nbsp;";
															echo "<small>" . date('M m, Y h:i A',strtotime($getCommentReply->commentreplycreated_at)) . "</small><br/>" ;
															echo "<p class='text-justify'>" . $getCommentReply->reply . "<br/>" . "</p></hr>";?>
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
														<?php
														$likesCountReply = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $getCommentReply->commentreplyid, 'status' => 'liked'))->count();
														$dislikeCountReply = DB::table('comments_reply_likesdislikes')->where(array('comments_reply_id' => $getCommentReply->commentreplyid, 'status' => 'disliked'))->count();
														?>
														@if(isset(Auth::User()->id))
														<?php
														$ifAlreadyLiked = DB::table('comments_reply_likesdislikes')->where(array(
															'comments_reply_id' => $getCommentReply->commentreplyid, 
															'user_id' => Auth::User()->id,
															'status' => 'liked'
															))->first();
														$ifAlreadyDisliked = DB::table('comments_reply_likesdislikes')->where(array(
															'comments_reply_id' => $getCommentReply->commentreplyid, 
															'user_id' => Auth::User()->id,
															'status' => 'disliked'
															))->first();
															?>
															<div class='fa replylikedup thumbUpC'>
																<span class="likescount" id="likescount">{{$likesCountReply}}</span>
																@if(!$ifAlreadyLiked)
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
																<span class="dislikescount" id="dislikescounts">{{$dislikeCountReply}}</span>
																<input type="hidden" value="{{$getCommentReply->commentreplyid}}" name="dislikeCommentId">
																<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">
																<input type="hidden" value="{{$videoId}}" name="video_id">
																@if(!$ifAlreadyDisliked)
																<input type="hidden" value="disliked" name="status">
																<span class='fa-thumbs-down thumbDownC hand'></span>
																@else
																<input type="hidden" value="undisliked" name="status">
																<span class='fa-thumbs-down redC active-ico hand'></span>
																@endif
																 &nbsp;
															</div>
															&nbsp;
															@else
															<span class="likescount thumbUpC" id="likescount">{{$likesCountReply}} <i class="fa fa-thumbs-up"></i></span> &nbsp;
															<span class="dislikescount thumbDownC" id="dislikescounts">{{$dislikeCountReply}} <i class="fa fa-thumbs-down"></i></span> &nbsp;
															
															@endif<!--auth user-->
															<!-- //////////////////Comment Reply Thumbs up/down section///////////////// -->
															<hr/>
														</div>
													</div>	

												<?php endforeach;?>
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
									<hr/>
								</div><!--/.commentsrowarea-->
								<hr/>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
</div>
{{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/showHideToggle.js')}}