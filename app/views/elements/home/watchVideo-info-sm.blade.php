<div class="row visible-sm visible-xs">
    <div class="col-md-12"><div>
        <br/>
        <div class="row">
            <div class="col-sm-12 col-xs-12 ">
                <p class="black wv-title">
                    {{$videos->title}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xs-6">
                @if($videos->views > 1)
                <p class="black wv-views" id="views-counter">{{$videos->views}} Views</p>
                @else
                <p class="black wv-views" id="views-counter">{{$videos->views}} View</p>
                @endif
            </div>
            <div class="col-sm-6 col-xs-6 text-right">
               <span class="">
                <span class='label label-primary hand' title='Like' id='video-like'><i  class="fa fa-thumbs-up hand"></i> <span id='total-like'>&nbsp;{{$totalLikesDislikes['likes']}}</span></span>
                <span class='label label-danger hand' title='Dislike' id='video-dislike'><i class="fa fa-thumbs-down hand"></i> <span id='total-dislike'>&nbsp;{{$totalLikesDislikes['dislikes']}}</span></span>
            </span><!--/links-->
        </div>  
    </div> 
    <div class="row">
        <div class="col-sm-12">
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
                    <p style="display:inline;">Add to</p>
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
                <p style="display:inline;"><i class="fa fa-plus hand"></i>&nbsp;Add to</p>
            </a>
            @endif


            &nbsp;|&nbsp;
            <a href="#" id='embed-video' class="black"><p class="inline">&nbsp;Embed</p></a>
            <!-- <a href="{{URL::route('get.complaint_form')}}" class="black"><p class="inline"><i class="fa fa-flag"></i>&nbsp;&nbsp;Report</p></a> -->
            &nbsp;|&nbsp;

            {{Form::open(array('route' => array('get.complaint_form'),'class' => 'inline'))}}
            {{Form::hidden('report_url',$report_url)}}
            <span title="Report This Video">
                <button value="Report" type="submit" class="reportLink btn-clear"> Report</button>
            </span>
            
            {{Form::close()}}                                            
            @if(Auth::check())
            @if((Auth::User()->role == 4) || (Auth::User()->role == 5))
             &nbsp;|&nbsp;
            <a href="#" id='publish-video' class="black"><p class="inline">&nbsp;Publish</p></a>
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
                
            </div>                             
            @endif
            @endif

            <div style='margin-top:5px;display:none;' class="embed-frame">
                <p>
                    <input  type="text" id='code-embed' class="form-control" value="<iframe width='500' height='315' src='{{asset('/')}}embed/{{$videos->file_name}}' frameborder='0' allowfullscreen></iframe>">
                </p>
            </div>
        </div>
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
