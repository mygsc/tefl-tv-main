

		<div class="White">

			<div class="col-md-12">
				<div class="row">
					<div class="div-coverDp">
						<div class="uploaded_img pic-Dp">
							@if(file_exists($picture))
			                	{{HTML::image('img/user/'.Auth::User()->id.'.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => 'pic-Dp'))}}
			                @else
			                	{{HTML::image('img/user/0.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => 'pic-Dp'))}}
			                @endif
			                <button data-target="#display_picture" data-toggle="modal" class="pull-right btn-ico btn-default dp-btn" title="Change Avatar"><i class="fa fa-pencil"></i></button>
						
		               	</div>
		               	<div>
							@if(file_exists(public_path('img/user/cover_photo/') . Auth::User()->id . '.jpg'))
								{{HTML::image('img/user/cover_photo/' . Auth::User()->id . '.jpg', 'alt', array('style' => 'z-index:70;', 'width' => '100%'))}}
							@else
								{{HTML::image('img/user/cover'. '.jpg', 'alt', array('style' => 'z-index:70;', 'width' => '100%'))}}
							@endif

						</div>

						<div class="div-coverP">

							<button data-target="#changeCoverPhoto" data-toggle="modal" class="pull-right btn-ico btn-default" title="Change cover photo"><i class="fa fa-pencil"></i></button>
							
							<div class="overlay-cover">

								<span class="infoCounts">
									<label>{{count($countSubscribers)}} Subscribers</label>
									<label>{{count($countVideos)}} Videos</label> &nbsp;
									<label>{{$countAllViews}} Views</label>
								</span>
								

								<span class="pull-right" >
									<span class="pull-right" >
										@if(empty($usersWebsite))
											<a href=""><i class="socialMedia socialMedia-facebook"></i></a>
											<a href=""><i class="socialMedia socialMedia-youtube"></i></a>
											<a href=""><i class="socialMedia socialMedia-twitter"></i></a>
											<a href=""><i class="socialMedia socialMedia-instagram"></i></a>
											<a href=""><i class="socialMedia socialMedia-googlePlus"></i></a>
											<a href=""><i class="socialMedia socialMedia-site"></i></a>
										@else
											<a href="http://{{$usersWebsite->facebook}}"><i class="socialMedia socialMedia-facebook"></i></a>
											<a href="http://{{$usersWebsite->twitter}}"><i class="socialMedia socialMedia-twitter"></i></a>
											<a href="http://{{$usersWebsite->instagram}}"><i class="socialMedia socialMedia-instagram"></i></a>
											<a href="http://{{$usersWebsite->gmail}}"><i class="socialMedia socialMedia-googlePlus"></i></a>
											<a href="http://{{$usersWebsite->others}}"><i class="socialMedia socialMedia-site"></i></a>
										@endif
									</span> 
								</span>	

							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="c-about" >
				<div class="labelThis mg-t--20">
					{{Auth::User()->channel_name}}
				</div>
				@if(empty($usersChannel->interests))
					<span class="pull-right"><b><i class="fa fa-cogs"></i>&nbsp;{{link_to_route('users.edit.channel', 'Account Setting')}}</b></span>
					<br/><br/>
					<p class="text-justify notes center-block"></p>
				@else
					<span class="pull-right"><b><i class="fa fa-cogs"></i>&nbsp;{{link_to_route('users.edit.channel', 'Account Setting')}}</b></span>
					<br/><br/>
					<p class="black center-block italic text-center fs-12">
						<i class="fa fa-quote-left"></i>
						{{ Str::limit($usersChannel->interests,300) }}
						<i class="fa fa-quote-right"></i>
					</p>
					<br/>
					@endif
					
			</div>
		</div>

@section('some_script')
	{{HTML::script('js/user/upload_image.js')}}
	{{HTML::script('js/user/modalclearing.js')}}
	{{HTML::script('js/user/upload_cover_photo.js')}}
@stop

@section('modal')
		<div class="modal fade overlay" id="changeCoverPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header text-center">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        {{Form::open(array('route' => 'users.upload.cover.photo', 'files' => true))}}
		      		<label class="fileContainer">
		      			<h3><u>Upload new channel cover</u></h3>
		      			{{Form::file('coverPhoto', array('id' => 'upload_cover_photo'))}}
		      		</label>
		      </div>
		      <div class="modal-body text-center">
		      @if(file_exists(public_path('img/user/cover_photo/') . Auth::User()->id . '.jpg'))
						{{HTML::image('img/user/cover_photo/' . Auth::User()->id . '.jpg', 'alt', array('id' => 'preview_cover_photo', 'style' => 'z-index:70;', 'width' => '100%'))}}
					@else
						{{HTML::image('img/user/cover.jpg', 'alt', array('id' => 'preview_cover_photo', 'style' => 'z-index:70;', 'width' => '100%'))}}
					@endif
		      </div>
		      <div class="modal-footer">
		        
		           	{{Form::submit('Save',array('class' => 'btn btn-info'))}}

		        {{Form::close()}}
		         	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		      </div>
		    </div>
		  </div>
		</div>


		<!-- Modal -->
		<div class="modal fade overlay" id="display_picture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog black ">
		    <div class="modal-content mod-change-dp text-center center-block">
		      <div class="modal-header">
		      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		       	{{Form::open(array('route' => ['users.upload.image', Auth::User()->id], 'files' => 'true', 'class'=> 'inline') )}}
			          	<label class="fileContainer">
			      			<h3 class="inline "><u>Upload new photo </u></h3>
			            {{ Form::file('image', array('id' => 'uploaded_img'))}}
			            </label>
		      </div>
		      <div class="modal-body">
		            <div class="text-center">
		            	@if(file_exists($picture))
		                {{HTML::image('img/user/' . Auth::User()->id . '.jpg', 'Image preview', array('id' => 'preview', 'class' => 'center-block change-Dp'))}}
		              @else
		              	{{HTML::image('img/user/0.jpg', 'Image preview', array('id' => 'preview', 'class' => 'center-block change-Dp'))}}
		              @endif
		            </div>            
		      </div>
		      <div class="modal-footer">
		        {{Form::submit("Save", array('class' => 'btn btn-info'))}}
		        {{Form::close()}}
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		      </div>
		    </div>
		  </div>
		</div>
@stop