@extends('layouts.default')

@section('title')
    {{$videos->title}} - TEFL tv Videos
@stop

@section('meta')
    <meta property="fb:app_id" content="1557901494477250"/>
    <meta property="og:site_name" content="TEFL-TV"/>
    <meta property="og:url" content="{{URL::full()}}"/>
    <meta property="og:title" content="{{$videos->title}}"/>
    <?php
        $image = rawurlencode(asset('/')."videos/".$videos->user_id."-".$owner->channel_name."/".$videos->file_name."/".$videos->file_name);
    ?>
    <meta property="og:image" content="{{asset('/')}}videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}_600x338.jpg"/>
    <meta property="og:description" content="{{htmlentities($videos->description)}}"/>
    <meta property="og:type" content="video"/> 
    
   {{-- 
    <meta property='og:video' content='{{asset('/')}}tefltv_fl_video_player/tefltv_video_player.swf'/>
    <!-- <meta property='og:video:url' content='{{asset('/')}}sharing/{{$videos->file_name}}'/> -->
    <meta property='og:video:secure_url' content='https://www.tefltv.com/tefltv_fl_video_player/tefltv_video_player.swf?'/>
    <meta property="og:video:type" content="application/x-shockwave-flash">
    <meta property="og:video:width" content="600"/> 
    <meta property="og:video:height" content="360"/> 
    <meta name="description" content="{{htmlentities($videos->description)}} watch our tefl videos for the best esl community"/>
    <meta name="keywords" content="{{$videos->tags}}"/>  --}} 

    <meta property="og:type" content="video">
    <meta property="og:video:url" content="https://www.tefltv.com/embed/{{$videos->file_name}}">
    <meta property="og:video:secure_url" content="https://www.tefltv.com/embed/{{$videos->file_name}}">
    <meta property="og:video:type" content="text/html">
    <meta property="og:video:width" content="1280">
    <meta property="og:video:height" content="720">
    <meta property="og:video:url" content="http://www.tefltv.com/sharing/{{$videos->file_name}}">
    <meta property="og:video:secure_url" content="https://www.tefltv.com/sharing/{{$videos->file_name}}">
    <meta property="og:video:type" content="application/x-shockwave-flash">
    <meta property="og:video:width" content="1280">
    <meta property="og:video:height" content="720">  

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
{{--HTML::script('js/video-player/fullscreen.min.js')--}}

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
document.getElementById('advertisement').style.display = 'none';
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
                            <div class="row">
                                <div class="col-md-12"><div>
                                    <br/>
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9 ">
                                                <p class="black wv-title">
                                                    {{$videos->title}}
                                                </p>
                                            </div>
                                            <div class="col-md-3 col-xs-4 col-sm-3 text-right">
                                            @if($videos->views > 1)
                                                <p class="black wv-views" id="views-counter">{{$videos->views}} Views</p>
                                                @else
                                                <p class="black wv-views" id="views-counter">{{$videos->views}} View</p>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                            {{Form::hidden('text1',Crypt::encrypt($id),array('id'=>'text1'))}}
                                            {{Form::hidden('video-token',Crypt::encrypt($id))}}
                                            {{Form::hidden('likes',$totalLikesDislikes['likes'])}}
                                            {{Form::hidden('dislikes',$totalLikesDislikes['dislikes'])}}
                                            {{Form::hidden('filename', $videos->file_name,['id'=>'filename'])}}
                                            {{Form::hidden('autoplay', $autoplay, ['id'=>'autoplay'])}}
                                            {{Form::hidden('duration', $duration, ['id'=>'duration'])}}
                                            {{Form::hidden('role', $role)}}
                                            @if(isset(Auth::User()->id))

                                            <span class="dropdown" id="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p style="display:inline;"><i class="fa fa-plus hand"></i>&nbsp;&nbsp;Add to</p>
                                                </a>
                                                <span class="dropdown-menu White noclose" style="padding:5px 5px;text-align:left;">

                                                    @if(empty($favorites))
                                                    <li id="favotite-list"><p id="addToFavorites" style="cursor: pointer"><img src="img/icons/star.png"/>&nbsp;&nbsp;Favorites</p></li>
                                                    @else
                                                    <li id="favotite-list"><p id="removeToFavorites" style="cursor: pointer"><img src="img/icons/starActive.png"/>&nbsp;&nbsp;Favorites</p></li>
                                                    @endif
                                                    @if(empty($watchLater))
                                                    <li id="watchlater-list"><p id="addToWatchLater" style="cursor: pointer"><img src="img/icons/clock.png"/>&nbsp;&nbsp;Watch Later</p></li>
                                                    @else
                                                    <li id="watchlater-list"><p id="removeToWatchLater" style="cursor: pointer"><img src="img/icons/clockActive.png"/>&nbsp;&nbsp;Watch Later</p></li>
                                                    @endif
                                                    <li id="list"><p id="label-playlist"><i class="fa fa-list" ></i>&nbsp;&nbsp;Playlist</p>

                                                        @if(empty($playlists))
                                                        <ul style="list-style:none;margin-left:-30px;" id="list-checkbox">
                                                            @foreach($playlistNotChosens as $playlistNotChosen)
                                                            <li id="playlist-value">{{ Form::checkbox($playlistNotChosen->name,Crypt::encrypt($playlistNotChosen->id),null,array('id'=>'availablePlaylist'.$playlistCounter2++))}} &nbsp; {{$playlistNotChosen->name}}</li>
                                                            @endforeach
                                                        </ul>    
                                                        @else
                                                        {{ Form::text('search', null, array('id' => 'search-playlist', 'placeholder' => 'Search Playlist', 'class' => 'form-control c-input ')) }}
                                                        <ul style="list-style:none;margin-left:-30px;" id="list-checkbox">
                                                            @foreach($playlists as $playlist)
                                                            <li id="playlist-value">{{ Form::checkbox($playlist->name,Crypt::encrypt($playlist->id),null,array('id'=>'playlist'.$playlistCounter++,'checked'=>'true'))}} &nbsp; {{$playlist->name}}</li>
                                                            @endforeach

                                                            @if(!empty($playlistNotChosens))
                                                                @foreach($playlistNotChosens as $playlistNotChosen)
                                                                <li id="playlist-value">{{ Form::checkbox($playlistNotChosen->name,Crypt::encrypt($playlistNotChosen->id),null,array('id'=>'availablePlaylist'.$playlistCounter2++))}} &nbsp; {{$playlistNotChosen->name}}</li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                        @endif   
                                                        <button id="createPlaylist" class="btn-adplaylist">Create New Playlist</button>
                                                        

                                                    </li>
                                                </span>
                                            </span><!--/.dropdown add to-->

                                            @else

                                            <a href="signin" role="button" aria-expanded="false">
                                                <p style="display:inline;"><i class="fa fa-plus hand"></i>&nbsp;&nbsp;Add to</p>
                                            </a>
                                            @endif
                                           <!-- &nbsp;&nbsp;|&nbsp;&nbsp;
                                             <span class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p style="display:inline;"><i class="fa fa-share-alt hand"></i>&nbsp;&nbsp;Share</p>

                                                </a>
                                                <span class="dropdown-menu drop pull-right White snBg" style="padding:5px 5px;text-align:center;width:auto;">
                                                    <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{asset('/')}}watch?v={{$videos->file_name}}&title={{$videos->title}}"><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a>
                                                    <a target="_blank" href="http://twitter.com/home?status= {{$videos->title}}+{{asset('/')}}watch?v={{$videos->file_name}}"> <i class="socialMedia socialMedia-twitter" title="Share on Twitter"></i></a>
                                                    <a target="_blank" href="https://plus.google.com/share?url={{asset('/')}}watch?v={{$videos->file_name}}"><i class="socialMedia socialMedia-googlePlus" title="Share on Google+"></i></a>
                                                </span><!--/.dropdown-menu pull-right White
                                            </span><!--/.dropdown share-->
                                            
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                            <a href="#" id='embed-video' class="black"><p class="inline"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-right"></i>&nbsp;&nbsp;Embed</p></a>
                                             <!-- <a href="{{URL::route('get.complaint_form')}}" class="black"><p class="inline"><i class="fa fa-flag"></i>&nbsp;&nbsp;Report</p></a> -->
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                            
                                            {{Form::open(array('route' => array('get.complaint_form'),'class' => 'inline'))}}
                                                {{Form::hidden('report_url',$report_url)}}
                                                <span title="Report This Video">
                                                    <button value="Report" type="submit" class="reportLink btn-clear"><i class='fa fa-flag'></i> Report</button>
                                                </span>
                                           	{{Form::close()}}                                            
                                                @if(Auth::check())
                                                    @if((Auth::User()->role == 4) || (Auth::User()->role == 5))
                                                        <a href="#" id='publish-video' class="black"><p class="inline">&nbsp;&nbsp;<i class="glyphicon glyphicon-share"></i>&nbsp;&nbsp;Publish Ads</p></a>
                                                        <div class='pub-ads'>
                                                            <h4>Your Ads Preview</h4>
                                                             <!-- <p>Click proceed to place your own ads to this video.</p> -->
                                                            <hr>
                                                                 @include('ads/adspreview')
                                                            <hr>
                                                            <div style="" id='embed-pub'>
                                                            <p>Copy and paste this code to your website:</p>
                                                             <p>   <input id='embed-pub' type='text' name='embed-pub' value="<iframe width='500' height='315' src='{{asset('/')}}publish-video/{{Crypt::encrypt(Auth::User()->id)}}/{{$videos->file_name}}' frameborder='0' allowfullscreen></iframe>">
                                                            </p>
                                                            </div>
                                                           <!-- <button id='embed-own-ads' type="button" class="btn btn-default">Embed with your ads</button>
                                                            <!-- <button type="button" name='ads-proceed' class="btn btn-default">Proceed</button> -->
                                                        </div>                             
                                                    @endif
                                                @endif
                                                
                                                <div style='margin-top:5px;display:none;' class="embed-frame">
                                                    <p>
                                                        <input  type="text" id='code-embed' class="form-control" value="<iframe width='500' height='315' src='{{asset('/')}}embed/{{$videos->file_name}}' frameborder='0' allowfullscreen></iframe>">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                                 <span class="">
                                                    <span class='label label-primary hand' title='Like' id='video-like'><i  class="fa fa-thumbs-up hand"></i> <span id='total-like'>&nbsp;{{$totalLikesDislikes['likes']}}</span></span>
                                                    <span class='label label-danger hand' title='Dislike' id='video-dislike'><i class="fa fa-thumbs-down hand"></i> <span id='total-dislike'>&nbsp;{{$totalLikesDislikes['dislikes']}}</span></span>
                                                   
                                                    {{--@if(isset(Auth::User()->id))
                                                        @if(!empty($like))
                                                        <span id = "like-span">
                                                            <i id="remove-like"><img src="/img/icons/like_active.png" style="cursor:pointer"></i>
                                                        </span>
                                                        @else
                                                        <span id = "like-span">
                                                            <i class="fa fa-thumbs-up hand" title="like this" id="like"></i>
                                                        </span>
                                                        @endif
                                                    @else
                                                      <i class="fa fa-thumbs-up hand"></i>
                                                    @endif 
                                                    &nbsp;
                                                    <span id="like-counter"><p class="inline">{{$likeCounter}}</p></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    @if(isset(Auth::User()->id))
                                                        @if(!empty($dislike))
                                                        <span id = "dislike-span">
                                                            <i id="remove-dislike"><img src="/img/icons/unlike_active.png" style="cursor:pointer"></i>
                                                        </span>
                                                        @else
                                                        <span id = "dislike-span">
                                                            <i class="fa fa-thumbs-down hand" id="dislike"></i>
                                                        </span>
                                                        @endif                                                        
                                                    @else
                                                      <i class="fa fa-thumbs-down hand"></i>
                                                    @endif 
                                                    &nbsp;<span id="dislike-counter"><p class="inline">{{$dislikeCounter}}</p></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            
                                                --}}
                                                </span><!--/links-->
                                            </div>                                            
                                        </div>
                                        <div class=" " style="border-top:1px solid #f1f1f1;margin-top:10px;padding-top:10px;">
                                            <span> Share Video</span>
                                            <br/>

                                            <!-- <div class="fb-share-button" data-href="{{asset('/')}}watch?v={{$videos->file_name}}" data-layout="button_count"></div> -->
                                            <!-- <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{asset('/')}}watch?v={{$videos->file_name}}"><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a> -->
                                            <a target="_blank" href="https://www.facebook.com/dialog/share?app_id=1557901494477250&href={{asset('/')}}watch?v={{$videos->file_name}}&display=popup&redirect_uri=https://www.facebook.com"><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a>
                                            <a target="_blank" href="http://twitter.com/home?status= {{$videos->title}}+{{asset('/')}}watch?v={{$videos->file_name}}"> <i class="socialMedia socialMedia-twitter" title="Share on Twitter"></i></a>
                                            <a target="_blank" href="https://plus.google.com/share?url={{asset('/')}}watch?v={{$videos->file_name}}"><i class="socialMedia socialMedia-googlePlus" title="Share on Google+"></i></a>
                                        </div>
                                    </div>
                                </div><!--/.col-md-5-->
                            </div><!--/.row-->
                            <br/>
                            <div class="row" id="alert-playlist"></div>
                            <div class="info" >
                                <div class="well2 ">
                                    <div class="row">
                                        <div class="col-md-1 col-sm-2">
                                            <div class="row">
                                                <div class="" style="padding-left:10px;">
                                                    <img src="{{$profile_picture['profile_picture']}}" class="user">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-11 col-sm-10">
                                        <p class="black">
                                            <span>
                                                <a href="/channels/{{$owner->channel_name}}">{{ucfirst($owner->channel_name)}}</a> <small>{{count($countSubscribers)}} Subscriber(s)</small>
                                                @if(isset(Auth::User()->id))
                                                    @if(Auth::User()->id == $owner->id)

                                                    @else
                                                        {{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
                                                            {{Form::hidden('user_id',$owner->id)}}
                                                            {{Form::hidden('subscriber_id', Auth::User()->id)}}
                                                            @if(!$ifAlreadySubscribe)
                                                                {{Form::hidden('status','subscribeOn')}}
                                                                {{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-sm pull-right', 'id'=>'subscribebutton'))}}
                                                            @else
                                                                {{Form::hidden('status','subscribeOff')}}
                                                                {{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary btn-sm pull-right', 'id'=>'subscribebutton'))}}
                                                            @endif
                                                        {{Form::close()}}
                                                    @endif
                                                @else
                                                    {{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary btn-sm pull-right')); }}
                                                @endif
                                            </span>
                                        </p> 
                                        <p>Posted on <b>{{date('M d, Y',strtotime($videos->created_at))}}</b> &nbsp; </p>
                                        <br />
                                        <pre style="width:100%"><p id="desc-preview">{{str_limit($videos->description, $limit = 100, $end = '...')}}</p></pre>
                                        <div class="seeVideoContent black">
                                            <br/>
                                            <pre id="videoDescriptionLinkify">{{$videos->description}}</pre>

                                            <br/><br/>
                                            <p><b>Tags:</b> {{$videos->tags}}<br/>
                                            <b>Categories:</b> {{$videos->category}}</p>
                                       </div>
                                    </div><!--./col-md-11-->
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
                <div class="mg-b-10">
                    @include('elements/home/uploaderLatestVideo')
                </div>
            </div><!--column 8-->


            <div class="col-md-4 visible-md visible-lg ">
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
                            <a href="/watch?v={{$relation['file_name']}}" id="videourl{{$videourl++}}">                                    <div class="row p-relative">
                                    <div class="show_wrapp">
                                        <div class=" col-middle">
                                            @if(file_exists(public_path("/videos/".$relation['uid']."-".$relation['channel_name']."/".$relation['file_name']."/".$relation['file_name'].".jpg")))
                                                <div class="showme" style="background:url(/videos/{{$relation['uid']}}-{{$relation['channel_name']}}/{{$relation['file_name']}}/{{$relation['file_name']}}.jpg);background-size:100% auto;height:100%!important;" >     
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
                                            @if(file_exists(public_path("/videos/".$relation['uid']."-".$relation['channel_name']."/".$relation['file_name']."/".$relation['file_name'].".jpg")))
                                                <img src="/videos/{{$relation['uid']}}-{{$relation['channel_name']}}/{{$relation['file_name']}}/{{$relation['file_name']}}.jpg" alt="" width="100%" />
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

{{--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1557901494477250";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>--}}

@stop
