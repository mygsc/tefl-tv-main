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


@section('script')
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/modalclearing.js')}}
@stop