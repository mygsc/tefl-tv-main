@extends('layouts.default')

@section('content')

	<div class="footer1 ">
    <div class="container">
        <div class="row">
        <div class="col-md-7 col-xs-12">
            <span class="ctgryNav-f">
                {{ link_to_route('get.index', 'Home', null) }}
                {{ link_to_route('get.aboutus', 'About Us', null) }}
                {{ link_to_route('get.advertisement', 'Advertisement', null) }}
                {{ link_to_route('get.privacy', 'Privacy', null) }}
                {{ link_to_route('get.termsandconditions', 'Terms and Condition', null) }}
                {{ link_to_route('get.copyright', 'Copy Right', null) }}

        </div>

        <div class="col-md-5">
            <div class="col-md-10 col-xs-12 col-sm-9">

                <span class="text-right" >
                  
                    <span ><a href=""><img src="/img/icons/tr.png" class="pull-right hvr-float f-icon" ></a></span>
                    <span> <a href=""><img src="/img/icons/gp.png" class="pull-right hvr-float f-icon"></a></span>
                    <span><a href=""><img src="/img/icons/fb.png" class="pull-right hvr-float f-icon"></a></span>

                    
                </span>

            </div>
            
            <div class="col-md-2 col-xs-6 col-sm-3 visible-md visible-lg">
                <img src="/img/nav-effect-f.png" class="pull-right ">
            </div>
        </div>
            
        </div>
        </div>

    </div>
    
</div>

<div class="footer2">
    <span>ALL RIGHTS RESERVED 2015</span>
</div>

@stop