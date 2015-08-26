@extends('layouts.publisher')

@section('title')
    Verifications | TEFLTV Publisher
@stop

@section('meta')

@stop


@section('content')
<div class="page_wrapper">
	<div class="top-bg">
	</div>
</div>
<div class="absolute-wrapper_2">
	<div class="col-md-8 col-md-offset-2">
		<div class="paper_2 White">

			<!--for publisher-->
			<div class="message-wrap">
				<div class="icons_style text-center">
					<img src="/img/icons/select-ico.png"><img src="/img/icons/share-ico.png"><img src="/img/icons/earn-ico.png">
				</div>

				<h1 class="text-center orangeC mg-t-20">TEFLTV Channel Account Verification</h1>
				<p class="notes text-center">For additional security purposes we would like to verify your account. </p>
				<div class="mg-t-20">
					<div class="col-md-10 col-md-offset-1 pub-infoDiv mg-t-20 textbox-layout">

						{{Form::open(array('route' => 'post.publishers.verification'))}}
						{{Form::label('channel_name')}}
						{{Form::text('channel_name', Auth::User()->channel_name, array('class' => 'form-control', 'disabled'))}}
						{{Form::label('password')}}
						{{Form::password('password')}}
						<div class="text-right">
							<button class="btn btn-warning">Cancel</button>
							{{Form::submit('Verify', array('class' => 'btn btn-primary'))}}
						</div>
						{{Form::close()}}
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>

@stop
