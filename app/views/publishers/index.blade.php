@extends('layouts.publisher')

@section('title')
    TEFLTV Publisher | TEFL TV
@stop

@section('content')
<div class="" >
    <div id="cmn-video-demo3__container" style="z-index:-1;">
        <video id="cmn-video-demo3__video" autoplay muted="muted" loop="true">
            <source src="/videos/tefltv_publishers.mp4" type="video/mp4">
            <source src="/videos/tefltv_publishers.webm" type="video/webm">
            Your browser doesn't support HTML5 video. Here's a <a href="#">link</a> to download the video.
        </video>
        <div id="cmn-video-demo3__content" >
            <h2 class="orangeC">Welcome to TEFLtv’s publishers program page.</h2>
            <p class="t-bBlue">Where you can teach, learn and earn at the same time.</p>
            
        </div>
    </div>
    <div class="text-center tagline wrap" >
        <a href="{{route('publishers.learnmore')}}"><button class="btn btn-primary">Learn more</button></a>
        <a href="{{route('publishers.verification')}}"><button class="btn btn-warning">Get Started</button></a>
    </div>
</div>

<div class="paper_wrap_h">
    <div class="col-md-10 col-md-offset-1">
        <div class="paper_2">
            <div class="row ">
                <div class="row text-center div-Steps">
                   <div class="col-sm-4 col-md-4">
                        <img src="/img/icons/select-ico.png" class="wow rollIn"  data-wow-duration="1s" data-wow-delay="1s">
                        <h2>Select from all videos on tefltv</h2>
                    </div>
               
                    <div class="col-sm-4 col-md-4">
                        <img src="/img/icons/share-ico.png" class="wow rotateIn"  data-wow-duration="1s" data-wow-delay="2s">
                        <h2>Embed videos in your website or share them on your social media accounts</h2>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <img src="/img/icons/earn-ico.png" class="wow rotateInUpRight"  data-wow-duration="1s" data-wow-delay="3s">
                        <h2>Earn revenue on every ad impression</h2>
                    </div>
                </div>
            </div>
            <img src="/img/partners/lower-banner.jpg" width="100%">
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


@stop


