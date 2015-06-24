@extends('layouts.partner')

@section('title')
	TEFL TV partner's Support
@stop

@section('content')
<div class="page_wrapper">
	<div class="top-bg">
	</div>
</div>
<div class="absolute-wrapper_2">
	<div class="col-md-10 col-md-offset-1">
		<div class="paper White">
			<div class="row content-padding ">
				<br/><br/>
				<div class="content-padding">
					<h2>TEFLTV Partner's Support</h2>
					<p>We would be happy to help you, please submit your concerns here or send us an email at <a>support@tefltv.com</a></p>
				
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
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>

@stop