@extends('layouts.default')

@section('title')
	Random Page
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-8 same-H White h-minH">
					<br/>
					{{Form::open(array('route'=>'homes.post.random','id' => 'btnSubmit'))}}
					{{Form::label('option', 'Dispaly Randomize :')}}
					{{Form::select('option', $options, Input::old('option'), array('id' => 'cmbOption', 'class' => 'form-control', 'style' => 'width:auto;'))}}
					{{Form::close()}}

				<hr/>

					@if($type == 'playlist')
						@include('elements.home.randoms.playlist')
					@elseif($type == 'channel')
						@include('elements.home.randoms.channel')
					@else
						@include('elements.home.randoms.video')
					@endif
	
			</div>

			<div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
			<div class="same-H grey pad-s-10">
				<div>
					@include('elements/home/carouselAds')
				</div>
				<div class="mg-t-10">
					@include('elements/home/adverstisementSmall')
					
				</div>
			</div>
		</div>
		</div>
	</div>
@stop

@section('script')
	{{HTML::script('js/homes/random.js')}}
@stop