<style type="text/css">
	textarea{
		min-height: 60px!Important;
		margin-bottom: 10px;
	}
</style>        
<h3>Comments</h3>
@if(isset(Auth::User()->id))
<div class="comments row">
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
				{{ link_to_route('view.users.channel', $getVideoComment->channel_name, $parameters = array($getVideoComment->channel_name), $attributes = array('id' => 'channel_name')) }}
				| &nbsp;<small><?php echo date('M m, Y h:i A', strtotime($getVideoComment->created_at)); ?></small> 
				<br/>
				<p style='margin-left:30px;text-align:justify;'>
					{{$getVideoComment->comment}}
				</p>
				<br/>

				<!-- <button id='c'>Reply</button> -->
				@if(isset(Auth::User()->id))
					<!--like count-->
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
					<div class='fa fa-thumbs-up likedup'>
						<input type="hidden" value="{{$getVideoComment->id}}" name="likeCommentId">
						<input type="hidden" value="{{Auth::User()->id}}" name="likeUserId">
						<input type="hidden" value="{{$videoId}}" name="video_id">
						@if(!$ifAlreadyLiked)
							<input type="hidden" value="liked" name="status">
						@else
							<input type="hidden" value="unliked" name="status">
						@endif
						<span class="likescount" id="likescount">{{$likesCount}}</span>
					</div>
					|&nbsp;
					<div class='fa fa-thumbs-down dislikedup'>
						<input type="hidden" value="{{$getVideoComment->id}}" name="dislikeCommentId">
						<input type="hidden" value="{{Auth::User()->id}}" name="dislikeUserId">
						<input type="hidden" value="{{$videoId}}" name="video_id">
						@if(!$ifAlreadyDisliked)
							<input type="hidden" value="disliked" name="status">
						@else
							<input type="hidden" value="undisliked" name="status">
						@endif
						<span class="dislikescount" id="dislikesCount">{{$dislikeCount}}</span> &nbsp;
					</div>
					<!-- <a href="#"><i class='fa fa-thumbs-down'></i></a> -->
				@endif
				<?php
					$getCommentReplies = DB::table('comments_reply')
						->join('users', 'users.id', '=', 'comments_reply.user_id')
						->orderBy('comments_reply.created_at', 'asc')
						->where('comment_id', $getVideoComment->id)->get(); 
				?>

				|&nbsp;<span class="repLink hand blueC">Reply</span>


				<div id="replysection" class="panelReply">
					<?php
					foreach($getCommentReplies as $getCommentReply):
						echo link_to_route('view.users.channel', $getCommentReply->channel_name, $parameters = array($getCommentReply->channel_name), $attributes = array('id' => 'channel_name')) . "&nbsp|&nbsp;";
						echo "<small>" . date('M m, Y h:i A',strtotime($getCommentReply->created_at)) . "</small><br/>" ;
						echo "<p style='margin-left:30px;text-align:justify;'>" . $getCommentReply->reply . "<br/>" . "</p></hr>";
					endforeach;
					?>
					@if(isset(Auth::User()->id))
						{{Form::open(array('route'=>'post.addreply', 'id' =>'video-addReply', 'class' => 'inline'))}}
							{{Form::hidden('comment_id', $getVideoComment->id)}}
							{{Form::hidden('user_id', Auth::User()->id)}}
							{{Form::hidden('video_id', $videoId)}}
							{{Form::textarea('txtreply', '', array('class' =>'form-control', 'id'=>'txtreply'))}}
							{{Form::submit('Reply', array('class'=> 'btn btn-primary pull-right', 'id'=>'replybutton'))}}
						{{Form::close()}} 
					@endif
				</div>
			</div>
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
