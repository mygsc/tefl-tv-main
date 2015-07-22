@extends('layouts.default')

@section('css')
{{--HTML::style('css/vid.player.min.css')--}}
@stop
@section('some_script')
  
  {{--HTML::script('js/video-player/media.player.min.js')--}}

@stop

@section('content')
    <br/>
    <div class="col-md-6 col-md-offset-3">

        <div id="carousel-2" class="carousel slide greyDark" data-ride="carousel">
            <!-- Indicators -->
          <ol class="carousel-indicators">
              <li id='active1' data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li id='active2' data-target="#carousel-example-generic" data-slide-to="1"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
                <div class="vid-wrapperb p-relative">
                    <div id="vid-controls">
                        <div class="embed-responsive embed-responsive-16by9 n-mg-b">
                            <video controls class="video-1" preload="none" id="media-video-1" poster="/img/thumbnails/v1.png">
                                <source  src='/videos/tefltv.mp4' id="mp4" type='video/mp4'/>
                                <source  src='/videos/tefltv.webm' id="webm" type='video/webm'/>
                            </video>
                        </div><!--/embed-responsive-->
                      
                  </div>
              </div>
          </div>  
           <div class="item">
            <div class="vid-wrapperb p-relative">
                <div id="vid-controls">
                    <div class="embed-responsive embed-responsive-16by9 n-mg-b">
                        <video controls class="video-2" preload="none" id="media-video-2" poster="/img/thumbnails/v10.jpg">
                            <source  src='/videos/2-test me/WUYxoVFAeC2/WUYxoVFAeC2.mp4' id="mp4" type='video/mp4'/>
                            <source  src='/videos/2-test me/WUYxoVFAeC2/WUYxoVFAeC2.webm' id="webm" type='video/webm'/>
                        </video>
                    </div><!--/embed-responsive-->
                   
              </div>
          </div>
        </div> 
         {{--  @include('elements/videoPlayer') --}}
        </div>

    <!-- Controls -->
        <a class="left carousel-control" href="#carousel-2" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-2" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>


</div>


@stop
{{HTML::script('js/jquery.min.js')}}
 <script type="text/javascript">
    $(document).ready(function(){
      document.getElementById('media-video-1').play();
        $('#carousel-2').carousel({
            interval: 100000
        });
        setInterval(function(){
          var currentSlide = $('#active1').attr('class');
           if(currentSlide == 'active'){
              document.getElementById('media-video-2').pause();
              document.getElementById('media-video-2').currentTime=0;
              document.getElementById('media-video-1').play();
          }else{
            document.getElementById('media-video-1').pause(); 
            document.getElementById('media-video-1').currentTime=0;
            document.getElementById('media-video-2').play();
          }
        },10000);
    });
 </script> 