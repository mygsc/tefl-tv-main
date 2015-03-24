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
                            <p class="black">
                               video title
                            </p>
                            <!--video paler-->
                           <img src="/img/thumbnails/vp.png">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <br/>
                                        <span class="">
                                            <span id="views-counter">11</span> View(s) &nbsp;&nbsp;|&nbsp;&nbsp;
                                            <span id="like-counter">12ike(s)</span>&nbsp;
                                           
                                            <span id = "like-span">
                                                <i class="fa fa-thumbs-down hand" id="unlike"></i>&nbsp;&nbsp;|&nbsp;&nbsp;
                                            </span>
                                        
                                            <span id = "like-span">
                                                <i class="fa fa-thumbs-up hand" title="like this" id="like"></i>&nbsp;&nbsp;|&nbsp;&nbsp;
                                            </span>
                                           
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
                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                      

                                            <span class="dropdown" id="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p style="display:inline;"><i class="fa fa-plus hand"></i>&nbsp;&nbsp;Add to</p>
                                                </a>
                                                <span class="dropdown-menu White noclose" style="padding:5px 5px;text-align:left;">

                                                 
                                                    <li id="favotite-list"><p id="addToFavorites" style="cursor: pointer"><img src="img/icons/star.png"/>&nbsp;&nbsp;Favorites</p></li>
                                                   
                                                    <li id="favotite-list"><p id="removeToFavorites" style="cursor: pointer"><img src="img/icons/starActive.png"/>&nbsp;&nbsp;Favorites</p></li>
                                                    
                                                    <li id="watchlater-list"><p id="addToWatchLater" style="cursor: pointer"><img src="img/icons/clock.png"/>&nbsp;&nbsp;Watch Later</p></li>
                                                 
                                                    <li id="watchlater-list"><p id="removeToWatchLater" style="cursor: pointer"><img src="img/icons/clockActive.png"/>&nbsp;&nbsp;Watch Later</p></li>
                                                  
                                                    <li id="list"><p id="label-playlist"><i class="fa fa-list" ></i>&nbsp;&nbsp;Playlist</p>

                                                      
                                                        <ul></ul>

                                                        <button id="createPlaylist" class="btn btn-unsub">Create New Playlist</button>
                                                    </li>
                                                </span>
                                            </span><!--/.dropdown add to-->


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
                                                <span>Channel Name<small>(150,000 Followrs)</small>
                                                    <a class="btn btn-primary btn-sm pull-right"><span style="color:#fff!Important;font-family:Arial;">Subscribe</span></a>
                                                </span>
                                            </h2> 
                                            <p>Posted on <b>date</b> &nbsp; </p>
                                            <div class="seeVideoContent">
                                                <p>
                                                  description
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
                        <span class="pull-left" style="font-size:1.4em;"><i class="fa fa-chevron-circle-left"></i></span>
                        <span class="pull-right" style="font-size:1.4em;"><i class="fa fa-chevron-circle-right"></i></span>
                    </div>
                </div>
                <!--/search result-->
                <ul class="ui-tabs-nav"> <!--video navigation or video list-->
                    <li class="ui-tabs-nav-item" id="">
                        <a href="" id="">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="/img/thumbnails/v1.jpg" />    
                                </div>
                                <div class="col-md-8">
                                    <span>title</span><br/>
                                    <span>by: </span><br/>
                                    <small>date</small>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul><!--video list--> 
            </div><!--col-md-4-->
        </div><!--/.featured-->
    </div><!--/.row-->
</div><!--/padding-->
</div><!--/.row-->
@stop


