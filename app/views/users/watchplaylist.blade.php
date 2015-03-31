@extends('layouts.default')

@section('css')
{{HTML::style('css/vid.player.css')}}
@stop


@section('content')

<div class="container page">
    <div class="content-padding">
        <div class="row">
            <div id="featured" > 
                <div class="col-md-8">
                    <br/>
                    <div id="" class="ui-tabs-panel" style="">
                        <div class="well">
                            <!--video paler-->
                            @include('elements/home/watch_playlist')
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="black wv-title">
                                                    {{$video->title}}
                                                </p>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <p class="black wv-views" id="views-counter">{{$video->views}} View(s)</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">

                                            </div>
                                            <div class="col-md-6 text-right">
                                                <span id="like-counter">{{$likeCounter}}</span>&nbsp;
                                           
                                                    @if(isset(Auth::User()->id))
                                                        @if(!empty($like))
                                                        <span id = "like-span">
                                                            <i class="fa fa-thumbs-down hand" id="unlike"></i>
                                                        @else
                                                        <span id = "like-span">
                                                            <i class="fa fa-thumbs-up hand" title="like this" id="like"></i>
                                                        </span>
                                                        @endif
                                                    @else
                                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                                    @endif
                                            </div>
                                        </div>

                                        <span class="">

                                        {{Form::hidden('text1',Crypt::encrypt($video->id),array('id'=>'text1'))}}
                                            @if(isset(Auth::User()->id))

                                            <span class="dropdown" id="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p style="display:inline;"><i class="fa fa-plus hand"></i>&nbsp;&nbsp;Add to</p>
                                                </a>
                                                <span class="dropdown-menu White noclose" style="padding:5px 5px;text-align:left;">

                                                    @if(empty($favorites))
                                                    <li id="favotite-list"><p id="addToFavorites" style="cursor: pointer"><img src="/img/icons/star.png"/>&nbsp;&nbsp;Favorites</p></li>
                                                    @else
                                                    <li id="favotite-list"><p id="removeToFavorites" style="cursor: pointer"><img src="/img/icons/starActive.png"/>&nbsp;&nbsp;Favorites</p></li>
                                                    @endif
                                                    @if(empty($watchLater))
                                                    <li id="watchlater-list"><p id="addToWatchLater" style="cursor: pointer"><img src="/img/icons/clock.png"/>&nbsp;&nbsp;Watch Later</p></li>
                                                    @else
                                                    <li id="watchlater-list"><p id="removeToWatchLater" style="cursor: pointer"><img src="/img/icons/clockActive.png"/>&nbsp;&nbsp;Watch Later</p></li>
                                                    @endif
                                                </span>
                                            </span><!--/.dropdown add to-->

                                            @else

                                            <a href="../signin" role="button" aria-expanded="false">
                                                <p style="display:inline;"><i class="fa fa-plus hand"></i>&nbsp;&nbsp;Add to</p>
                                            </a>
                                            @endif
                                             &nbsp;&nbsp;|&nbsp;&nbsp;
                                            <span class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p style="display:inline;"><i class="fa fa-share-alt hand"></i>&nbsp;&nbsp;Share</p>
                                                </a>
                                                <span class="dropdown-menu drop pull-right White snBg" style="padding:5px 5px;text-align:center;width:auto;">
                                                    <a href=""><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-twitter" title="Share on Twitter"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-instagram" title="Share on Instagram"></i></a>
                                                    <!--<a href=""><i class="socialMedia socialMedia-googlePlus" title="Share on Google+"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-tumblr" title="Share on Tumblr"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-flickr" title="Share on Google+"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-blogger" title="Share on Blogger"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-pinterest" title="Share on Pinterest"></i></a>-->

                                                </span><!--/.dropdown-menu pull-right White-->
                                            </span><!--/.dropdown share-->

                                        </span><!--/links-->
                                    </div>
                                </div><!--/.col-md-5-->
                            </div><!--/.row-->
                            <br/>
                            <div class="info" >
                                <div class="well2">
                                    <div class="row">
                                    @if(file_exists(public_path('/img/user/'.$owner->id.'.jpg')))
                                        <div class="col-md-1">
                                            <img src="/img/user/{{$owner->id}}.jpg" class="">
                                        </div>
                                    @else
                                        <div class="col-md-1">
                                            <img src="/img/user/0.png" class="">
                                        </div>
                                    @endif
                                        <div class="col-md-11">
                                            <h2 class="black">
                                                <span>{{$owner->channel_name}}<small>(150,000 Followrs)</small>
                                                    <a class="btn btn-primary btn-sm pull-right"><span style="color:#fff!Important;font-family:Arial;">Subscribe</span></a>
                                                </span>
                                            </h2> 
                                            <p>Posted on <b>{{$video->created_at->toFormattedDateString()}}</b> &nbsp; </p>
                                            <div class="seeVideoContent">
                                                <p>
                                                 {{$video->description}}
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
            </div><!--column 8-->


            <div class="col-md-4 visible-md visible-lg">
                <!--advertisement-->
                <!-- advertisment small -->
                <!--/advertisement-->
                <!--Display number of search results-->
                <div class="searchResult">
                    <div class="row content-padding">
                @if(empty($previousA))
                    <a href="#"><span class="pull-left" style="font-size:1.4em;"><i class="fa fa-chevron-circle-left"></i></span></a>
                @else
                    @foreach($previousA as $prev)
                            <a href="/watchplaylist={{$prev->file_name}}/{{Crypt::encrypt($prev->playlist_id)}}"><span class="pull-left" style="font-size:1.4em;"><i class="fa fa-chevron-circle-left"></i></span></a>
                    @endforeach
                @endif

                @if(empty($nextA))
                     <a href="#"><span class="pull-right" style="font-size:1.4em;"><i class="fa fa-chevron-circle-right"></i></span></a>
                @else
                    @foreach($nextA as $next)
                       <a href="/watchplaylist={{$next->file_name}}/{{Crypt::encrypt($next->playlist_id)}}"><span class="pull-right" style="font-size:1.4em;"><i class="fa fa-chevron-circle-right"></i></span></a>
                    @endforeach
                @endif
                    </div>
                </div>
                <!--/search result-->
                <ul class="ui-tabs-nav"> <!--video navigation or video list-->
                @foreach($playlistVideos as $playlistVideo)
                    @if($playlistVideo->id == $video->id)
                    <li class="ui-tabs-nav-item" id="" >
                        <a href="#" id=" " class="active">
                            <div class="row">
                                <div class="col-md-4">
                                @if(file_exists(public_path('/videos/'.$playlistVideo->user_id.'-'.$playlistVideo->channel_name.'/'.$playlistVideo->file_name.'/'.$playlistVideo->file_name.'.jpg')))
                                    <img src="/videos/{{$playlistVideo->user_id}}-{{$playlistVideo->channel_name}}/{{$playlistVideo->file_name}}/{{$playlistVideo->file_name}}.jpg"/> 
                                @else
                                    <img src="/img/thumbnails/video.png">
                                @endif
                                </div>
                                <div class="col-md-8">
                                    <span>{{$playlistVideo->title}}</span><br/>
                                    <span>by: {{$playlistVideo->channel_name}}</span><br/>
                                    <small>{{date('m/d/Y',$playlistVideo->created)}}</small>
                                    
                                </div>
                            </div>
                        </a>
                    </li>

                    @else
                     <li class="ui-tabs-nav-item" id="">
                        <a href="/watchplaylist={{$playlistVideo->file_name}}/{{Crypt::encrypt($playlistVideo->playlist_id)}}" id="">
                            <div class="row">
                                <div class="col-md-4">
                                @if(file_exists(public_path('/videos/'.$playlistVideo->user_id.'-'.$playlistVideo->channel_name.'/'.$playlistVideo->file_name.'/'.$playlistVideo->file_name.'.jpg')))
                                    <img src="/videos/{{$playlistVideo->user_id}}-{{$playlistVideo->channel_name}}/{{$playlistVideo->file_name}}/{{$playlistVideo->file_name}}.jpg" />    
                                @else
                                    <img src="/img/thumbnails/video.png">
                                @endif
                                </div>
                                <div class="col-md-8">
                                    <span>{{$playlistVideo->title}}</span><br/>
                                    <span>by: {{$playlistVideo->channel_name}}</span><br/>
                                    <small>{{date('m/d/Y',$playlistVideo->created)}}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
                @endforeach

                </ul><!--video list--> 
            </div><!--col-md-4-->
        </div><!--/.featured-->
    </div><!--/.row-->
</div><!--/padding-->
</div><!--/.row-->
@stop
@section('script')
{{HTML::script('js/jquery.js')}}
{{HTML::script('js/homes/watch.js')}}
{{HTML::script('js/media.player.js')}}
{{HTML::script('js/homes/comment.js')}}
@stop


