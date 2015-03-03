
@extends('layouts.default')



{{-- */$videourl = 1;/* --}}

@section('content')
<div class="White">
    <div class="content-padding">
        <div class="row">

            <div id="featured" > 
                <div class="col-md-8">
                    <br/>
                    <div id="" class="ui-tabs-panel" style="">
                        <div class="well">
                            <!--responsive iframe-->
                            <div class="embed-responsive embed-responsive-16by9">
                                <br>
                                <video height="315" width="560" class="h-video" controls>
                                    <source src="http://localhost:8000/videos/{{$videos->file_name}}.{{$videos->extension}}" type="video/{{$videos->extension}}" >
                                    </video>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-7">
                                        <h4 class="black">
                                            {{$videos->title}}
                                        </h4>
                                    </div>
                                    <div class="col-md-5">
                                        <h4>
                                            <span class="pull-right">

                                                1,800,753 Views &nbsp;&nbsp;|&nbsp;&nbsp;
                                                1,800,753 Likes&nbsp;&nbsp;<i class="fa fa-thumbs-up hand" title="like this"></i>&nbsp;&nbsp;|&nbsp;&nbsp;

                                                <span class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                        <h4 style="display:inline;">Share&nbsp;&nbsp;<i class="fa fa-share-alt hand"></i></h4>
                                                    </a>
                                                    <span class="dropdown-menu pull-right White" style="padding:5px 5px;text-align:center;">
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
                                                    </span>


                                                </span>
                                            </span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="info" >
                                    <div class="well2">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/img/user/u3.png" class="">
                                            </div>
                                            <div class="col-md-11">
                                               
                                                <h2 class="black">
                                                    
                                                    <span>Ruth Leyne <small>(150,000 Followrs)</small>

                                                        <a class="btn btn-primary btn-sm pull-right"><span style="color:#fff!Important;">Subscribe</span></a>

                                                    </span>
                                                </h2> 
                                                <p>Posted on <b>{{$videos->created_at->toFormattedDateString()}}</b> &nbsp; </p>
                                                <div class="seeVideoContent">
                                                    <p>
                                                     {{$videos->description}}
                                                 </p>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="seeMore">
                                    <a class="linkReadMore text-center"><span>SHOW VIDEO STORY</span></a>
                                </div>
                            </div>
                        </div><!--well-->


                        
                        <br/>
                    </div> <!--/video player-->

                    <div class="row">
                        @include('elements/home/videoComments')
                    </div>
                    @include('elements/home/uploaderLatestVideo')
                </div><!--column 8-->


                <div class="col-md-4 visible-md visible-lg">
                    <!--advertisement-->
                    @include('elements/home/advertisementSmall')
                    <!--/advertisement-->
                    <!--Display number of search results-->
                    <div class="searchResult">About 288,000 results</div>
                    <!--/search result-->
                    <ul class="ui-tabs-nav"> <!--video navigation or video list-->
                        @foreach($relatedvideos as $relatedvideo)
                        <li class="ui-tabs-nav-item" id="">
                           <a href="watchvideo={{$relatedvideo[0]['id']}}%{{$relatedvideo[0]['title']}}" id="videourl{{$videourl++}}">
                            
                            <img src="img/videoGallery/image1-small.jpg" alt="" />

                            <span>{{$relatedvideo[0]['title']}}</span><br/>
                            <span>by: Ruth Leyne</span><br/>
                            <small>{{$relatedvideo[0]['created_at']}}</small>
                        </a>
                    </li>
                    @endforeach
                </ul><!--video list-->

                @include('elements/home/recommendedChannelList')
                @include('elements/home/carouselAds')

            </div><!--col 4-->

        </div>
    </div>
</div>
</div>
@stop
