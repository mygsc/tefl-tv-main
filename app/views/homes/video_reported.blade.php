
@extends('layouts.default')

@section('title')
    TEFL Tv Videos
@stop

@section('meta')
    <meta name="robots" content="noindex">
    <meta name="robots" content="noindex">
    <meta name="referrer" content="origin">
    <meta name="title" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
@stop

@section('css')
    {{HTML::style('css/vid.player.min.css')}}
@stop

@section('some_script')
{{HTML::script('js/jquery.min.js')}}
@stop

@section('content')
<div class="row">
<div class="container ">
    <div class="">
        <div class="row mg-t-10">
            <div id="featured" > 
                <br/><br/><br/><br/><br/><br/>
                <div class="col-md-10 col-md-offset-1">
                    <div class="">
                        <img src="/img/errorBg.png" width="100%" class="same-H">
                        <div id="" class=" rem-div pad-s-20" style="">
                            <!--video paler-->
                            <br/>
                            <div id='ablockVideoPlayer'>
                                <h1 class="text-center whiteC">This video has been removed because its content violated TEFLTV's Terms of Service.</h1>
                                <hr/>
                                <center>
                                   
                                </center>
                            </div>
                            <br/>
                        </div><!--/.info-->
                    </div><!--well-->
                </div> <!--/.ui-tabs-panel-->
            </div><!--column 8-->
        </div><!--col-md-4-->
    </div><!--/.featured-->
    </div><!--/.row-->
</div><!--/padding-->
</div><!--/.row-->

</div>
@stop
