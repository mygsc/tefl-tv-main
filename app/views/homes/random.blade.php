@extends('layouts.default')

@section('title')
	Random Page
@stop

@section('content')
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				{{Form::open(array('route'=>'homes.post.random','id' => 'btnSubmit'))}}
				{{Form::label('option', 'Randomize by')}}
				{{Form::select('option', $options, Input::old('option'), array('id' => 'cmbOption'))}}
				{{Form::close()}}
			</div>
			<div class="row">
				@if($type == 'playlist')
					@include('elements.home.randoms.playlist')
				@elseif($type == 'channel')
					@include('elements.home.randoms.channel')
				@else
					@include('elements.home.randoms.video')
				@endif
			</div>
		</div>
	</div>
@stop

@section('script')
	{{HTML::script('js/homes/random.js')}}
@stop