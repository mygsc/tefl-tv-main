@extends('layouts.default')

@section('css')
{{HTML::style('css/vid.player.css')}}
@stop

{{-- */$videourl = 1;/* --}}
{{-- */$playlistCounter = 1;/* --}}
{{-- */$playlistCounter2 = 1;/* --}}

@section('content')

<div class="container page">
    <div class="content-padding">
        <div class="row">
            <div id="featured" > 
                <div class="col-md-8">
                    <br/>
                    <div id="" class="ui-tabs-panel" style="">
                        <div class="well">
                            <p class="black">
                                {{$videos->title}}
                            </p>
                            <!--video paler-->
                            @include('elements/home/watchVideo-videoPlayer')
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                     <br/>
                                        <span class="">
                                            1,800,753 Views &nbsp;&nbsp;|&nbsp;&nbsp;
                                            1,800,753 Likes&nbsp;&nbsp;<i class="fa fa-thumbs-up hand" title="like this"></i>&nbsp;&nbsp;|&nbsp;&nbsp;
                                           
                                            <span class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p style="display:inline;"><i class="fa fa-share-alt hand"></i>&nbsp;&nbsp;Share</p>
                                                </a>
                                                <span class="dropdown-menu drop pull-right White snBg" style="padding:5px 5px;text-align:center;width:auto;">

                                                    <img src="/img/icons/fb.png" class="hand" title="Share on Facebook">
                                                    <img src="/img/icons/tr.png" class="hand" title="Share on Twitter">
                                                    <img src="/img/icons/ig.png" class="hand" title="Share on Instagram">
                                                    <img src="/img/icons/yt.png" class="hand" title="Share on Youtube">
                                                    <img src="/img/icons/gp.png" class="hand" title="Share on Google+">
                                                    <img src="/img/icons/fk.png" class="hand" title="Share on Flicker">
                                                    <img src="/img/icons/tb.png" class="hand" title="Share on Tumblr">
                                                    <img src="/img/icons/ps.png" class="hand" title="Share on Pinterest">
                                                </span><!--/.dropdown-menu pull-right White-->
                                            </span><!--/.dropdown share-->
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                    @if(isset(Auth::User()->id))
                                        {{Form::hidden('text1',$id[0],array('id'=>'text1'))}}
                                        {{Form::hidden('title',$id[1],array('id'=>'title'))}}
                                            <span class="dropdown" id="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p style="display:inline;"><i class="fa fa-plus hand"></i>&nbsp;&nbsp;Add to</p>
                                                </a>
                                                <span class="dropdown-menu White noclose" style="padding:5px 5px;text-align:left;">
                                                    
                                                @if(empty($favorites))
                                                    <li><p id="addToFavorites" style="cursor: pointer"><img src="img/icons/star.png"/>
                                                @else
                                                    <li><p id="removeToFavorites" style="cursor: pointer"><img src="img/icons/starActive.png"/>
                                                @endif
                                                    &nbsp;&nbsp;Favorites</p></li>
                                                    <li><p id="addToWatchLater"><img src="img/icons/clock.png"/> &nbsp;&nbsp;Watch Later</p></li>
                                                    <li id="list"><p id="label-playlist"><i class="fa fa-list" ></i>&nbsp;&nbsp;Playlist</p>
                                                        @if(empty($playlists))
                                                        <ul style="list-style:none" id="list-checkbox">
                                                            @foreach($playlistNotChosens as $playlistNotChosen)
                                                             <li>{{ Form::checkbox($playlistNotChosen->name,Crypt::encrypt($playlistNotChosen->id),null,array('id'=>'availablePlaylist'.$playlistCounter2++))}} &nbsp; {{$playlistNotChosen->name}}</li>
                                                            @endforeach
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
                                                            @endif   
                                                            </ul>
                                                                   
                                                            <button id="createPlaylist" class="btn btn-unsub">Create New Playlist</button>
                                                    </li>
                                                </span>
                                            </span><!--/.dropdown add to-->
                                            
                                        @else

                                            <a href="signin" role="button" aria-expanded="false">
                                                <p style="display:inline;"><i class="fa fa-plus hand"></i>&nbsp;&nbsp;Add to</p>
                                            </a>
                                        @endif
                                        </span><!--/links-->
                                    </div>
                                </div><!--/.col-md-5-->
                            </div><!--/.row-->
                            <br/>
                            <div class="info" >
                                <div class="well2">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="/img/user/u3.png" class="">
                                        </div>
                                        <div class="col-md-11">
                                            <h2 class="black">
                                                <span>{{ucfirst($owner->channel_name)}} <small>(150,000 Followrs)</small>
                                                    <a class="btn btn-primary btn-sm pull-right"><span style="color:#fff!Important;font-family:Arial;">Subscribe</span></a>
                                                </span>
                                            </h2> 
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
                    @if(isset(Auth::User()->id))
                    <div class="comments row">
                        <span id='errorlabel' style='color:red;'></span>
                        <textarea id='comment'></textarea>
                        <button id='btncomment'>Post</button>

                        {{Form::hidden('commentVideo', $videoId, array('id'=>'commentVideo'))}}.
                        @if(isset(Auth::User()->id))
                            {{Form::hidden('commentUser', Auth::User()->id, array('id'=>'commentUser'))}}
                        @endif

                        <div class="commentsarea row">
                            @foreach($getVideoComments as $getVideoComment)
                                <div class="commentsarea row">
                                    {{$getVideoComment->user_id}}<br/>
                                    {{$getVideoComment->comment}}<br/>
                                    <a href='#' id='reply'>Reply</a>
                                    <span class='glyphicon glyphicon-thumbs-up'></span>
                                    <span class='glyphicon glyphicon-thumbs-down'></span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <!-- COMMENTS AREA -->

                    <!-- latest -->
               </div><!--column 8-->


               <div class="col-md-4 visible-md visible-lg">
                    <!--advertisement-->
                    <!-- advertisment small -->
                    <!--/advertisement-->
                    <!--Display number of search results-->
                    <div class="searchResult">About 288,000 results</div>
                    <!--/search result-->
                    <ul class="ui-tabs-nav"> <!--video navigation or video list-->
                        @foreach($relations as $relation)
                        @if(($relation->id != $id[0]) && ($relation->deleted_at == NULL) && ($relation->publish == 1) && ($relation->report_count < 5))
                        <li class="ui-tabs-nav-item" id="">
                           <a href="watch={{$relation->id}}%{{$relation->title}}" id="videourl{{$videourl++}}">

                            <img src="img/videoGallery/image1-small.jpg" alt="" />

                            <span>{{$relation->title}}</span><br/></a>
                            <span>by: {{$relation->channel_name}}</span><br/>
                            <small>{{$relation->created_at}}</small>

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
    {{HTML::script('js/media.player.js')}}
    {{HTML::script('js/homes/watch.js')}}
    {{HTML::script('js/homes/comment.js')}}
@stop
