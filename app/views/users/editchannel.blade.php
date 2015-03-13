@extends('layouts.default')


@section('content')
<div class="row White">
  <div class="container pageH">
      <br/>

      <div class="">
         <div class="wrapper-account">
              <div class="well White " style="margin-bottom:0;min-height:350px;">
                 <div class="row">

                      <!-- tabs left -->
                      <div class="tabbable tabs-left">
                          <br/><br/>
                          <ul class="nav nav-tabs" style="margin-left:-20px">
                            <li class="active">{{link_to_route('users.edit.channel', 'Account Setting', Auth::User()->channel_name)}}</li>
                            <li >{{ link_to_route('users.change-password', 'Change Password', null) }}</li>
                            <li class="">{{ link_to_route('users.change-email', 'Change Email', null) }}</li>
                          </ul>

                          <div class="tab-content">
                              <div class="tab-pane active" id="updateAccount">
                                  @include('elements/users/accountSettingTabs/tab-editInfo')
                              </div>
                          </div><!--/.tabContent-->
                      </div><!--/.tabbable tabs-left-->
                  </div><!--/.row-->
              </div><!--/.well-->
          </div><!--/.wrapperAccount-->
          <br/>
      </div><!--/.col-md-12-->
  </div><!--/.container row-->
</div>
@stop

<!-- Modal -->
<div class="modal fade" id="display_picture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog black">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{Form::open(array('route' => ['users.upload.image', Auth::User()->id], 'files' => 'true'))}}
        	{{ Form::file('image', array('id' => 'uploaded_img'))}}

      </div>
      <div class="modal-body">
     		<div class="uploaded_img">
        		{{HTML::image('img/user/' . Auth::User()->id . '.jpg', 'Nothing to display.', array('id' => 'preview', 'class' => 'center-block'))}}
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

@section('script')
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/modalclearing.js')}}
@stop