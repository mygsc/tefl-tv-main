		<div class="White Div-channel-border">
			<div class="col-md-12">
				<div class="row">
					<div class="div-coverDp">
						<div class="uploaded_img pic-Dp">


						 				@if(file_exists($picture))
		                {{HTML::image('img/user/'.$userChannel->id.'.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => 'pic-Dp'))}}
		                @else
		                {{HTML::image('img/user/0.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => 'pic-Dp'))}}
		                @endif
		                <button data-target="#display_picture" data-toggle="modal" class="pull-right btn-ico btn-default dp-btn" title="Change Avatar"><i class="fa fa-pencil"></i></button>
		               </div>

						@if(file_exists(public_path('img/user/cover_photo/' .$userChannel->id. '.jpg')))
							{{HTML::image('img/user/cover_photo/' . $userChannel->id . '.jpg', 'alt', array('style' => 'z-index:70;', 'width' => '100%'))}}
						@else
							{{HTML::image('img/user/cover.jpg', 'alt', array('style' => 'z-index:70;', 'width' => '100%'))}}
						@endif
						<div class="div-coverP">

							

							<div class="overlay-cover">user
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
										&nbsp;
		 								@if($user_id)
											{{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
								    			{{Form::hidden('user_id',$userChannel->id)}}
								    			{{Form::hidden('subscriber_id', $user_id)}}
								    			@if(!$ifAlreadySubscribe)
								    				{{Form::hidden('status','subscribeOn')}}
											    	{{Form::submit('Subscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
											    @else
											    	{{Form::hidden('status','subscribeOff')}}
											    	{{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary pull-right', 'id'=>'subscribebutton'))}}
											    @endif
								    		{{Form::close()}}
										@else
											{{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary pull-right')); }}
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
					{{$userChannel->channel_name}}
				</div>
				@if(empty($userChannel->interests))
					<br/><br/>
					<p class="text-justify notes center-block"></p>
				@else
					<p class="text-justify notes center-block">
					<br/>
					"{{ Str::limit($userChannel->userprofile->interests, 200) }}"
					</p>
				@endif
			</div>
		</div>

@section('some_script')
	{{HTML::script('js/user/upload_image.js')}}
	{{HTML::script('js/user/modalclearing.js')}}
@stop

@section('modal')
		<div class="modal fade overlay" id="changeCoverPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Update Cover Photo</h4>
		      </div>
		      <div class="modal-body text-center">
		      	<div style="margin-left:auto; margin-right:auto;" >
		      		{{Form::open(array('route' => 'users.upload.cover.photo', 'files' => true))}}
		      		<label class="fileContainer" style="margin-left:auto;">
		      			<img src="/img/icons/upload.png"/>
		      			{{Form::file('coverPhoto')}}
		      		</label>
		      	</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		           	{{Form::submit('Save',array('class' => 'btn btn-primary'))}}
		        {{Form::close()}}
		      </div>
		    </div>
		  </div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="display_picture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog black">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        {{Form::open(array('route' => ['users.upload.image', $userChannel->id], 'files' => 'true'))}}
		        {{ Form::file('image', array('id' => 'uploaded_img'))}}
		      </div>
		      <div class="modal-body">
		            <div>
		                {{HTML::image('img/user/' . $userChannel->id . '.jpg', 'Nothing to display.', array('id' => 'preview', 'class' => 'center-block'))}}
		            </div>            
		      </div>
		      <div class="modal-footer">
		        {{Form::submit("Save", array('class' => 'btn btn-info'))}}
		        {{Form::close()}}
		        <button type="button" class="btn btn-unSub" data-dismiss="modal">Cancel</button>
		      </div>
		    </div>
		  </div>
		</div>
@stop