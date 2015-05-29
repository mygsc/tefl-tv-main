@extends('layouts.default')

@section('content')
<div class='container'>
	

	<div class="col-md-9 White same-H">
		<h1>About TEFL TV</h1>
		<!--about us content-->
		<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>

		<br/>

		<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>

		<br/>

		<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat.
		</p>
		<!--/about us-->

		<!--contact us section-->
		<div class="col-md-12">
			<hr/>
			<h1>Contact Us <br/>
				<small>We would like to hear from you, connect and communicate with us through the following information</small>
			</h1>
			<br/>
			<div class="row">
				<div class="gMapAlt">
					<iframe src="https://www.google.com/maps/embed?pb=!1m19!1m12!1m3!1d3691.804362584677!2d114.15436199999999!3d22.285399500000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m4!3e6!4m0!4m1!2s9B%2C+Amtel+Building%2C++148+Des+Voeux+Road+Central%2C++Central+Hongkong!5e0!3m2!1sen!2sph!4v1432802903442"  class="gMapAlt"></iframe>

				</div>
				<br/>
				{{Form::open(array('route' => 'post.homes.aboutus'))}}
				<span class="textbox-layout">
					{{ Form::text('name', '', array('placeholder' => 'Name' , 'class' => 'form-control')); }}
					@if($errors->has('name'))
					<span class="inputError">
						{{$errors->first('name')}}
					</span>
					@endif
					{{ Form::text('email', '', array('placeholder' => 'Email' , 'class' => 'form-control')); }}
					@if($errors->has('email'))
					<span class="inputError">
						{{$errors->first('email')}}
					</span>
					@endif
					{{ Form::textarea('message', '', array('placeholder' => 'Message', 'class' => 'textAreaContact form-control')); }}
					@if($errors->has('message'))
					<span class="inputError">
						{{$errors->first('message')}}
					</span>
					@endif
				</span>
				<div class="text-right">
					{{ Form::submit('Submit', array('class' => 'btn btn-primary'))}}
					{{Form::close()}}
				</div>
				<br/>

			</div><!--/.row-->
		</div><!--/.col-md-12-->
		<!--/contact us-->

	</div><!--/.col-md-9-->
	<div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
		<div class="same-H grey pad-s-10">
			@include('elements/home/categories')
			<div>
				@include('elements/home/carouselAds')
			</div>
			<div class="mg-t-10">
				@include('elements/home/adverstisementSmall')
				
			</div>
		</div>
	</div>


</div><!--/.container page-->

@stop

@section('script')
{{HTML::script('js/dynamicContent.js')}}
@stop