@extends('layouts.default')

@section('title')
	Random Page
@stop

@section('content')
	<div class="container White h-minH">
		<div class="col-md-12">
			<div class="row">
				<br/>
				{{Form::open(array('route'=>'homes.post.random','id' => 'btnSubmit'))}}
				{{Form::label('option', 'Dispaly Randomize :')}}
				{{Form::select('option', $options, Input::old('option'), array('id' => 'cmbOption', 'class' => 'form-control', 'style' => 'width:auto;'))}}
				{{Form::close()}}
			</div>
			<hr/>
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