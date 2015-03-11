@extends('layouts.admin')

@section('content')
	<div class="container page">
		<br/><br/>
		<div class="col-md-6 col-md-offset-3">
			<div class="well textbox-layout">
				<h2>Send registration link - Admin</h2>	
				{{ Form::open(array('route' => 'post.admin.createadminlink')) }}
					{{ Form::label('Email','Email')}}
					<br>
					{{ Form::text('email',null, array('placeholder' => 'Email Address'))}}
					@if($errors->has('email'))
						{{$errors->first('email')}}
					@endif
					<br>
					<div class="text-right">
						{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
					</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop