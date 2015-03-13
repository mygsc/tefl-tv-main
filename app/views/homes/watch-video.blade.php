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
                                                <span class="dropdown-menu drop pull-right White" style="padding:5px 5px;text-align:center;">
                                                    <!--facebook-->
                                                    <span style="background:#3d5a98;" class="snBg">
                                                        <img src="/img/icons/fb_i.png" class="hand" title="Share on Facebook">&nbsp;Share
                                                    </span>
                                                    <span class="snCount" style="border:1px solid #3d5a98;">
                                                        100,000
                                                    </span><!--/facebook-->
                                                    <br/><br/>
                                                    <!--google-->
                                                    <span style="background:#dd6b6b;" class="snBg">
                                                        <img src="/img/icons/gp_i.png" class="hand" title="Share on Google +">&nbsp;Share
                                                    </span>
                                                    <span style="border:1px solid #dd6b6b;" class="snCount">
                                                        100,000
                                                    </span><!--/google-->
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
                                                    <li><p><i class="fa fa-star-o"></i>&nbsp;&nbsp;Favorites</p></li>
                                                    <li id="list"><p id="label-playlist"><i class="fa fa-list" ></i>&nbsp;&nbsp;Playlist</p>
  
                                        @if(empty($playlists))
                                        <ul style="list-style:none" id="list-checkbox">
                                            @foreach($playlistNotChosens as $playlistNotChosen)
                                             <li>{{ Form::checkbox($playlistNotChosen->name,Crypt::encrypt($playlistNotChosen->id),null,array('id'=>'availablePlaylist'.$playlistCounter2++))}} &nbsp; {{$playlistNotChosen->name}}</li>
                                            @endforeach
                                        @else
                                            {{ Form::text('search', null, array('id' => 'search-playlist', 'placeholder' => 'Search Playlist', 'class' => 'form-control c-input ')) }}
                                        <ul style="list-style:none" id="list-checkbox">
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
                                                           
                                                            <button id="createPlaylist">Create New Playlist</button>
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
                                                    <a class="btn btn-primary btn-sm pull-right"><span style="color:#fff!Important;">Subscribe</span></a>
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

                    <div class="comments row">
                        <textarea id='comment'></textarea>
                        <button id='btncomment'>Post</button>
                        <div class="commentsarea row">
                            @foreach($getVideoComments as $getVideoComment)
                                {{$getVideoComment->comment}}
                            @endforeach
                        </div>
                    </div>
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
