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
                <div class="col-md-8">
                    <div class="">
                        <div id="" class="ui-tabs-panel White pad-s-20 same-H" style="">
                            <!--video paler-->
                            <br/>
                            <div id='ablockVideoPlayer'>
                                <h2><b>This video has been removed by the user.</b></h2>
                                <hr/>
                                Sorry about that.
                                <br/>
                                <center>
                                    <img id="ablockplayer_img" src="/img/nav-effect-b.png" />
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
