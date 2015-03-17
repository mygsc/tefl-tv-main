		<div style="border:5px solid #e3e3e3;" class="White">
		
			<div class="col-md-12">
				<div class="row">

					<div class="" style="height:224px;overflow:hidden;">
						<div class="uploaded_img">
						{{HTML::image('img/user/'.Auth::User()->id . '.jpg', 'alt', array('class' => 'pic-Dp'))}}
						</div>
						<img src="/img/user/cover.jpg" style="x-index:70;">
						<div class="" style="position:absolute;z-index:80;top:0;height:100%;width:100%;">
							<div class="overlay-cover">

								<span class="infoCounts">
									<label>{{count($countSubscribers)}} Subscribers</label>
									<label>{{count($countVideos)}} Videos</label> &nbsp;
									<label>{{$countAllViews}} Views</label>
								</span>
								

								<span class="pull-right" >
									<span class="pull-right" >
										<a href=""><i class="socialMedia socialMedia-facebook"></i></a>
										<a href=""><i class="socialMedia socialMedia-youtube"></i></a>
										<a href=""><i class="socialMedia socialMedia-twitter"></i></a>
										<a href=""><i class="socialMedia socialMedia-instagram"></i></a>
										<a href=""><i class="socialMedia socialMedia-googlePlus"></i></a>
										<a href=""><i class="socialMedia socialMedia-site"></i></a>
									</span> 
								</span>	

							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="c-about" >
				<div class="labelThis" style="margin-top:-20px;">
					{{Auth::User()->channel_name}}
				</div>
				<span class="pull-right"><b><i class="fa fa-cogs"></i>&nbsp;{{link_to_route('users.edit.channel', 'Account Setting', Auth::User()->channel_name)}}</b></span>
			</div>
		</div>