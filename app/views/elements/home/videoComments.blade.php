
		<hr>
		<h3>Comments for Teaching English in Vietnam </h3>
		<div class="row">
			<div class="col-md-1">
				<img src="/img/user/u1.png" class="">
			</div>
			<div class="col-md-11">
				{{Form::textarea('comment', null, array('placeholder' => 'Write Comment', 'rows' => 2, 'required'))}}
				<div class="text-right">
					{{ Form::submit('comment', array('class' => 'btn btn-info')); }}
				</div>
			</div>
			{{Form::close()}}
		</div>


		<div class="col-md-1">
			<img src="/img/user/u2.png" >
		</div>
		<div class="col-md-11">
			<h4>Jesus<br>
				<small>February 6, 2015</small>
			</h4>
			<div><!--comment content-->
				<p>I am the way, the truth and the life</p>
			</div><!--/comment content-->
			
			<span class="repLink commentLink">Reply</span>
			&nbsp;||&nbsp;
			<span class="commentLink linkReply">View 2 Replies</span>
			&nbsp;||&nbsp;
			12<img src="/img/icons/like.png" class="hand">

			<div class="seeReply">
				<div class="col-md-1">
					<img src="/img/user/u3.png" >
				</div>
				<div class="col-md-11">
					<h4>Jesus<br>
						<small>February 6, 2015</small>
					</h4>
					<div><!--comment content-->
						<p>I am the way, the truth and the life</p>
					</div><!--/comment content-->
				</div>

			</div><!--/seeReply-->
			<div class="panelReply">
				<div class="col-md-1">
					<img src="/img/user/u1.png" class="">
				</div>
				<div class="col-md-11">
					{{Form::textarea('comment', null, array('placeholder' => 'Write Comment', 'rows' => 2, 'required'))}}
					<div class="text-right">
						{{ Form::submit('comment', array('class' => 'btn btn-info')); }}
					</div>
				</div>
				{{Form::close()}}
			</div><!--/panelReply-->
			<br/>
		</div><!--/col 11-->

