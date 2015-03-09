@extends('layouts.default')
@section('content')
<div class="container">
	<center>
		<div class="row">
			<h1>RESET PASSWORD</h1>
			{{Form::open(array('route' => 'post.admin.changepassword','method'=>'POST'))}}
			{{Form::label('Current Password')}}
			{{Form::password('current_password',null,array('class'=>'form-control','required' => true))}}
			@if($errors->has('current_password'))
				<span class="inputError">
					{{$errors->first('current_password')}}
				</span><br/>
			@endif
			{{Form::label('New Password')}}
			{{Form::password('password',null,array('class'=>'form-control','required' => true))}}
			@if($errors->has('password'))
				<span class="inputError">
					{{$errors->first('password')}}
				</span><br/>
			@endif
			{{Form::label('Confirm Password')}}
			{{Form::password('password_confirmation',null,array('class'=>'form-control','required' => true))}}
			@if($errors->has('password_confirmation'))
				<span class="inputError">
					{{$errors->first('password_confirmation')}}
				</span><br/>
			@endif
			{{Form::submit('Submit',array('class'=>'btn btn-primary'))}}
			{{Form::close()}}
		</div>
	</center>
</div>
@stop