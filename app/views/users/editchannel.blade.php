@extends('layouts.default')


@section('content')
<div class="row White">
  <div class="container pageH">
      <br/>

      <div class="">
         <div class="Div-channel-border">
              <div class="well White " style="margin-bottom:0;min-height:350px;">
                <div class="row">
                  <br/>
                  <div class="text-center">
                    <span class="active"><b>{{link_to_route('users.edit.channel', 'Account Setting', Auth::User()->channel_name)}}</b></span>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <span>{{ link_to_route('users.change-password', 'Change Password', null) }}</span>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <span class="">{{ link_to_route('users.change-email', 'Change Email', null) }}</span>
                  </div>



                  @include('elements/users/accountSettingTabs/tab-editInfo')

                         
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