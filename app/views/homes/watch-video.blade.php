@extends('layouts.default')
@section('meta')
    <!--<meta property="og:title" content="{{$videos->title}}">
        <meta property="og:site_name" content="{{asset('/')}}">
        <meta property="og:description" content="{{$videos->description}}">
        <meta property="og:url" content="{{asset('/')}}watch!v={{$videos->file_name}}">
        <meta property="og:image" content="//videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}_600x338.jpg">-->

       <meta property="og:type" content="video">
<meta property="og:video:url" content="/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}.mp4">
        <meta property="og:video:width" content="640"> 
        <meta property="og:video:height" content="360"> 
<meta property="og:video:tag" content="{{$videos->tags}}"> 
@stop
@section('css')
{{HTML::style('css/vid.player.min.css')}}
@stop

{{-- */$videourl = 1;/* --}}
{{-- */$playlistCounter = 1;/* --}}
{{-- */$playlistCounter2 = 1;/* --}}
@section('some_script')
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/homes/watch.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/video-player/fullscreen.min.js')}}
{{HTML::script('js/homes/comment.js')}}

<script type="text/javascript">
    $(document).ready(function(){
        $(".linkReadMore").click(function(){
            $(".linkReadMore span").html($(".linkReadMore span").html() == 'SHOW MORE' ? 'SHOW LESS' : 'SHOW MORE');
            $(".seeVideoContent").slideToggle("slow");
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
                    <div class="row">
                        <div id="" class="ui-tabs-panel White pad-s-10 same-H" tyle="">
                            <!--video paler-->
                            <br/>
	<!--advertisement-->
	<div class="advertisement" id='advertisement' style="display:none">
		<div class="span12" style="background:rgba(0,0,0, 0.15)">
			<div class="col-md-10 col-md-offset-1">
				<span class="close">x</span> 
				<script type="text/javascript">
    google_ad_client = "ca-pub-3138986188138771";
    google_ad_slot = "4882426847";
    google_ad_width = 320;
    google_ad_height = 100;
</script>
<!-- tefltv ads -->
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
			</div>
		</div>
	</div>
                            @include('elements/home/watchVideo-videoPlayer')
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                    <br/>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <p class="black wv-title">
                                                    {{$videos->title}}
                                                </p>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <p class="black wv-views" id="views-counter">{{$videos->views}} View(s)</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                               
                                            {{Form::hidden('text1',Crypt::encrypt($id),array('id'=>'text1'))}}
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


                                                        <button id="createPlaylist" class="btn btn-unsub">Create New Playlist</button>
                                                        
                                                    </li>
                                                </span>
                                            </span><!--/.dropdown add to-->

                                            @else

                                            <a href="signin" role="button" aria-expanded="false">
                                                <p style="display:inline;"><i class="fa fa-plus hand"></i>&nbsp;&nbsp;Add to</p>
                                            </a>
                                            @endif
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                             <span class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p style="display:inline;"><i class="fa fa-share-alt hand"></i>&nbsp;&nbsp;Share</p>

                                                </a>
                                                <span class="dropdown-menu drop pull-right White snBg" style="padding:5px 5px;text-align:center;width:auto;">
                                                    <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{asset('/')}}watch!v={{$videos->file_name}}&title={{$videos->title}}"><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a>
                                                    <a target="_blank" href="http://twitter.com/home?status= {{$videos->title}}+{{asset('/')}}watch!v={{$videos->file_name}}"> <i class="socialMedia socialMedia-twitter" title="Share on Twitter"></i></a>
                                                    <a target="_blank" href="https://plus.google.com/share?url={{asset('/')}}watch!v={{$videos->file_name}}"><i class="socialMedia socialMedia-googlePlus" title="Share on Google+"></i></a>
                                                </span><!--/.dropdown-menu pull-right White-->
                                            </span><!--/.dropdown share-->
                                            
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                            <a href="#embed" data-toggle="modal" class="black"><p class="inline"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-right"></i>&nbsp;&nbsp;Embed</p></a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                 <span class="">
            
                                                   
                                                    @if(isset(Auth::User()->id))
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
                                                    &nbsp;<span id="like-counter"><p class="inline">{{$likeCounter}}</p></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

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
                                                </span><!--/links-->
                                            </div>
                                            
                                        </div>  
                                        </div>
                                       
                                </div><!--/.col-md-5-->
                            </div><!--/.row-->
                            <br/>
                            <div class="row" id="alert-playlist"></div>
                            <div class="info" >
                                <div class="well2 ">
                                    <div class="row">
                                    @if(file_exists(public_path('/img/user/'.$owner->id.'.jpg')))
                                        <div class="col-md-1 col-sm-2">
                                            <div class="row text-right">
                                                <img src="/img/user/{{$owner->id}}.jpg" class="user">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-1 col-sm-2">
                                            <div class="row text-right">
                                                <img src="/img/user/0.jpg" class="user  ">
                                            </div>
                                        </div>
                                    @endif
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
                                                    @endif
                                                    {{Form::close()}}
                                                @else
                                                    {{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary btn-sm pull-right')); }}
                                                @endif
                                            </span>
                                        </p> 
                                        <p>Posted on <b>{{date('M d, Y',strtotime($videos->created_at))}}</b> &nbsp; </p>
                                        
                                        <div class="seeVideoContent">
                                            <pre>
                                               {{$videos->description}}<br/><br/>
                                            </pre>
                                            <p><b>Tags:</b> {{$videos->tags}}<br/>
                                                <b>Categories:</b> {{$videos->category}}</p>
                                           
                                       </div>
                                    </div><!--./col-md-11-->
                                   </div>
                               </div><!--/.well2-->
                               <div class="h-seeMore">
                                <a class="linkReadMore text-center"><span>SHOW MORE</span></a>
                            </div>
                            <br/>
                        </div><!--/.info-->
                    </div><!--well-->
                </div> <!--/.ui-tabs-panel-->
        
                <!-- COMMENTS AREA -->
                <div class="row mg-t-10">
                    <div class="White same-H pad-v-10">
                        <div class="row">
                            <div class="content-padding">
                             @include('elements/home/videoComments')
                             </div>
                        </div>
                    </div>
                </div>
                <!-- COMMENTS AREA -->

                <!-- latest -->
                <div class="mg-b-10">
                    @include('elements/home/uploaderLatestVideo')
                </div>
            </div><!--column 8-->


            <div class="col-md-4 visible-md visible-lg">
                <div class="">
                <!--advertisement-->
                <!-- advertisment small -->
                <!--/advertisement-->
         
                <ul class="ui-tabs-nav same-H"> <!--video navigation or video list-->
                    @foreach($newRelation as $relation)
                            <li class="ui-tabs-nav-item" id="">
                                <a href="watch!v={{$relation['file_name']}}" id="videourl{{$videourl++}}">
                                <div class="row">
                                    <div class="col-md-6 col-xs-4">
                                        @if(file_exists(public_path("/videos/".$relation['uid']."-".$relation['channel_name']."/".$relation['file_name']."/".$relation['file_name'].".jpg")))
                                            <img src="/videos/{{$relation['uid']}}-{{$relation['channel_name']}}/{{$relation['file_name']}}/{{$relation['file_name']}}.jpg" alt="" width="100%" />
                                        @else
                                            <img src="/img/thumbnails/video.png" alt="" width="100%" />
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-8 col-xs-4">
                                        <div><span class="v-list text-justify">{{ Str::limit($relation['title'],50) }}</span></div>
                                        <span>by: {{$relation['channel_name']}}</span><br/>
                                        <span>{{date('M d, Y',strtotime($relation['created_at']))}}</span><br/>
                                        <span>{{number_format($videos->views)}} view/s</span>
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

<!--MODAL FOR EMBED VIDEO-->
<div class="modal fade overlay" id="embed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Embed Video</h4>
      </div>
      <div class="modal-body">
            <input type="text" class="form-control" value="<iframe width='500' height='315' src='{{asset('/')}}embed/{{$videos->file_name}}' frameborder='0' allowfullscreen></iframe>">
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <a href="{{route('user.upload.video.cancel',"v=". $videos->file_name)}}" class="btn btn-primary">Yes</a>
      </div> -->
    </div>
  </div>
</div>

@stop

