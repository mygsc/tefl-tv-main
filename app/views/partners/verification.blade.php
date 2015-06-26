@extends('layouts.default')

@section('title')
	Account Verification
@stop

@section('content')
<div class="container same-H White h-minH">
	<div class="content-padding">
		<h1 class="text-center orangeC mg-t-20">TEFLTV Channel Account Verification</h1>
		<div class="mg-t-20">
			<br/><br/>
			<div class="col-md-6 col-md-offset-3 pub-infoDiv mg-t-20 textbox-layout">
				<p class="notes">For additional security purposes we would like to verify your account. </p>
				{{Form::open(array('route' => 'post.partners.verification'))}}
				{{Form::label('channel_name')}}
				{{Form::text('channel_name', Auth::User()->channel_name, array('class' => 'form-control', 'disabled'))}}
				{{Form::label('password')}}
				{{Form::password('password')}}
				<div class="text-right">
					<button class="btn btn-info">Cancel</button>
					{{Form::submit('Verify', array('class' => 'btn btn-primary'))}}
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>
@stop