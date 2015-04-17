@extends('layouts.default')
@section('meta')
    <meta property="og:title" content="{{$videos->title}}">
        <meta property="og:site_name" content="test.tefltv.com">
        <meta property="og:description" content="{{$videos->description}}">
        <meta property="og:url" content="http://www.test.tefltv.com/watch!v={{$videos->file_name}}">
        <meta property="og:image" content="/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}.jpg">
        <!-- <meta property="og:type" content="video">
        <meta property="og:video:width" content="500"> 
        <meta property="og:video:height" content="300"> 
        <meta property="og:video" content="/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}.mp4">  -->
@stop
@section('css')
{{HTML::style('css/vid.player.css')}}
@stop

{{-- */$videourl = 1;/* --}}
{{-- */$playlistCounter = 1;/* --}}
{{-- */$playlistCounter2 = 1;/* --}}
@section('some_script')
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/homes/watch.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/homes/comment.js')}}

<script type="text/javascript">
    $(document).ready(function(){
        $(".linkReadMore").click(function(){
            $(".linkReadMore span").html($(".linkReadMore span").html() == 'SHOW VIDEO STORY' ? 'HIDE VIDEO STORY' : 'SHOW VIDEO STORY');
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

<div class="row White">
<div class="container page">
    <div class="content-padding">
        <div class="row">
            <div id="featured" > 
                <div class="col-md-8">
                    <br/>
                    <div id="" class="ui-tabs-panel" style="">
                        <div class="well">
                            <!--video paler-->
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
                                                            <li>{{ Form::checkbox($playlistNotChosen->name,Crypt::encrypt($playlistNotChosen->id),null,array('id'=>'availablePlaylist'.$playlistCounter2++))}} &nbsp; {{$playlistNotChosen->name}}</li>
                                                            @endforeach
                                                        </ul>    
                                                        @else
                                                        {{ Form::text('search', null, array('id' => 'search-playlist', 'placeholder' => 'Search Playlist', 'class' => 'form-control c-input ')) }}
                                                        <ul style="list-style:none;margin-left:-30px;" id="list-checkbox">
                                                            @foreach($playlists as $playlist)
                                                            <li>{{ Form::checkbox($playlist->name,Crypt::encrypt($playlist->id),null,array('id'=>'playlist'.$playlistCounter++,'checked'=>'true'))}} &nbsp; {{$playlist->name}}</li>
                                                            @endforeach

                                                            @if(!empty($playlistNotChosens))
                                                            @foreach($playlistNotChosens as $playlistNotChosen)
                                                            <li>{{ Form::checkbox($playlistNotChosen->name,Crypt::encrypt($playlistNotChosen->id),null,array('id'=>'availablePlaylist'.$playlistCounter2++))}} &nbsp; {{$playlistNotChosen->name}}</li>
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
                                                    <a target="_blank" href="http://www.facebook.com/share.php?u=www.test.tefltv.com/watch!v= {{$videos->file_name}}&title={{$videos->title}}"><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a>
                                                    <a target="_blank" href="http://twitter.com/home?status= {{$videos->title}}+www.test.tefltv.com/watch!v= {{$videos->file_name}}"> <i class="socialMedia socialMedia-twitter" title="Share on Twitter"></i></a>
                                                    <a target="_blank" href="https://plus.google.com/share?url=www.test.tefltv.com/watch!v={{$videos->file_name}}"><i class="socialMedia socialMedia-googlePlus" title="Share on Google+"></i></a>
                                                </span><!--/.dropdown-menu pull-right White-->
                                            </span><!--/.dropdown share-->
                                            
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                            <a href="#embed" data-toggle="modal" class="black"><p class="inline"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-right"></i>&nbsp;&nbsp;Embed</p></a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                 <span class="">
            
                                                    <span id="like-counter"><p class="inline">{{$likeCounter}}</p></span>&nbsp;
                                                    @if(isset(Auth::User()->id))
                                                        @if(!empty($like))
                                                        <span id = "like-span">
                                                            <i class="fa fa-thumbs-down hand" id="unlike"></i>
                                                        </span>
                                                        @else
                                                        <span id = "like-span">
                                                            <i class="fa fa-thumbs-up hand" title="like this" id="like"></i>
                                                        </span>
                                                        @endif
                                                    @else
                                                      <i class="fa fa-thumbs-up hand" title="like this" ></i>
                                                    @endif                                                    
                                                </span><!--/links-->
                                            </div>
                                            
                                        </div>  
                                        </div>
                                       
                                </div><!--/.col-md-5-->
                            </div><!--/.row-->
                            <br/>
                            <div class="row" id="alert-playlist"></div>
                            <div class="info" >
                                <div class="well2">
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
                                                @else
                                                    {{link_to_route('homes.signin', 'Subscribe', '', array('class'=>'btn btn-primary btn-sm pull-right')); }}
                                                @endif
                                            </span>
                                        </p> 
                                        <p>Posted on <b>{{$videos->created_at->toFormattedDateString()}}</b> &nbsp; </p>
                                        <div class="seeVideoContent">
                                            <p>
                                               {{$videos->description}}

                                           </p>
                                       </div>
                                    </div><!--./col-md-11-->
                                   </div>
                               </div><!--/.well2-->
                               <div class="seeMore">
                                <a class="linkReadMore text-center"><span>SHOW VIDEO STORY</span></a>
                            </div>
                        </div><!--/.info-->
                    </div><!--well-->
                    <br/>
                </div> <!--/.ui-tabs-panel-->

                <!-- COMMENTS AREA -->
                <div class="well">
                    <div class="row">
                        <div class="content-padding">
                         @include('elements/home/videoComments')
                         </div>
                    </div>
                </div>
                <!-- COMMENTS AREA -->

                <!-- latest -->
                @include('elements/home/uploaderLatestVideo')
            </div><!--column 8-->


            <div class="col-md-4 visible-md visible-lg">
                <!--advertisement-->
                <!-- advertisment small -->
                <!--/advertisement-->
               <br/>
                <ul class="ui-tabs-nav"> <!--video navigation or video list-->
                    @foreach($newRelation as $relation)
                        @if($relation->id != $videos->id)
                            <li class="ui-tabs-nav-item" id="">
                                <a href="watch!v={{$relation->file_name}}" id="videourl{{$videourl++}}">
                                <div class="row">
                                    <div class="col-md-6 col-xs-4">
                                    @if(file_exists(public_path("/videos/".$relation->uid."-".$relation->channel_name."/".$relation->file_name."/".$relation->file_name.".jpg")))
                                    <img src="/videos/{{$relation->uid}}-{{$relation->channel_name}}/{{$relation->file_name}}/{{$relation->file_name}}.jpg" alt="" width="100%" />
                                    @else
                                    <img src="/img/thumbnails/video.png" alt="" width="100%" />
                                    @endif
                                    </div>
                                    <div class="col-md-6 col-sm-8 col-xs-4">
                                        <div ><span class="v-list">{{ Str::limit($relation->title,50) }}</span></div>
                                        <span>by: {{$relation->channel_name}}</span><br/>
                                        <span>{{date('m-d-Y',strtotime($relation->created_at))}}</span>
                                    </div>
                                </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul><!--video list-->

                    
                    @include('elements/home/carouselAds')
                    @include('elements/home/recommendedChannelList')
            </div><!--col-md-4-->

        </div><!--/.featured-->

    </div><!--/.row-->
</div><!--/padding-->
 <br/><br/><br/> 
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
            <input type="text" class="form-control" value="<iframe width='500' height='315' src='http://www.test.tefltv.com/embed/{{$videos->file_name}}' frameborder='0' allowfullscreen></iframe>">
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <a href="{{route('user.upload.video.cancel',"v=". $videos->file_name)}}" class="btn btn-primary">Yes</a>
      </div> -->
    </div>
  </div>
</div>

@stop


