@extends('layouts.admin')



@section('content')
<div class="container">
	<br/><br/>
	<div class="col-md-6 col-md-offset-3">
		<div class="loginDivA">
			<div class="row">

			<div class="col-md-4">
				<img src="/img/logos/teflTv.png" class="center-block">
			</div>
			<div class="col-md-8">
				<h1>Login</h1>
				@if ($errors->any())
				<ul>
					{{ implode('', $errors->all('<li class="error">:message</li>')) }}
				</ul>
				@endif
				{{Form::open(array('route' => 'post.admin.index','method'=>'POST'))}}
				{{Form::label('Username')}}
				{{Form::text('channel_name',null,array('class'=>'form-control'))}}
				{{Form::label('Password')}}
				{{Form::password('password',null,array('class'=>'form-control'))}}
				<div class="text-right">
					{{Form::submit('Sign In',array('class'=>'btn btn-primary'))}}
				</div>
				{{Form::close()}}
			</div>
			</div>
		</div>
	</div>
</div>
</div>
@stop