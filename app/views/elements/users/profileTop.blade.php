		<div style="border:5px solid #e3e3e3;" class="White">
		
			<div class="col-md-12">
				<div class="row">

					<div class="" style="height:224px;overflow:hidden;">
						<div class="uploaded_img">
						@if(file_exists(public_path('img/user/') . Auth::User()->id . '.jpg'))
						{{HTML::image('img/user/'.Auth::User()->id . '.jpg', 'alt', array('class' => 'pic-Dp'))}}
						@else
						{{HTML::image('http://www.fm-base.co.uk/forum/attachments/football-manager-2014-manager-stories/618828d1403554937-ups-downs-building-one-default_original_profile_pic.png'. '.jpg', 'alt', array('class' => 'pic-Dp'))}}
						@endif
						</div>
						@if(file_exists(public_path('img/user/cover_photo/') . Auth::User()->id . '.jpg'))
							{{HTML::image('img/user/cover_photo/' . Auth::User()->id . '.jpg', 'alt', array('style' => 'x-index:70;', 'width' => '100%'))}}
						@else
							{{HTML::image('cover'. '.jpg', 'alt', array('class' => 'pic-Dp'))}}
						@endif
						<div class="" style="position:absolute;z-index:80;top:0;height:100%;width:100%;">
							<div class="overlay-cover">

								<span class="infoCounts">
									<label>{{count($countSubscribers)}} Subscribers</label>
									<label>{{count($countVideos)}} Videos</label> &nbsp;
									<label>{{$countAllViews}} Views</label>
									<button data-target="#changeCoverPhoto" data-toggle="modal">asdasd</button>
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

<div class="modal fade" id="changeCoverPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        {{Form::open(array('route' => 'users.upload.cover.photo', 'files' => true))}}
        	{{Form::file('coverPhoto')}}
        	{{Form::submit('Change Cover Photo')}}
        {{Form::close()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>