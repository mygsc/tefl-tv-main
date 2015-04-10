@extends('layouts.default')

@section('content')
	<div class='container page'>
		<div class="col-md-3">
			<div class="row">
			<br/>
				<div class="same-H">
					<div class="">
						@include('elements/home/sideNav')
						@include('elements/home/adverstisementSmall')
						<br/>
						@include('elements/home/carouselAds')	

					</div>
				</div>
			</div>
		</div><!--/.col-3 right section navigations-->

		<div class="col-md-9">
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
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1461.0549223360788!2d-85.75507619999998!3d42.91272430000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8819b06fecb194fd%3A0x9e91004f0a34d58f!2s2885+Sanford+Ave+SW%2C+Grandville%2C+MI+49418%2C+USA!5e0!3m2!1sen!2sph!4v1424049361913" class="gMapAlt"></iframe>
					</div>
					<br/>
					<span class="textbox-layout">
					{{ Form::text('name', '', array('placeholder' => 'Name' , 'class' => 'form-control')); }}
					{{ Form::text('email', '', array('placeholder' => 'Email' , 'class' => 'form-control')); }}
					{{ Form::textarea('message', '', array('placeholder' => 'Message', 'class' => 'textAreaContact' , 'class' => 'form-control')); }}
					</span>
					<button class="btn btn-primary pull-right">Submit</button>
					<br/>

				</div><!--/.row-->
			</div><!--/.col-md-12-->
			<!--/contact us-->

		</div><!--/.col-md-9-->

		

	</div><!--/.container page-->

@stop

@section('script')
	{{HTML::script('js/dynamicContent.js')}}
@stop