@extends('layouts.default')

@section('title')
{{$videos->title}} - TEFL tv Videos
@stop

@section('meta')
<meta property="fb:app_id" content="1557901494477250"/>
<meta property="og:site_name" content="TEFL TV"/>
<meta property="og:url" content="{{URL::full()}}"/>
<meta property="og:title" content="{{$videos->title}}"/>
<?php
$image = rawurlencode(asset('/')."videos/".$videos->user_id."/".$videos->file_name."/".$videos->file_name);
?>
<meta property="og:image" content="{{asset('/')}}videos/{{$videos->user_id}}/{{$videos->file_name}}/{{$videos->file_name}}_600x338.jpg"/>
<meta property="og:description" content="{{htmlentities($videos->description)}}"/>
<meta property="og:type" content="movie"/> 
<meta property="og:video:url" content="http://www.tefltv.com/embed/{{$videos->file_name}}"/>
<meta property="og:video:secure_url" content="https://www.tefltv.com/embed/{{$videos->file_name}}"/>
<meta property="og:video:type" content="text/html"/>
<meta property="og:video:width" content="640"/>
<meta property="og:video:height" content="360"/>
<meta property="og:video:url" content="https://www.tefltv.com/tefltv_fl_video_player/tefltv_video_player.swf?source=https://www.tefltv.com/videos/{{$videos->user_id}}/{{$videos->file_name}}/{{$videos->file_name}}.mp4&autoplay=true"/>
<meta property="og:video:secure_url" content="https://www.tefltv.com/tefltv_fl_video_player/tefltv_video_player.swf?source=https://www.tefltv.com/videos/{{$videos->user_id}}/{{$videos->file_name}}/{{$videos->file_name}}.mp4&autoplay=true"/>
<meta property="og:video:type" content="application/x-shockwave-flash"/>
<meta property="og:video:width" content="640"/>
<meta property="og:video:height" content="360"/> 

@stop
@section('css')
{{HTML::style('css/vid.player.min.css')}}
@stop

