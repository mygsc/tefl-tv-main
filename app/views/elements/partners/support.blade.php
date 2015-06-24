<div class="row White same-H">
	<div class="Orange-bg support_head">
		Partner's Support
	</div>
	<div class="content-padding">
		<br/>
		<p class="text-justify">We would be happy to help you, please submit your concerns here or send us an email at <a>support@tefltv.com</a></p>
		{{Form::open(array('route' => 'post.homes.aboutus'))}}
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
		<div class="text-right mg-b-20">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary'))}}
		</div>
		{{Form::close()}}
	</div>
</div>