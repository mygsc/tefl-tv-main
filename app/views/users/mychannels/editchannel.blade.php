@extends('layouts.default')


@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="row">
    <div class="container">
    	<br/>
        <ul class="nav nav-tabs hidden-sm hidden-xs White same-H text-center" role="tablist">
            <li role="presentation"> {{link_to_route('users.channel', 'Back to Channel Home')}}</li>
            <li role="presentation" class="active">{{link_to_route('users.edit.channel', 'Update Profile')}}</li>
            <li role="presentation" >{{ link_to_route('users.change-password', 'Change Password', null) }}</li>
            <li role="presentation" >{{ link_to_route('users.change-email', 'Change Email', null) }}</li>
            @if(Auth::User()->role == '3' || Auth::User()->role == '4' || Auth::User()->role == '5')
            <li role="presentation">{{ link_to_route('users.earnings.settings', 'Earnings Settings', null) }}</li>
            @endif
            <li role="presentation">{{ link_to_route('users.deactivate', 'Deactivate TEFL TV account', null) }}</li>
        </ul><!--tabNav-->
        {{Form::open(array('route' => ['users.post.edit.channel', Auth::User()->channel_name]))}}
        <div class="col-md-12 top-div_t mg-t-20">
            <h3 class="whiteC text-center">-Interests-</h3>
        </div>
        <div class="col-md-12 White same-H">
            <div class="pad-10">
                {{Form::textarea('interests',$userChannel->interests, array('placeholder' => 'Interests', 'style' => 'min-height:150px;'))}}          
            </div>
        </div>

        <div class="col-md-12 top-div_t mg-t-20">
            <h3 class="whiteC text-center">-Personal Information-</h3>
        </div>
        <div class="col-md-12 White same-H">
            <div class="pad-10 textbox-layout">
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
                {{Form::text('birthdate', $userChannel->birthdate, array('placeholder' => 'Birthdate', 'id' => 'datepicker'))}}

                {{Form::label('organization', '*Organization: ')}}
                <span class="inputError">{{$errors->first('organization')}}</span>
                {{Form::text('organization', Auth::User()->organization, array('placeholder' => 'Organization'))}}

                {{Form::label('work', 'Work: ')}}
                {{Form::text('work', $userChannel->work, array('placeholder' => 'Work'))}}
            </div>
        </div>
        <div class="col-md-12 top-div_t mg-t-20">
            <h3 class="whiteC text-center">-Interests-</h3>
        </div>
        <div class="col-md-12 White same-H">
            <div class="pad-10 textbox-layout">
                @if(empty($userWebsite)) 

                {{ Form::label('contact_number', '*Contact Number: ')}}
                <span class="inputError"> {{$errors->first('contact_number')}}</span> 
                {{ Form::text('contact_number', $userChannel->contact_number, array('placeholder' => 'Contact Number'))}}

                {{Form::label('website', 'Website: ')}} 
                {{Form::text('website', Auth::User()->website, array('placeholder' => 'Website'))}}

                <div class="col-md-2">
                    <div id="status" class="text-left connectTo c-fb">
                        <a href="social/facebook" class="whiteC"><img src="/img/icons/c-fb.jpg"> Connect with Facebook</a>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="text-left connectTo c-tr">
                        <a href="social/twitter" class="whiteC"><img src="/img/icons/c-tr.jpg"> Connect with Twitter</a>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="text-left connectTo c-gp">
                        <a href="social/google" class="whiteC"><img src="/img/icons/c-gp.jpg"> Connect with Google</a>
                    </div>
                </div>



                @else
                <br/>
                <div class="row">
                    @if(empty($userWebsite->facebook))
                    <div class="col-md-2">
                        <div id="status" class="text-left connectTo c-fb">
                            <a href="social/facebook" class="whiteC"><img src="/img/icons/c-fb.jpg"> Connect with Facebook</a>
                        </div>
                    </div>
                    <div class="col-md-10">
                        {{Form::text('facebook', $userWebsite->facebook, array('placeholder' => 'Facebook Account', 'disabled'))}}

                    </div>
                    @else
                    <div class="col-md-2">
                        <div id="status" class="text-left connectTo c-fb">
                            <a href="logout/facebook" class="whiteC"><img src="/img/icons/c-fb.jpg"> Sign-out with Facebook</a>
                        </div>

                    </div>
                    <div class="col-md-10">
                        @if(Session::has('sessionFacebook'))
                        Signed in as <a href="https://www.facebook.com/{{$userWebsite->facebook}}" target="_blank">{{$sessionFacebook}}</a>
                        @endif
                    </div>
                    @endif
                </div>
                <br/>
                <div class="row">
                    @if(empty($userWebsite->twitter))
                    <div class="col-md-2">
                        <div class="text-left connectTo c-tr">
                            <a href="social/twitter" class="whiteC"><img src="/img/icons/c-tr.jpg">Twitter Account</a>
                        </div>

                    </div>
                    <div class="col-md-10">
                        {{Form::text('twitter', $userWebsite->twitter, array('placeholder' => 'Twitter Account', 'disabled'))}}
                    </div>
                    @else
                    <div class="col-md-2">
                        <div class="text-left connectTo c-tr">
                            <a href="logout/twitter" class="whiteC"><img src="/img/icons/c-tr.jpg">Sign-out with Twitter</a>
                        </div>

                    </div>
                    <div class="col-md-10">
                        @if(Session::has('sessionTwitter'))
                        Signed in as <a href="{{$userWebsite->twitter}}" target="_blank">{{$sessionTwitter}}</a>
                        @endif
                    </div>
                    @endif
                </div>

                <br/>
                <div class="row">
                    @if(empty($userWebsite->google))
                    <div class="col-md-2">
                       <div class="text-left connectTo c-gp">
                        <a href="social/google" class="whiteC"><img src="/img/icons/c-gp.jpg"> Connect with Google</a>
                    </div>

                </div>
                <div class="col-md-10">
                    {{Form::text('google', $userWebsite->google, array('placeholder' => 'Google Account', 'disabled'))}}
                </div>
                @else
                <div class="col-md-2">
                    <div class="text-left connectTo c-gp">
                        <a href="logout/google" class="whiteC"><img src="/img/icons/c-gp.jpg"> Sign-out with Google</a>
                    </div>

                </div>
                <div class="col-md-10">
                    @if(Session::has('sessionGmail'))
                    Signed in as <a href="{{$userWebsite->google}}" target="_blank">{{$sessionGmail}}</a>
                    @endif
                </div>
                @endif
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

    <div class="col-md-12 top-div_t mg-t-20">
        <h3 class="whiteC text-center">-Contact Information-</h3>
    </div>
    <div class="col-md-12 White same-H">
        <div class="pad-10 textbox-layout">
            {{Form::label('address', 'Address: ')}}
            {{Form::text('address', $userChannel->address, array('placeholder' => 'Address'))}}
            <br />
            {{Form::label('country', 'Country: ')}}
            {{ Form::select('country', $countries) }}
            <br/>
            {{Form::label('zip_code', 'Zip Code: ')}}
            {{Form::text('zip_code', $userChannel->zip_code, array('placeholder' => 'Zip Code'))}}
        </div>
    </div>

    <div class="col-md-12 White same-H mg-t-20">
        <div class="pad-10 textbox-layout">
            <div class="text-center col-md-12">
                <br/><br/>
                {{Form::submit('Save Changes', array('class' => 'btn btn-info mg-b-20'))}}
            </div>

            {{ Form::close()}}
        </div>
    </div>

