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
                                           <span id="like-counter">{{$likeCounter}} Like(s)</span>&nbsp;
                                        @if(isset(Auth::User()->id))
                                            @if(!empty($like))
                                            <span id = "like-span">
                                                <i class="fa fa-thumbs-down hand" id="unlike"></i>&nbsp;&nbsp;|&nbsp;&nbsp;
                                            </span>
                                            @else
                                            <span id = "like-span">
                                                <i class="fa fa-thumbs-up hand" title="like this" id="like"></i>&nbsp;&nbsp;|&nbsp;&nbsp;
                                            </span>
                                            @endif
                                        @else
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                        @endif
                                            <span class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p style="display:inline;"><i class="fa fa-share-alt hand"></i>&nbsp;&nbsp;Share</p>
                                                </a>
                                                <span class="dropdown-menu drop pull-right White snBg" style="padding:5px 5px;text-align:center;width:auto;">
                                                    <a href=""><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-youtube" title="Share on Youtube"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-twitter" title="Share on Twitter"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-instagram" title="Share on Instagram"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-googlePlus" title="Share on Google+"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-tumblr" title="Share on Tumblr"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-flickr" title="Share on Google+"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-blogger" title="Share on Blogger"></i></a>
                                                    <a href=""><i class="socialMedia socialMedia-pinterest" title="Share on Pinterest"></i></a>
                                          
                                                </span><!--/.dropdown-menu pull-right White-->
                                            </span><!--/.dropdown share-->
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
        @if(isset(Auth::User()->id))
            {{Form::hidden('text1',Crypt::encrypt($id),array('id'=>'text1'))}}
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

                        <div class="col-md-12 commentsarea row">
                            @foreach($getVideoComments as $getVideoComment)
                                <div class="commentsarea row">
                                    {{ link_to_route('view.users.channel', $getVideoComment->channel_name, $parameters = array($getVideoComment->channel_name), $attributes = array('id' => 'channel_name')) }}
                                    <br/>
                                    {{$getVideoComment->comment}}<br/>
                                    <button id='replyLink'>Reply</button>
                                    <span class='glyphicon glyphicon-thumbs-up'></span>
                                    <span class='glyphicon glyphicon-thumbs-down'></span>
                                    <?php
                                        $getCommentReplies = DB::table('comments_reply')
                                            ->join('users', 'users.id', '=', 'comments_reply.user_id')
                                            ->where('comment_id', $getVideoComment->id)->get(); ?>

                                        <div id="replysection">REPLY:
                                            <?php
                                            foreach($getCommentReplies as $getCommentReply):
                                                echo link_to_route('view.users.channel', $getCommentReply->channel_name, $parameters = array($getCommentReply->channel_name), $attributes = array('id' => 'channel_name')) . "</br>";
                                                echo $getCommentReply->reply . "</hr>";
                                            endforeach;
                                    ?>
                                            {{Form::open(array('route'=>'post.addreply', 'id' =>'video-addReply', 'class' => 'inline'))}}
                                                {{Form::hidden('comment_id', $getVideoComment->id)}}
                                                {{Form::hidden('user_id', Auth::User()->id)}}
                                                {{Form::textarea('txtreply', '', array('class' =>'form-control hidden', 'id'=>'txtreply'))}}
                                                {{Form::submit('Reply', array('class'=> 'btn btn-primary pull-right', 'id'=>'replybutton'))}}
                                            {{Form::close()}} 
                                        </div>
                                    <hr/>
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
                        <li class="ui-tabs-nav-item" id="">
                           <a href="watch={{$relation->file_name}}" id="videourl{{$videourl++}}">

                            <img src="img/videoGallery/image1-small.jpg" alt="" />

                            <span>{{$relation->title}}</span><br/></a>
                            <span>by: {{$relation->channel_name}}</span><br/>
                            <small>{{date('m/d/Y', $relation->created_at);}}</small>

                        </li>
                        @endforeach
                    </ul><!--video list-->

                </div><!--col-md-4-->

            </div><!--/.featured-->
        </div><!--/.row-->
    </div><!--/padding-->
</div><!--/.row-->
@stop

@section('script')
    {{HTML::script('js/homes/watch.js')}}
    {{HTML::script('js/media.player.js')}}
    {{HTML::script('js/jquery.js')}}
    {{HTML::script('js/homes/comment.js')}}
@stop
