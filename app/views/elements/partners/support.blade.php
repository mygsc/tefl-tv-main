<div class="row White same-H" id="support">
	<div class="support_head">
		Partner's Support
	</div>
	<div class="content-padding">
		<br/>
		<p class="text-justify">Please submit your concerns here or email us at <a>support@tefltv.com</a></p>
		{{Form::open(array('route' => 'post.partner.concern','id'=>'user-concern'))}}
			<span class="textbox-layout">
				{{ Form::text('name', '', array('placeholder' => 'Name' , 'class' => 'form-control')); }}
				@if($errors->has('name'))
				<span class="inputError">
					{{$errors->first('name')}}
				</span>
				@endif
				{{ Form::text('email', '', array('placeholder' => 'Email' , 'class' => 'form-control')); }}
				@if($errors->has('email'))
				<span class="inputError">
					{{$errors->first('email')}}
				</span>
				@endif
				{{ Form::textarea('message', '', array('placeholder' => 'Message', 'class' => 'textAreaContact form-control')); }}
				@if($errors->has('message'))
				<span class="inputError">
					{{$errors->first('message')}}
				</span>
				@endif
			</span>
		<div class="text-right mg-b-20 wrap">
			<div class="btn btn-primary form-control side-bottom">
			{{ Form::submit('Submit', array('class' => 'btn-hide'))}}
			</div>
		</div>
		{{Form::close()}}
	</div>
</div>