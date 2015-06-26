@extends('layouts.partner')

@section('title')
TEFLTV Publisher
@stop

@section('content')



<div id="cmn-video-demo3__container">
    <video id="cmn-video-demo3__video" autoplay muted="muted" loop="true">
        <source src="/videos/tefltv.mp4" type="video/mp4">
            <source src="/videos/tefltv.webm" type="video/webm">
                Your browser doesn't support HTML5 video. Here's a <a href="#">link</a> to download the video.
            </video>
            <div id="cmn-video-demo3__content">
                <h2>Welcome to TEFLTV Partner's Program</h2>
                <p>Where you can teach, learn and earn at the same time.</p>
                <div class="text-center tagline wrap">
                    <a href="{{route('partners.learnmore')}}"><button class="btn btn-primary">Learn more</button></a>
                    <a href="{{route('users.verification')}}"><button class="btn btn-info">Get Started</button></a>
                </div>
            </div>
        </div>

        <div class="absolute-wrapper">
            <div class="col-md-10 col-md-offset-1">
                <div class="paper">
                    <div class="row text-center div-Steps">
                           <div class="col-sm-4 col-md-4">
                                <img src="/img/icons/par-upload.png" class="wow rollIn"  data-wow-duration="1s" data-wow-delay="1s">
                                <h2>Upload your own videos.</h2>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <img src="/img/icons/par-share.png" class="wow rotateIn"  data-wow-duration="1s" data-wow-delay="2s">
                                <h2>Embed video to your website or share to your social media accounts.</h2>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <img src="/img/icons/par-earn.png" class="wow rotateInUpRight"  data-wow-duration="1s" data-wow-delay="3s">
                                <h2>Earn Revenue from every advertisement.</h2>
                            </div>
                    </div>
                    <img src="/img/partners/lower-banner-partner.jpg" width="100%">
                    <div class="text-center div-partners">
                        <div class="row">
                        <h1 class="orangeC">-Featured Partners-</h1>

                            <div class="col-md-4">
                                <a href="http://www.auathailand.org" target="_blank">
                                    <img src="/img/logos/aua.jpg" class="wow zoomIn"  data-wow-duration="1s" data-wow-delay="1s">
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="http://www.teflEducators.com" target="_blank" >
                                    <img src="/img/logos/te.jpg" class="wow zoomIn"  data-wow-duration="1s" data-wow-delay="2s">
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="http://www.britishteachers.org.uk" target="_blank">
                                    <img src="/img/logos/bt.jpg" class="wow zoomIn"  data-wow-duration="1s" data-wow-delay="3s">
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop


