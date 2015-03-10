@extends('layouts.admin')
@section('content')
<div class="container page">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<br/><br/>
				<div class="well">

					<h1>RESET PASSWORD</h1>
					<hr>
					@if ($errors->any())
					    <ul>
					        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
					    </ul>
					@endif
					{{Form::open(array('route' => 'post.admin.changepassword','method'=>'POST'))}}
					{{Form::label('Current Password')}}
					{{Form::password('current_password',null,array('class'=>'form-control'))}}
					{{Form::label('New Password')}}
					{{Form::password('password',null,array('class'=>'form-control'))}}
					{{Form::label('Confirm Password')}}
					{{Form::password('password_confirmation',null,array('class'=>'form-control'))}}
					<div class="text-right"> 
						{{Form::submit('Submit',array('class'=>'btn btn-primary'))}}
					</div>
					{{Form::close()}}
			</div>
		</div>
</div>
@stop