</div><!--/.container row-->
</div>
@stop


@section('script')
{{HTML::script('js/video-player/jquery.form.min.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/upload_cover_photo.js')}}
{{HTML::script('js/user/modalclearing.js')}}
{{HTML::script('http://code.jquery.com/ui/1.11.4/jquery-ui.js')}}
{{HTML::script('js/facebook.js')}}
{{HTML::script('js/google.js')}}


<!-- Facebook Login -->
<div id="fb-root"></div>
<script type="text/javascript">
    window.fbAsyncInit = function() {
        FB.init({appId: '834644693287300', status: true, cookie: true, xfbml: true});
        
        /* All the events registered */
        FB.Event.subscribe('auth.login', function(response) {
                    // do something with response
                    login();
                });
        FB.Event.subscribe('auth.logout', function(response) {
                    // do something with response
                    logout();
                });
        
        FB.getLoginStatus(function(response) {
            if (response.session) {
                        // logged in and connected user, someone you know
                        login();
                    }
                });
    };
    (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
        '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
    }());
    
    function login(){
        FB.api('/me', function(response) {
            document.getElementById('login').style.display = "block";
            document.getElementById('login').innerHTML = response.name + " succsessfully logged in!";
        });
    }
    function logout(){
        document.getElementById('login').style.display = "none";
    }
    
            //stream publish method
            function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){
                FB.ui(
                {
                    method: 'stream.publish',
                    message: '',
                    attachment: {
                        name: name,
                        caption: '',
                        description: (description),
                        href: hrefLink
                    },
                    action_links: [
                    { text: hrefTitle, href: hrefLink }
                    ],
                    user_prompt_message: userPrompt
                },
                function(response) {
                 
                });
                
            }
            function showStream(){
                FB.api('/me', function(response) {
                    //console.log(response.id);
                    streamPublish(response.name, 'Thinkdiff.net contains geeky stuff', 'hrefTitle', 'http://thinkdiff.net', "Share thinkdiff.net");
                });
            }
            
            function share(){
                var share = {
                    method: 'stream.share',
                    u: 'http://thinkdiff.net/'
                };
                
                FB.ui(share, function(response) { console.log(response); });
            }
            
            function graphStreamPublish(){
                var body = 'Reading New Graph api & Javascript Base FBConnect Tutorial';
                FB.api('/me/feed', 'post', { message: body }, function(response) {
                    if (!response || response.error) {
                        alert('Error occured');
                    } else {
                        alert('Post ID: ' + response.id);
                    }
                });
            }
            
            function fqlQuery(){
                FB.api('/me', function(response) {
                 var query = FB.Data.query('select name, hometown_location, sex, pic_square from user where uid={0}', response.id);
                 query.wait(function(rows) {
                     
                   document.getElementById('name').innerHTML =
                   'Your name: ' + rows[0].name + "<br />" +
                   '<img src="' + rows[0].pic_square + '" alt="" />' + "<br />";
               });
             });
            }
            
            function setStatus(){
                status1 = document.getElementById('status').value;
                FB.api(
                {
                    method: 'status.set',
                    status: status1
                },
                function(response) {
                    if (response == 0){
                        alert('Your facebook status not updated. Give Status Update Permission.');
                    }
                    else{
                        alert('Your facebook status updated');
                    }
                }
                );
            }
        </script>

        <script>
            $("#datepicker").datepicker({
              changeMonth: true,
              changeYear: true
          });
      </script>
      @stop
