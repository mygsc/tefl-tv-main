@extends('layouts.default')


@section('content')
<div class="row">
  <div class="container">
      <br/>
      <div class="row">
         <div class="">
              <div class="well White div-change same-H">
                <div class="row">
                  <div class="text-center">
                        <span class=""><i class="fa fa-arrow-left blueC"></i> {{link_to_route('users.channel', 'Channel Home')}}</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <span class="active"><b>{{link_to_route('users.edit.channel', 'Account Setting')}}</b></span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <span>{{ link_to_route('users.change-password', 'Change Password', null) }}</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <span class="">{{ link_to_route('users.change-email', 'Change Email', null) }}</span>
                        <br/>
                    </div>
                    <!--<div id="status">
                     <button onclick="Login()"/>Connect with Facebook
                 </div>
                 <br/><br/> br/><br/><br/>
                 <div id="message">
                     Logs:<br/>
                 </div>
                 <br/>
                 <br/>
                 <a href='#' onClick='gmailLogin();' id="loginText"> Click here to login </a>
                 <a href="#" style="display:none" id="logoutText" target='myIFrame' onclick="myIFrame.location='https://www.google.com/accounts/Logout'; startLogoutPolling();return false;"> Click here to logout </a>
                 <iframe name='myIFrame' id="myIFrame" style='display:none'></iframe>
                 <div id='uName'></div>
                 <img src='' id='imgHolder'/>
                  </div>-->
                        {{Form::open(array('route' => ['users.post.edit.channel', Auth::User()->channel_name]))}}   
                        <div class="textbox-layout"> 

                            <!--<small class="notes"><b>Notes: </b>
                                Deactivate your account if you don't want your channel to be seen by others. All fields with asterisk (*) are required. Check all information you want to show in public.</small>
                                <select class="form-control autoW">    
                                    <option disabled>Account Privacy</option>
                                    <option>Activate</option>
                                    <option>Deactivate</option>
                                </select>
                            <!--show this when deactivate is selected-->
                            <br/><br/>
                            <div class="col-md-12 grey">
                                <h3 class="orangeC text-center">-Interests-</h3>
                                <div class="well2">

                                    {{Form::textarea('interests',$userChannel->interests, array('placeholder' => 'Interests', 'style' => 'min-height:150px;'))}}
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <h3 class="orangeC text-center">-Personal Information-</h3>
                                <div class="well2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{Form::label('first_name', '*Firstname: ')}}
                                            <span class="inputError">{{$errors->first('first_name')}}</span>
                                            {{ Form::text('first_name',$userChannel->first_name, array('placeholder' => 'Firstname'))}}
                                        </div>
                                        <div class="col-md-6">

                                            {{Form::label('last_name', '*Lastname: ')}}
                                            <span class="inputError">{{$errors->first('last_name')}}</span>
                                            {{ Form::text('last_name', $userChannel->last_name, array('placeholder' => 'Lastname'))}}
                                        </div>
                                    </div>

                                    {{Form::label('birthdate', '*Birthdate: ')}}
                                    <span class='inputError'>{{$errors->first('birthdate')}}</span>
                                    {{Form::text('birthdate', $userChannel->birthdate, array('placeholder' => 'Birthdate'))}}

                                    {{Form::label('organization', '*Organization: ')}}
                                    <span class="inputError">{{$errors->first('organization')}}</span>
                                    {{Form::text('organization', Auth::User()->organization, array('placeholder' => 'Organization'))}}

                                    {{Form::label('work', 'Work: ')}}
                                    {{Form::text('work', $userChannel->work, array('placeholder' => 'Work'))}}
                                </div>
                             </div>
                            <div class="col-md-12 grey">
                                <h3 class="orangeC text-center">-Contact Information-</h3>
                                <div class="well2">
                                    @if(empty($userWebsite)) 

                                        {{ Form::label('contact_number', '*Contact Number: ')}}
                                        <span class="inputError"> {{$errors->first('contact_number')}}</span> 
                                        {{ Form::text('contact_number', $userChannel->contact_number, array('placeholder' => 'Contact Number'))}}

                                        {{Form::label('website', 'Website: ')}} 
                                        {{Form::text('website', Auth::User()->website, array('placeholder' => 'Website'))}}

                                        {{Form::label('gmail', 'Gmail: ')}}
                                        {{Form::text('gmail', null, array('placeholder' => 'Gmail Account'))}}

                                        {{Form::label('facebook', 'Facebook: ')}}       
                                        {{Form::text('facebook', null, array('placeholder' => 'Facebook Account'))}}


                                        {{Form::label('twitter', 'Twitter: ')}}
                                        {{Form::text('twitter', null, array('placeholder' => 'Twitter Account'))}}

                                        {{Form::label('instagram', 'Instagram: ')}}
                                        {{Form::text('instagram', null, array('placeholder' => 'Instagram Account'))}}      
                                    @else
                        
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div id="status" class="text-left connectTo c-fb">
                                                    <img src="/img/icons/c-fb.jpg"> <button onclick="Login()" class="btn-connect">Connect with Facebook</button>
                                                </div>  
                                            </div>
                                             <div class="col-md-10">
                                                {{Form::text('facebook', $userWebsite->facebook, array('placeholder' => 'Facebook Account', 'disabled'))}}
                                            </div>
                                        </div>
                                       	<br/>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="text-left connectTo c-tr">
                                                    <img src="/img/icons/c-tr.jpg"> <button onclick="getConnectionWithAccessToken()" class="btn-connect">Connect with Twitter</button>
                                                </div>  
                                            </div>
                                            <div class="col-md-10">
                                                {{Form::text('twitter', $userWebsite->twitter, array('placeholder' => 'Twitter Account', 'disabled'))}}
                                            </div>
                                        </div>
        
                                        <br/>
          
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="text-left connectTo c-ig">
                                                    <img src="/img/icons/c-ig.jpg"> <button onclick="Login()" class="btn-connect">Connect with Twitter</button>
                                                </div>  
                                            </div>
                                            <div class="col-md-10">
                                                {{Form::text('instagram', $userWebsite->instagram, array('placeholder' => 'Instagram Account', 'disabled'))}}
                                            </div>
                                        </div>
                                        <br/>
           
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="text-left connectTo c-gp">
                                                    <img src="/img/icons/c-gp.jpg"> <button onclick="Login()" class="btn-connect">Connect with Twitter</button>
                                                </div>  
                                            </div>
                                            <div class="col-md-10">
                                                 {{Form::text('gmail', $userWebsite->gmail, array('placeholder' => 'Gmail Account', 'disabled'))}}
                                            </div>
                                        </div>
                                       
                                        <br/>
                                        {{Form::label('others', 'Other Websites: ')}}
                                        {{Form::text('others', $userWebsite->others, array('placeholder' => 'Other Website Accounts'))}}
                                          {{ Form::label('contact_number', '*Contact Number: ')}}
                                        <span class="inputError"> {{$errors->first('contact_number')}}</span> 
                                        {{ Form::text('contact_number', $userChannel->contact_number, array('placeholder' => 'Contact Number'))}}

                                    @endif

                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <h3 class="orangeC text-center">-Address-</h3>
                                <div class="well2">
                                    {{Form::label('zip_code', 'Zip Code: ')}}
                                    {{Form::text('zip_code', $userChannel->zip_code, array('placeholder' => 'Zip Code'))}}
                                    <br/>
                                    {{Form::label('country', 'Country: ')}}
                                    {{Form::text('country', $userChannel->country_id, array('placeholder' => 'Country'))}}
                                </div>
                            </div>
                            <div class="text-right col-md-12">
                                <br/><br/>
                                {{Form::submit('Save Changes', array('class' => 'btn btn-info'))}}
                            </div>
                            {{ Form::close()}}
                        </div>
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