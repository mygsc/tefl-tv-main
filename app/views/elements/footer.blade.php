<div class="footer2 same-H">
    <div class="row text-center">
   
                    <span class="ctgryNav-f">
                        {{ link_to_route('homes.index', 'Home', null) }}
                        {{ link_to_route('homes.aboutus', 'Popular', null) }}
                        {{ link_to_route('homes.advertisements', 'Latest', null) }}
                        {{ link_to_route('homes.privacy', 'Playlists', null) }}
                        {{ link_to_route('homes.termsandconditions', 'Channels', null) }}
                        {{ link_to_route('homes.copyright', 'My Channel', null) }}

                      
                    </span><!--/.ctgryNav-f-->
    </div>
</div>

<div class="footer1 hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-2    ">
                <span class="white">
                    <ul style="list-style:none;">
                        <li><h3 class="orangeC">TELFTV</h3></li>
                        <li><a href="">Home</a></li>
                        <li><a href="">Popular</a></li>
                        <li><a href="">Latest</a></li>
                        <li><a href="">Playlist</a></li>
                        <li><a href="">Channels</a></li>
                    </ul>
                </span>
            </div>
            <div class="col-md-2">
                <span class="white">
                    <ul style="list-style:none;">
                        <li><h3 class="orangeC">Legal Terms</h3></li>
                        <li><a href="">Privacy</a></li>
                        <li><a href="">Copyright</a></li>
                        <li><a href="">Terms and Conditions</a></li>
                    </ul>
                </span>
            </div>
            <div class="col-md-2">
                <span class="white">
                    <ul style="list-style:none;">
                        <li><h3 class="orangeC">Programs</h3></li>
                        <li><a href="">Advertise</a></li>
                        <li><a href="">Partner</a></li>
                        <li><a href="">Publisher</a></li>
                    </ul>
                </span>
            </div>
            <div class="col-md-4">
                <h3 class="orangeC">Contact Us</h3>
                <span class="white">
                    {{Form::open(array('route' => 'post.homes.aboutus'))}}
                <span class="textbox-layout">
                    <div class="row">
                        <div class="col-md-6" >
                    {{ Form::text('name', '', array('placeholder' => 'Name' , 'class' => 'form-control')); }}
                    @if($errors->has('name'))
                    <span class="inputError">
                        {{$errors->first('name')}}
                    </span>
                    @endif
                    </div>
                      <div class="col-md-6" >
                    {{ Form::text('email', '', array('placeholder' => 'Email' , 'class' => 'form-control')); }}
                    @if($errors->has('email'))
                    <span class="inputError">
                        {{$errors->first('email')}}
                    </span>
                    @endif
                    </div>
                    </div>
                    {{ Form::textarea('message', '', array('placeholder' => 'Message', 'class' => 'textAreaContact form-control')); }}
                    @if($errors->has('message'))
                    <span class="inputError">
                        {{$errors->first('message')}}
                    </span>
                    @endif
                </span>
                <div class="text-right">
                    {{ Form::submit('Submit', array('class' => 'btn btn-warning form-control'))}}
                    {{Form::close()}}
                </div>
                    <ul style="list-style:none;">

                      <span class="text-right">
                            <a href="https://www.facebook.com/tefltv1"><i class="socialMedia socialMedia-facebook pull-right"></i></a>
                            <a href="https://plus.google.com/u/0/100501287408141782277/about"><i class="socialMedia socialMedia-googlePlus pull-right"></i></a>
                            <a href="https://twitter.com/TEFLtv"><i class="socialMedia socialMedia-twitter pull-right"></i></a>
                            <!--<a href=""><i class="socialMedia socialMedia-skype pull-right"></i></a>-->
                    </span><!--/.text-right-->
                    </ul>
                </span>
            </div>



            <!--  <div class="col-lg-9 col-md-9 col-xs-12 col-sm-10" style="padding:15px 0 0 0;">

                    <span class="ctgryNav-f">
                        {{ link_to_route('homes.index', 'Home', null) }}
                        {{ link_to_route('homes.aboutus', 'Contact Us', null) }}
                        {{ link_to_route('homes.advertisements', 'Advertisement', null) }}
                        {{ link_to_route('homes.privacy', 'Privacy', null) }}
                        {{ link_to_route('homes.termsandconditions', 'Terms and Conditions', null) }}
                        {{ link_to_route('homes.copyright', 'Copyright', null) }}
                        {{ link_to_route('partners.index', 'Partner', null) }}
                        {{ link_to_route('publishers.index', 'Publisher', null) }}
                      
                    </span><!--/.ctgryNav-f-->

            </div><!--/.col-md-7 col-xs-12-->

            <div class="col-lg-3 col-md-4">
                <div class="col-lg-12 col-xs-12 hidden-sm" style="padding:5px 0 0 0;">
                    

                </div><!--/.col-md-10 col-xs-12 col-sm-9-->

            </div><!--/.col-md-5-->
            <div class="col-sm-2 visible-sm" style="padding:15px 0 0 0;">
                <span class="dropdown"> 
                    <span caclass="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                        <a href=""><i class="glyphicon glyphicon-link" ></i><small>Social Media Links</small> </a>
                    </span>
                    <span class="dropdown-menu pull-top" style="width:300px!Important;background:transparent;box-shadow:none;border:none;">
                        <a href="https://www.facebook.com/tefltv1"><i class="socialMedia socialMedia-facebook pull-left"></i></a>
                        <a href="https://plus.google.com/u/0/100501287408141782277/about"><i class="socialMedia socialMedia-googlePlus pull-left"></i></a>
                        <a href="https://twitter.com/TEFLtv"><i class="socialMedia socialMedia-twitter pull-left"></i></a>
                        <!--<a href=""><i class="socialMedia socialMedia-skype pull-left"></i></a>-->
                    </span>
                </span>
            </div>
        </div><!--/.row-->
    </div><!--/.container-->
</div><!--/.footer1-->




<div class="same-H text-center"  style="background:#ff6e40!important;">
      <span class="white">TEFL TV BETA VERSION 1.0</span>
      
</div>