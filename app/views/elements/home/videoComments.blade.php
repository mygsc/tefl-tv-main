<style type="text/css">
	textarea{
		min-height: 60px!Important;
		margin-bottom: 10px;
	}
</style>        
<h3>Comments</h3>

	
	<div class="comments row">
		@if(isset(Auth::User()->id))
		<span id='errorlabel' style='color:red;'></span>
		<textarea id='comment' class="form-control" placeholder="Write your comment.."></textarea>
		<div class="text-right">
			<button id='btncomment' class="btn btn-info">Post</button>
		</div>

		{{Form::hidden('commentVideo', $videoId, array('id'=>'commentVideo'))}}
		{{Form::hidden('commentUser', Auth::User()->id, array('id'=>'commentUser'))}}
		@endif

	<div class="col-md-12 commentsarea">
		@foreach($getVideoComments as $getVideoComment)
			<div class="commentsarea row">
				<?php
					if(file_exists(public_path('img/user/'.$getVideoComment->user_id . '.jpg'))){
						$temp = 'img/user/'.$getVideoComment->user_id . '.jpg';
					} else{
						$temp = 'img/user/0.png';
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
					<br/>
					
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
								<span class='fa-thumbs-up'></span>
								<input type="hidden" value="liked" name="status">
							@else
								<span class='fa-thumbs-up blueC'></span>
								<input type="hidden" value="unliked" name="status">
							@endif
							<input type="hidden" value="{{$getVideoComment->id}}" name="likeCommentId">
							<input type="hidden" value="{{Auth::User()->id}}" name="likeUserId">
							<input type="hidden" value="{{$videoId}}" name="video_id">
							<span class="likescount" id="likescount">{{$likesCount}}</span>
						</div>
						&nbsp;
						<div class='fa fa-thumbs-down dislikedup'>
							<input type="hidden" value="{{$getVideoComment->id}}" name="dislikeCommentId">
							<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">
							<input type="hidden" value="{{$videoId}}" name="video_id">
							@if(!$ifAlreadyDisliked)
								<input type="hidden" value="disliked" name="status">
							@else
								<input type="hidden" value="undisliked" name="status">
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
									$temp = 'img/user/0.png';
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
										echo "<p style='text-align:justify;'>" . $getCommentReply->reply . "<br/>" . "</p></hr>";?>
									</div>
								</div>	
							<?php endforeach;?>
						
									
						@if(isset(Auth::User()->id))
							{{Form::open(array('route'=>'post.addreply', 'id' =>'video-addReply', 'class' => 'inline'))}}
								<div class="replyArea"></div>
								{{Form::hidden('comment_id', $getVideoComment->id)}}
								{{Form::hidden('user_id', Auth::User()->id)}}
								{{Form::hidden('video_id', $videoId)}}
								{{Form::textarea('txtreply', '', array('class' =>'form-control txtreply', 'id'=>'txtreply'))}}
								{{Form::submit('Reply', array('class'=> 'btn btn-primary pull-right', 'id'=>'replybutton'))}}
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

<!--show hide for reply Box-->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".panelReply").hide('slow');
		$(".repLink").click(function(){
			$(".panelReply").hide();
			$(this).parent().children(".panelReply").slideToggle(500); 
		});
		$("[name='my-checkbox']").bootstrapSwitch();
	});
</script>