{{-- */$videourl = 1;/* --}}
{{-- */$playlistCounter = 1;/* --}}
{{-- */$playlistCounter2 = 1;/* --}}
@section('some_script')
{{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/homes/watch.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/homes/comment.js')}}
{{HTML::script('js/report.js')}}
{{HTML::script('js/homes/linkify.js')}}
{{HTML::script('js/homes/linkify-jquery.js')}}
{{HTML::script('js/adsbygoogle.js')}}

<script>
    $(document).ready(function(){
        $('#videoDescriptionLinkify').linkify({
            target: "_blank"
        })
    }); 
</script>
<script>
    if(window.isAdsDisplayed === undefined ) {
        $('#vid-controls').remove();
        $('#ablockVideoPlayer').prepend('<img id="ablockplayer_img" src="/img/adblock_player.png" />');
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".linkReadMore").click(function(){
            if($(".linkReadMore span").html() == 'READ MORE'){
                $(".linkReadMore span").html('READ LESS');
                $("#desc-preview").hide();
            }else{
               $(".linkReadMore span").html('READ MORE');
               $("#desc-preview").show(500);
           }
            //$(".linkReadMore span").html($(".linkReadMore span").html() == 'SHOW MORE' ?  : 'SHOW MORE');
            $(".seeVideoContent").slideToggle("fast");
        });    
    });
</script>
<script type="text/javascript">
    window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
</script>
<script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=131997643656114&version=v2.3";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script> 
<script type="text/javascript">
    document.getElementById('advertisement').style.display = 'none';</script>
    @stop
    @section('content')
    <div class="row">
        <div class="container ">
            <div class="">
                <div class="row mg-t-10">
                    <div id="featured" > 
                        <div class="col-md-8">
                            <div class="">
                                <div id="" class="ui-tabs-panel White pad-s-20 same-H" style="">
                                    <!--video paler-->
                                    <br/>
                                    @include('elements/home/watchVideo-videoPlayer')
                                    <div id='ablockVideoPlayer'>
                                    </div>
                                    @include('elements/home/watchVideo-info')
                                    @include('elements/home/watchVideo-info-sm')
                                    <br/>
                                    <div class="row" id="alert-playlist"></div>
                                    <div class="info" >
                                        <div class="well2 ">
                                            <div class="row">
                                                <div class="col-md-1 col-sm-2 col-xs-3">
                                                    <div class="row">
                                                        <div class="" style="padding-left:10px;">
                                                            <img src="{{$profile_picture['profile_picture']}}" class="userRep">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-11 col-sm-10 col-xs-9">
                                                    <p class="black">
                                                        <span>
                                                            <a href="/channels/{{$owner->channel_name}}"><h3 class="inline">{{ucfirst($owner->channel_name)}}</h3>
                                                            </a>
                                                            <br/>
                                                            
                                                            @if(isset(Auth::User()->id))
                                                            @if(Auth::User()->id == $owner->id)

                                                            @else
                                                            {{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
                                                            {{Form::hidden('user_id',$owner->id)}}
                                                            {{Form::hidden('subscriber_id', Auth::User()->id)}}
                                                            @if(!$ifAlreadySubscribe)
                                                            {{Form::hidden('status','subscribeOn')}}
                                                            {{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-sm ', 'id'=>'subscribebutton'))}}
                                                            @else
                                                            {{Form::hidden('status','subscribeOff')}}
                                                            {{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary btn-sm ', 'id'=>'subscribebutton'))}}
                                                            @endif
                                                            {{Form::close()}}
                                                            @endif
                                                            @else
                                                            {{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary btn-sm ')); }}
                                                            @endif
                                                        </span>
                                                    </p> 
                                                    
                                                  </div>
                                                  
                                                  <div class="col-md-12">
                                                  	<div class="row content-padding">
                                                  	<br/>
                                                  	<p>Posted on <b>{{date('M d, Y',strtotime($videos->created_at))}}</b> &nbsp; </p>
                                                   	<br/>
                                                    <pre style="width:100%"><p id="desc-preview">{{str_limit($videos->description, $limit = 100, $end = '...')}}</p></pre>
                                                  	
                                                    <div class="seeVideoContent black">
                                                        <pre id="videoDescriptionLinkify" style="width:100%">{{$videos->description}}</pre>>>>>>>> 2ab78776c1d1c0255b4493de2d8424ab34e0f114
                                                        <br/><br/>
                                                        <p><b>Tags:</b> {{$videos->tags}}<br/>
                                                            <b>Categories:</b> {{$videos->category}}</p>
                                                        </div>
                                                    </div><!--./col-md-12-->
                                                    </div>
                                                </div>
                                            </div><!--/.well2-->
                                            <div class="h-seeMore">
                                                <a class="linkReadMore text-center"><span>READ MORE</span></a>
                                            </div>
                                            <br/>
                                        </div><!--/.info-->
                                    </div><!--well-->
                                </div> <!--/.ui-tabs-panel-->

                                <!-- COMMENTS AREA -->
                                <div class="mg-t-10">
                                    @include('elements/home/videoComments')
                                </div>
                                <!-- COMMENTS AREA -->

                                <!-- latest -->
                                <div class="mg-b-10 hidden-sm hidden-xs">
                                    @include('elements/home/uploaderLatestVideo')
                                </div>
                            </div><!--column 8-->


                            <div class="col-md-4  ">
                                <div class="row">
                                    <!--advertisement-->
                                    <!-- advertisment small -->
                                    <!--/advertisement-->

                                    <div class="watch-top-ad same-H d-table">
                                        <br/>
                                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <!-- Home page banner -->
                                        <div class="ads-relative-wrapper-watch d-cell">
                                            <ins class="adsbygoogle"
                                            style="display:block"
                                            data-ad-client="ca-pub-3138986188138771"
                                            data-ad-slot="6642873645"
                                            data-ad-format="auto"></ins>
                                            <script>
                                                (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>
                                        </div>
                                    </div>

                                    <ul class="ui-tabs-nav same-H"> <!--video navigation or video list-->
                                        <h4 align='center' id='next-video-autoplay'>Up next autoplay</h4>
                                        @foreach($newRelation as $relation)
                                        <li class="ui-tabs-nav-item showhim" id="">
                                            <a href="/watch?v={{$relation['file_name']}}" id="videourl{{$videourl++}}">   
                                            	<div class="row p-relative">
                                                <div class="show_wrapp">
                                                    <div class=" col-middle">
                                                        @if(file_exists(public_path("/videos/".$relation['uid']."/".$relation['file_name']."/".$relation['file_name'].".jpg")))
                                                        <div class="showme" style="background:url(/videos/{{$relation['uid']}}/{{$relation['file_name']}}/{{$relation['file_name']}}.jpg);background-size:100% auto;height:100%!important;" >     
                                                            @else
                                                            <div class="showme" style="background:url(/img/thumbnails/video.png);background-size:100% auto;">
                                                                @endif

                                                                <div class="show-info" style="width: 100%;height: 100%;background:rgba(31, 51, 89, 0.8);">
                                                                    <div class="showInfo-wrapp ">
                                                                        <div class="showInfo-div">
                                                                            <span class="info-title">{{ ($relation['title']) }}</span><br/>
                                                                            by: {{$relation['channel_name']}}<br/>
                                                                            {{date('M d, Y',strtotime($relation['created_at']))}} | {{number_format($relation['views'])}} view/s
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row-same-height" title="">
                                                            <div class="col-md-5 col-xs-4 col-md-height col-middle">
                                                                @if(file_exists(public_path("/videos/".$relation['uid']."/".$relation['file_name']."/".$relation['file_name'].".jpg")))
                                                                <img src="/videos/{{$relation['uid']}}/{{$relation['file_name']}}/{{$relation['file_name']}}.jpg" alt="" width="100%" />
                                                                @else
                                                                <img src="/img/thumbnails/video.png" alt="" width="100%" />
                                                                @endif
                                                            </div>
                                                            <div class="col-md-7 col-sm-8 col-xs-4 col-md-height col-middle">
                                                                <div class="hide_h">
                                                                    <div class="visible-lg"><span class="v-list text-justify">{{ Str::limit($relation['title'],68) }}</span></div>
                                                                    <div class="visible-md"><span class="v-list text-justify">{{ Str::limit($relation['title'],45) }}</span></div>
                                                                    <div class="visible-sm"><span class="v-list text-justify">{{ Str::limit($relation['title'],30) }}</span></div>
                                                                </div>
                                                                <span>by: {{$relation['channel_name']}}</span><br/>
                                                                <!--<span>{{date('M d, Y',strtotime($relation['created_at']))}}</span><br/>-->
                                                                <span>{{number_format($relation['views'])}} view/s</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul><!--video list-->

                                        <div class="mg-t-10 same-H">
                                            <div class="h-title">
                                                <div class="row">
                                                    Advertisements
                                                </div>
                                            </div>
                                            @include('elements/home/carouselAds')
                                        </div>
                                        <div class="mg-t-10 mg-b-10 same-H">
                                            @include('elements/home/recommendedChannelList')
                                        </div>
                                    </div>
                                </div><!--col-md-4-->
                            </div><!--/.featured-->
                        </div><!--/.row-->
                    </div><!--/padding-->
                </div><!--/.row-->
            </div>
        </div>
    </div>



{{--
    <div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1557901494477250',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
--}}


@stop
