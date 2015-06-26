<div class="same-H">
<div class="col-md-7" style="background:#252c44;height:210px;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-4   ">
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
                <div class="col-md-4">
                    <span class="white">
                        <ul style="list-style:none;">
                            <li><h3 class="orangeC">Legal Terms</h3></li>
                            <li><a href="">Privacy</a></li>
                            <li><a href="">Copyright</a></li>
                            <li><a href="">Terms and Conditions</a></li>
                        </ul>
                    </span>
                </div>
                <div class="col-md-4">
                    <span class="white">
                        <ul style="list-style:none;">
                            <li><h3 class="orangeC">Programs</h3></li>
                            <li><a href="">Advertise</a></li>
                            <li><a href="">Partner</a></li>
                            <li><a href="">Publisher</a></li>
                        </ul>
                    </span>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="col-md-5 f_contact-wrap" >

 <div class="row">
     <div class="col-md-10 col-md-push-1 f_contact">
        <h3 class="orangeC inline">
            Contact Us
        </h3>
        <div class="pull-right f_icon-wrap" >

            <a href="https://www.facebook.com/tefltv1"><span class="f_social"><img src="/img/icons/c-fb.jpg" class="hvr-float same-H"></span></a>

            <a href="https://plus.google.com/u/0/100501287408141782277/about" ><span class="f_social"><img src="/img/icons/c-gp.jpg" class="hvr-float same-H" ></span></a>

            <a href="https://twitter.com/TEFLtv"><span class="f_social"><img src="/img/icons/c-tr.jpg" class="hvr-float same-H"></span></a>
            <!--<a href=""><i class="socialMedia socialMedia-skype pull-right"></i></a>-->
        </div>
        <p style="color:#81a1c7!important;">You can submit your concern here or email us at <a> support@tefltv.com </a></p>


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
                {{ Form::textarea('message', '', array('placeholder' => 'Message', 'class' => 'f_textAreaContact form-control')); }}
                @if($errors->has('message'))
                <span class="inputError">
                    {{$errors->first('message')}}
                </span>
                @endif
            </span>

            {{ Form::submit('Submit', array('class' => 'btn btn-warning form-control mg-t--5'))}}
            {{Form::close()}}

        </div>
    </div>
</div>
</div>
<div class="same-H">
    <div class="col-md-7" style="background:#e96136!important;height:20px;">
        <div class="row text-center">
            <span class="whiteC">TEFL TV BETA VERSION 1.0</span>
        </div>
    </div>
    <div class="col-md-5" style="background:#c45937!important;height:20px;">
        <div class="row">

        </div>
    </div>
</div>

