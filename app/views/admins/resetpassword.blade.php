@extends('layouts.admin')

@section('content')
	<div class="container page">
		<div class="col-md-6 col-md-offset-3">
			<br/><br/>
			<div class="well">
				<h2>Reset Password</h2>	
				{{ Form::open(array('route' => 'post.admin.resetpassword')) }}
					{{ Form::label('Email','Email')}}
					<br>
					{{ Form::text('email',null, array('placeholder' => 'Email Address'))}}
					@if($errors->has('email'))
						{{$errors->first('email')}}
					@endif
					<br>
					<div class="text-right">
						{{ Form::submit('Recover', array('class' => 'btn btn-primary')) }}
					</div>
				{{ Form::close() }}
			</div>
		</div>

	</div>
@stop