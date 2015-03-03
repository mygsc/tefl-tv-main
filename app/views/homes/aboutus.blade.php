@extends('layouts.default')

@section('content')
	<div class='container page'>
		
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
					<div class="row">
						<BR/>
						<div class="col-md-4">
							<h4 class="inline">
								<span style="background:#80a8ff;" class="snBg">
									<img src="/img/icons/fb_b.png" class="hand sn" title="Like us on Facebook"> 2k
								</span>
								<span class="snCount" style="border:1px solid #80a8ff;">
									&nbsp;Like us on Facebook&nbsp;
								</span>
							</h4>
						</div>
						<div class="col-md-4 text-center">
							<h4 class="inline">
								<span style="background:#ff7866;" class="snBg"> 
									<img src="/img/icons/gp_b.png" class="hand" title="Google Plus Follower+"> 1k
								</span>
								<span class="snCount" style="border:1px solid #ff7866;">
									&nbsp;Follow us on Google+
								</span>
							</h4>

						</div>
						<div class="col-md-4 text-right">
							<h4 class="inline">
								<span style="background:#66ccff;" class="snBg">
									<img src="/img/icons/tr_b.png" class="hand" title="Google Plus Follower+"> 3k
								</span>
								<span class="snCount" style="border:1px solid #66ccff;">
									&nbsp;Follow us on Twitter &nbsp;
								</span>
							</h4>
						</div>
					</div>
					<br/>
					{{ Form::text('name', '', array('placeholder' => 'Name' , 'class' => 'form-control')); }}
					{{ Form::text('email', '', array('placeholder' => 'Email' , 'class' => 'form-control')); }}
					{{ Form::textarea('message', '', array('placeholder' => 'Message', 'class' => 'textAreaContact' , 'class' => 'form-control')); }}
					<button class="btn btn-primary pull-right">Submit</button>
					<br/>

				</div><!--/.row-->
			</div><!--/.col-md-12-->
			<!--/contact us-->

		</div><!--/.col-md-9-->

		<div class="col-md-3">
			<div class="sideLinksDiv2">
				@include('elements/home/sideNav')
				@include('elements/home/adverstisementSmall')
				@include('elements/home/carouselAds')	
				@include('elements/home/recommendedChannelList')
			</div>
		</div><!--/.col-3 right section navigations-->

	</div><!--/.container page-->
@stop