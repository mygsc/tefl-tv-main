@extends('layouts.default')

@section('content')


<div class="container page">
	<br/>
	<div class="row">
		<div style="border:5px solid #8b9dc1;" class="shadow">
			<div class="col-md-2 hidden-xs">
				<div class="row">
					{{HTML::image('img/user/'.Auth::User()->id . '.jpg', 'alt', array('class' => 'pic-Dp'))}}
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">

					<div class="" style="background-image:url(/img/user/cover.jpg); height:224px;">
						<div class="">
							<div class="overlay-cover">
								<span class="infoCounts">
									<label>12k Subscribers</label>
									<label>100 Videos</label> &nbsp;
									<label>13k Views</label>
								</span>
								

								<span class="pull-right" >

									<a href=""><img src="/img/icons/fb.png"></a>
									<a href=""><img src="/img/icons/tr.png"></a>
									<a href=""><img src="/img/icons/gp.png"></a>
									<a href=""><img src="/img/icons/yt.png"></a>
									<a href=""><img src="/img/icons/wl.png"></a>
 	
									<button class="btn btn-primary" style="margin-top:5px;">Subscribe</button>
								</span>	
							</div>
						</div>	
					</div>
				</div>
			</div>



			
			<div class="c-about" style="padding:10px 10px;margin-top:0;">
				<div class="labelThis">
					{{Auth::User()->channel_name}}
				</div>
				<ul class="nav nav-tabs" role="tablist inline">
			    	<li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab"><small>About</small></a></li>
			    	<li role="presentation" class=""><a href="#learn" aria-controls="learn" role="tab" data-toggle="tab"><small>Learn More</small></a></li>
				</ul>
				<div class="tab-content inline">
			  	<div role="tabpanel" class="tab-pane active" id="about">
						<div class="" style="margin-top:20px;">
							<p>
								{{$usersChannel->interests}}
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="learn">
						<div class="" style="margin-top:20px;">
							Fullname: {{$usersChannel->first_name}} {{$usersChannel->last_name}}
							<br>
							Websites: {{Auth::User()->website}}
							<br>
							Organizations: {{Auth::User()->organiztion}}
							<br>
							Work: {{$usersChannel->work}}
							<br>
							Birthdate: {{$usersChannel->birthdate}}
							<br>
							Contact Number: {{$usersChannel->contact_number}}
							<br>
							Address: {{$usersChannel->address}}
							<br>
							City: {{$usersChannel->city}}
							<br>
							State: {{$usersChannel->state}}
							<br>
							Zip Code: {{$usersChannel->zip_code}}
							<br>
							Country: {{$usersChannel->country_id}}
						</div>
					</div>
				</div>

			</div>
		</div>
		<br/>
		<div class="shadow Div-channel-border">

			<div role="tabpanel">
			  <!-- Nav tabs -->
			 	<ul class="nav nav-tabs" role="tablist">
			    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
			    	<li role="presentation"><a href="#Videos" aria-controls="Videos" role="tab" data-toggle="tab">Videos</a></li>
			    	<li role="presentation"><a href="#MyFavorites" aria-controls="MyFavorites" role="tab" data-toggle="tab">My Favorites</a></li>
			    	<li role="presentation"><a href="#WatchLater" aria-controls="WatchLater" role="tab" data-toggle="tab">Watch Later</a></li>
			  		<li role="presentation"><a href="#Playlists" aria-controls="Playlists" role="tab" data-toggle="tab">Playlists</a></li>
			  		<li role="presentation"><a href="#Feedbacks" aria-controls="Feedbacks" role="tab" data-toggle="tab">Feedbacks</a></li>
			  		<li role="presentation"><a href="#Subscribers" aria-controls="Subscribers" role="tab" data-toggle="tab">Subscribers</a></li>
			  		<li role="presentation"><a href="#Subscriptions" aria-controls="Subscriptions" role="tab" data-toggle="tab">Subscriptions</a></li>
			  	</ul><!--tabNav-->

			  	<!-- Tab panes -->
			    <div class="tab-content">
				  	<div role="tabpanel" class="tab-pane active" id="home">
						@include('elements/users/myChannelTabs/tab-Home')
				  	</div>
				    <div role="tabpanel" class="tab-pane" id="Videos">
				    	Videos
				    </div>
				    <div role="tabpanel" class="tab-pane" id="MyFavorites">
				    	My Favorites
				    </div>
				    <div role="tabpanel" class="tab-pane" id="WatchLater">
				    	Watch Later
				    </div>
				    <div role="tabpanel" class="tab-pane" id="Playlists">
				    	Playlists
				    </div>
				    <div role="tabpanel" class="tab-pane" id="Feedbacks">
				    	Feedbacks
				    </div>
				    <div role="tabpanel" class="tab-pane" id="Subscribers">
				    	Subscribers
				    </div>
				    <div role="tabpanel" class="tab-pane" id="Subscriptions">
				    	Subscriptions
				    </div>
			  </div><!--/.tab-content-->

			</div><!--/.tabpanel-->
				
		</div>
	</div><!--/.contentpadding-->
	<br/>
</div><!--/.container page-->

@stop




	
@stop
