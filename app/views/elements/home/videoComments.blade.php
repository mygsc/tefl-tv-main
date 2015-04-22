       
<h3>Comments</h3>

	
	<div class="comments row mg-lr-5">
		@if(isset(Auth::User()->id))
		<span id='errorlabel' class='input-error'></span>
		<textarea id='comment' class="form-control v-comment" placeholder="Write your comment.."></textarea>
		<div class="text-right">
			<button id='btncomment' class="btn btn-info">Post</button>
		</div>

		{{Form::hidden('commentVideo', $videoId, array('id'=>'commentVideo'))}}
		{{Form::hidden('commentUser', Auth::User()->id, array('id'=>'commentUser'))}}
		@endif

	<div class="row commentsarea mg-lr-5">
		<div id="appendNewCommentHere"></div>
		@foreach($getVideoComments as $getVideoComment)
			<div class="commentsarea row">
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
					{{ link_to_route('view.users.channel', $getVideoComment->channel_name, $parameters = array($getVideoComment->channel_name), $attributes = array('id' => 'channel_name')) }}
					| &nbsp;<small><?php echo date('M m, Y h:i A', strtotime($getVideoComment->created_at)); ?></small> 
					<br/>
					<p class="text-justify">
						{{$getVideoComment->comment}}
					</p>
		
					
					@if(isset(Auth::User()->id))
						<?php
							$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $getVideoComment->id, 'status' => 'liked'))->count();
							$dislikeCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $getVideoComment->id, 'status' => 'disliked'))->count();

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
						<div class='fa likedup'>
							@if(!$ifAlreadyLiked)
								<span class='fa-thumbs-up hand'></span>
								<input type="hidden" value="liked" name="status">
							@else
								<span class='fa-thumbs-up blueC hand'></span>
								<input type="hidden" value="unliked" name="status">
							@endif
							<input type="hidden" value="{{$getVideoComment->id}}" name="likeCommentId">
							<input type="hidden" value="{{Auth::User()->id}}" name="likeUserId">
							<input type="hidden" value="{{$videoId}}" name="video_id">
							<span class="likescount" id="likescount">{{$likesCount}}</span>
						</div>
						&nbsp;
						<div class='fa dislikedup'>
							<input type="hidden" value="{{$getVideoComment->id}}" name="dislikeCommentId">
							<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">
							<input type="hidden" value="{{$videoId}}" name="video_id">
							@if(!$ifAlreadyDisliked)
								<input type="hidden" value="disliked" name="status">
								<span class='fa-thumbs-down hand'></span>
							@else
								<input type="hidden" value="undisliked" name="status">
								<span class='fa-thumbs-down redC hand'></span>
							@endif
							<span class="dislikescount" id="dislikescounts">{{$dislikeCount}}</span> &nbsp;
						</div>
						&nbsp;
						<?php 
							$getCommentReplies = DB::table('comments_reply')
							->join('users', 'users.id', '=', 'comments_reply.user_id')
							->where('comment_id', $getVideoComment->id)->count(); 
						?>
						<span class="repLink hand">{{$getCommentReplies}}<i class="fa fa-reply"></i></span>
					@else
						<?php
							$likesCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $getVideoComment->id, 'status' => 'liked'))->count();
							$dislikeCount = DB::table('comments_likesdislikes')->where(array('comment_id' => $getVideoComment->id, 'status' => 'disliked'))->count();
						?>
						<span class="likescount" id="likescount">{{$likesCount}} <i class="fa fa-thumbs-up"></i></span> &nbsp;
						<span class="dislikescount" id="dislikescounts">{{$dislikeCount}} <i class="fa fa-thumbs-down"></i></span> &nbsp;
						<?php 
							$getCommentReplies = DB::table('comments_reply')
							->join('users', 'users.id', '=', 'comments_reply.user_id')
							->where('comment_id', $getVideoComment->id)->count(); 
						?>
						<span class="repLink hand">{{$getCommentReplies}}<i class="fa fa-reply"></i></span>
						<!--end updated by cess 3/26/15-->
					@endif<!--auth user-->
					<?php
						$getCommentReplies = DB::table('comments_reply')
							->join('users', 'users.id', '=', 'comments_reply.user_id')
							->orderBy('comments_reply.created_at', 'asc')
							->where('comment_id', $getVideoComment->id)->get(); 
					?>
					<div id="replysection" class="panelReply">
						<?php
						foreach($getCommentReplies as $getCommentReply):
							if(file_exists(public_path('img/user/'.$getVideoComment->user_id . '.jpg'))){
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
								{{Form::hidden('comment_id', $getVideoComment->id)}}
								{{Form::hidden('user_id', Auth::User()->id)}}
								{{Form::hidden('video_id', $videoId)}}
								{{Form::textarea('txtreply', '', array('class' =>'form-control txtreply', 'id'=>'txtreply'))}}
								{{Form::submit('Reply', array('class'=> 'btn btn-primary pull-right mg-t-10', 'id'=>'replybutton'))}}

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
{{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/showHideToggle.js')}}