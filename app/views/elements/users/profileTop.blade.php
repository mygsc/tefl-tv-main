<div class="White mg-b-20 same-H">
	<div class="col-md-12">
		<div class="row">
			<div class="div-coverDp ">
				<div class="uploaded_img pic-Dp same-H">
					{{HTML::image($usersImages['profile_picture'], 'alt', array('data-toggle' => 'modal', 'data-target' => '#change_profile_picture', 'class' => ''))}}

					<button data-target="#change_profile_picture" data-toggle="modal" class="pull-right btn-ico btn-default dp-btn" title="Change Avatar"><i class="fa fa-camera"></i></button>

				</div>
				<div>
					{{HTML::image($usersImages['cover_photo'], 'alt', array('style' => 'z-index:70;', 'width' => '100%'))}}

				</div>
				<div class="div-coverP">
					<div class="account-btn-sm visible-xs visible-sm">
						<span class="pull-right">
							<button data-target="#changeCoverPhoto" data-toggle="modal" class="btn-ico btn-default" title="Change cover photo"><i class="fa fa-camera"></i></button>
						</span>
					</div>
					<div class="overlay-wrap">
						<div class="row">
							<div class="col-md-6">
								<div class="labelThis">
									{{Auth::User()->channel_name}}
								</div>
							</div>
							<div class="col-md-6 col-sm-6 hidden-xs hidden-sm">
								<a href="{{ route('users.edit.channel')}}">
								<span class="pull-right">
									<span class="btn btn-info" style="padding:2px 5px!important;"><b><i class="fa fa-cog"></i> Account Settings</b></span>
									<button data-target="#changeCoverPhoto" data-toggle="modal" class="btn-ico btn-default" title="Change cover photo"><i class="fa fa-camera"></i></button>
								</span>
								</a>
							</div>
						</div>
						<div class="overlay-cover container visible-lg visible-md">
							<div class="col-md-6 hidden-xs">
								<div class="text-left chaCounts">
									<label>{{count($countSubscribers)}} Subscribers</label>
									<label>{{$countVideos}} Videos</label> &nbsp;
									<label>{{$countAllViews}} Views</label>
								</div>
							</div>
							<div class="col-md-6">
								<span class="pull-right" >
									
									@if(empty($usersWebsite))
									<p><small>Add your website or social media links.</small></p>
									@else
									@if(empty($usersWebsite->facebook))
									@else
									<a href="https://www.facebook.com/{{$usersWebsite->facebook}}" target="_blank"><i class="socialMedia socialMedia-facebook"></i></a>
									@endif

									@if(empty($usersWebsite->twitter))
									@else
									<a href="{{$usersWebsite->twitter}}" target="_blank"><i class="socialMedia socialMedia-twitter"></i></a>
									@endif

									@if(empty($usersWebsite->google))
									@else
									<a href="{{$usersWebsite->google}}" target="_blank"><i class="socialMedia socialMedia-googlePlus"></i></a>
									@endif

									@if(empty($usersWebsite->others))
									@else
									<a href="http://{{$usersWebsite->others}}" target="_blank"><i class="socialMedia socialMedia-site"></i></a>
									@endif
									@endif
								</span> 
							</div>
						</div>
					</div>
				

					
				</div>
			</div>
		</div>
	</div>
	<div class="user-info container">
		@if(empty($usersChannel->interests))
		
		<p class="black italic text-center fs-12 mg-t-20">
			<i class="fa fa-quote-left"></i>
			To promote your channel to subscribers, add your interests or description of your channel. <span class="" style="padding:2px 5px!important;"><small>{{link_to_route('users.edit.channel', 'Edit')}}<i class="fa fa-pencil"></i></small></span>
			<i class="fa fa-quote-right"></i>
		</p>
		@else
		<p class="black center-block italic text-center fs-12">
			<i class="fa fa-quote-left"></i>
			{{ Str::limit($usersChannel->interests,300) }}
			<i class="fa fa-quote-right"></i>
		</p>
		@endif

	</div>
</div>


@section('modal')
<div class="modal fade overlay" id="changeCoverPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{Form::open(array('route' => 'users.upload.cover.photo', 'files' => true,'id' => 'upload_cover_photo_form'))}}
				<label class="fileContainer">
					<h3><u>Upload new channel cover</u></h3>
					{{Form::file('coverPhoto', array('id' => 'upload_cover_photo'))}}
				</label>
			</div>
			<div class="modal-body text-center">
				{{HTML::image($usersImages['cover_photo'], 'alt', array('id' => 'preview_cover_photo', 'style' => 'z-index:70;', 'width' => '100%'))}}
				<b><span id="upload-message-cover"></span></b>
					<div id="wrapper-cover">
						<div id="progressbar-loaded-cover" class="text-center">
							<b><span id="percentage-cover"></span></b>
						</div>
					</div>
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
<div class="modal fade overlay" id="change_profile_picture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog black ">
		<div class="modal-content mod-change-dp text-center center-block">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{Form::open(array('route' => ['users.upload.image', Auth::User()->id], 'files' => 'true', 'class'=> 'inline', 'id' => 'upload_profile_picture') )}}
				<label class="fileContainer">
					<h3 class="inline "><u>Upload new photo </u></h3>
					{{ Form::file('image', array('id' => 'uploaded_img'))}}
				</label>
			</div>
			<div class="modal-body">
				<div class="text-center">
					{{HTML::image($usersImages['profile_picture'], 'Image preview', array('id' => 'preview', 'class' => 'center-block change-Dp'))}}
					<b><span id="upload-message"></span></b>
					<div id="wrapper">
						<div id="progressbar-loaded" class="text-center">
							<b><span id="percentage"></span></b>

						</div>
					</div>
				</div>            
			</div>
			<div class="modal-footer">
				{{Form::submit("Update", array('class' => 'btn btn-info'))}}
				{{Form::close()}}
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
@stop
