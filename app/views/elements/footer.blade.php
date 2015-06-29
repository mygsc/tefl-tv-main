<div class="same-H div_footer">
    <div class="col-md-7 f_links_div">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-4   ">
                        <span class="white">
                            <ul class="list-n">
                                <li><h3 class="whiteC">TELFTV</h3></li>
                                <li><a href="/">Home</a></li>
                                <li>{{ link_to_route('homes.popular', 'Popular', null, array('class' => '')) }}</li>
                                <li>{{ link_to_route('homes.latest', 'Latest', null, array('class' => '')) }}</li>
                                <li>{{ link_to_route('homes.playlist', 'Playlist', null, array('class' => '')) }}</li>
                                <li>{{ link_to_route('homes.top-channels', 'Channels', null, array('class' => '')) }}</li>
                            </ul>
                        </span>
                    </div>
                    <div class="col-md-4">
                        <span class="white">
                            <ul class="list-n">
                                <li><h3 class="whiteC ">Legal Terms</h3></li>
                                <li>{{ link_to_route('homes.privacy', 'Privacy', null, array('class' => '')) }}</li>
                                <li>{{ link_to_route('homes.copyright', 'Copyright', null, array('class' => '')) }}</li>
                                <li>{{ link_to_route('homes.termsandconditions', 'Terms and Conditions', null, array('class' => '')) }}</li>
                            </ul>
                        </span>
                    </div>
                    <div class="col-md-4">
                        <span class="white">
                            <ul class="list-n">
                                <li><h3 class="whiteC">Programs</h3></li>
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
            <h3 class="whiteC inline">
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
    <div class="col-md-12 f_version">
        <div class="text-center">
            <small class="whiteC">TEFL TV BETA VERSION 1.0</small>
        </div>
    </div>

</div>

