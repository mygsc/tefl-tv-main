		<div style="border:5px solid #e3e3e3;" class="White">
		
			<div class="col-md-12">
				<div class="row">
					<div class="" style="height:224px;overflow:hidden;">
						<div class="uploaded_img pic-Dp">

						 				@if(file_exists($picture))
		                {{HTML::image('img/user/'.$userChannel->id.'.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => 'pic-Dp'))}}
		                @else
		                {{HTML::image('http://www.fm-base.co.uk/forum/attachments/football-manager-2014-manager-stories/618828d1403554937-ups-downs-building-one-default_original_profile_pic.png'. '.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => ''))}}
		                @endif
		                <button data-target="#display_picture" data-toggle="modal" class="pull-right btn-ico btn-default dp-btn" title="Change Avatar"><i class="fa fa-pencil"></i></button>
						
		               </div>

						@if(file_exists(public_path('img/user/cover_photo/' .$userChannel->id. '.jpg')))
							{{HTML::image('img/user/cover_photo/' . $userChannel . '.jpg', 'alt', array('style' => 'z-index:70;', 'width' => '100%'))}}
						@else
							{{HTML::image('cover'. '.jpg', 'alt', array('class' => 'pic-Dp'))}}
						@endif
						<div class="" style="position:absolute;z-index:80;top:0;height:100%;width:100%;">

							<button data-target="#changeCoverPhoto" data-toggle="modal" class="pull-right btn-ico btn-default" title="Change cover photo"><i class="fa fa-pencil"></i></button>

							<div class="overlay-cover">
								<span class="infoCounts">
									<label> Subscribers</label>
									<label> Videos</label> &nbsp;
									<label> Views</label>
								</span>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="c-about" >
				<div class="labelThis" style="margin-top:-20px;">
					{{$userChannel->channel_name}}
				</div>
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