<div style="border:5px solid #e3e3e3;" class="White">
			<div class="col-md-2 hidden-xs">
				<div class="row">
					<div class="uploaded_img">
						{{HTML::image('img/user/'.Auth::User()->id . '.jpg', 'alt', array('class' => 'pic-Dp'))}}
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">

					<div class="" style="background-image:url(/img/user/cover.jpg); height:224px;">
						<div class="">
							<div class="overlay-cover">
								<div class="col-md-6 pull-left">
									<span class="infoCounts">
										<label>{{count($countSubscribers)}} Subscribers</label>
										<label>100 Videos</label> &nbsp;
										<label>13k Views</label>
									</span>
								</div>
									
								<div class="col-md-6">
									<span class="pull-right" >
										<a href=""><i class="socialMedia socialMedia-facebook"></i></a>
										<a href=""><i class="socialMedia socialMedia-youtube"></i></a>
										<a href=""><i class="socialMedia socialMedia-twitter"></i></a>
										<a href=""><i class="socialMedia socialMedia-instagram"></i></a>
										<a href=""><i class="socialMedia socialMedia-googlePlus"></i></a>
										<a href=""><i class="socialMedia socialMedia-site"></i></a>
									</span>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="c-about" >
				<div class="labelThis" style="margin-top:-20px;">
					{{Auth::User()->channel_name}}
				</div>

				<ul class="nav nav-tabs" role="tablist inline">
					<li class="pull-right"><b><i class="fa fa-cogs"></i>&nbsp;{{link_to_route('users.edit.channel', 'Account Setting', Auth::User()->channel_name)}}</b></li>
			    	<li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab"><small>About</small></a></li>
			    	<li role="presentation" class=""><a href="#learn" aria-controls="learn" role="tab" data-toggle="tab"><small>Learn More</small></a></li>
				</ul>
				<div class="tab-content inline">
			  		<div role="tabpanel" class="tab-pane active" id="about">
						<div class="" style="margin-top:20px;">
							<p class="text-justify">
								{{$usersChannel->interests}}
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="learn">
						<div class="row" style="margin-top:20px;">
							<div class="col-md-4">
								<table class="tableLayout">
									<tr>
										<td><small><label>Name</label></small> </td>
										<td><b>:</b></td>
										<td>{{$usersChannel->first_name}} {{$usersChannel->last_name}}</td>
									</tr>
									<tr>
										<td><small><label>Birthdate</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->birthdate}}</td>
									</tr>
									<tr>
										<td><small><label>Organizations</label></small></td>
										<td><b>:</b></td>
										<td>{{Auth::User()->organiztion}}</td>
									</tr>
									<tr>
										<td><small><label>Work</label></small></td>
										<td><b>:</b></td>
										<td>{{Auth::User()->organiztion}}</td>
									</tr>
								</table>
							</div>
							<div class="col-md-4">
								<table class="tableLayout">
									<tr>
										<td><small><label>Email</label></small> </td>
										<td><b>:</b></td>
										<td></td>
									</tr>
									<tr>
										<td><small><label>Website</label></small></td>
										<td><b>:</b></td>
										<td>{{Auth::User()->website}}</td>
									</tr>
									<tr>
										<td><small><label>Contact Number</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->contact_number}}</td>
									</tr>
									<tr>
										<td><small><label>Address</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->address}}</td>
									</tr>
								</table>
							</div>
							<div class="col-md-4">
								<table class="tableLayout">
									<tr>
										<td><small><label>City</label></small> </td>
										<td><b>:</b></td>
										<td>{{$usersChannel->city}}</td>
									</tr>
									<tr>
										<td><small><label>State</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->state}}</td>
									</tr>
									<tr>
										<td><small><label>Zip Code</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->zip_code}}</td>
									</tr>
									<tr>
										<td><small><label>Country</label></small></td>
										<td><b>:</b></td>
										<td>{{$usersChannel->country_id}}</td>
									</tr>
								</table>
							</div>
						</div>
					</div><!--/.tabpanel-->
				</div>
			</div>
		</div>