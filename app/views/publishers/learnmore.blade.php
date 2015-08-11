@extends('layouts.publisher')

    @section('title')
        Learn More | TEFLTV Publisher
    @stop

	@section('meta')
			
	@stop
	@section('css')
		{{HTML::style('css/vid.player.min.css')}}
	@stop
	@section('some_script')
	{{HTML::script('js/video-player/media.player.min.js')}}
	{{HTML::script('js/video-player/fullscreen.min.js')}}
@stop

@section('content')
<div  class="top-bg">

</div>
<div class="paper_wrap" data-sticky_parent="" style="position: relative;">
    <div class="col-md-10 col-md-offset-1">
        <div class="col-md-8 ">
            <div class="paper">
                <div class="content-padding">
                    <div class="icons_style pull-right">
                        <img src="/img/icons/select-ico.png"><img src="/img/icons/share-ico.png"><img src="/img/icons/earn-ico.png">
                    </div>
                    <div class="row text-justify">

                        <h2 class="orangeC">Introduction:</h2>

                        <p>
                        If you don’t own the copyright rights but still like to monetize video, you can become a tefltv publisher. For more information about copyright, please follow this <a href="{{route('homes.copyright')}}"> link.</a> 
                        </p>
                        <p>
                        If you own copyrights of videos and want the possibility to monetize them, please follow this link to our <a href="{{route('partners.index')}}"> partner page</a>.
                        </p>
                        <br/>
                        <h2 class="orangeC">How can I become a publisher?</h2>
                        <p>
                        To become a TEFLtv publisher, you need to sign up as a “Publisher”. You can <a href="{{route('publishers.verification')}}">signup here</a>.
                        </p>
                        <p>
                        You will also need an AdSense account.
                        </p>
                        <br/>

                        <h2 class="orangeC">Why do I need an AdSense account?</h2>
                        <p>
                        There are a few reasons why you need an AdSense account before you can become a Publisher. The tools that come with AdSense are important to keep track of your revenue, and of course Google AdSense has a proven track record of being a reliable partner.  You will have the tools that give you reports you can trust. This way, there is never any confusion about your earnings from advertisements on our website.  
                        </p>
                        <br/>

                        <h2 class="orangeC">More information about our program.</h2>
                        <p>
                        We like our publishers to inform themselves about the many facets of our program. Therefore, we encourage current and prospective publishers to read our <a href="{{route('publishers.termsandconditions')}}">Terms and conditions</a> and <a href="{{route('homes.privacy')}}">Privacy</a> statements-. This way, you know what we expect from you and what you can expect from us.
                        </p>

                        <br/>
                        <hr/>
                        <h3>Start earning money. <a href="{{route('publishers.verification')}}">Become a Publisher Now!</a></h3>

                        <br/><br/>
                 </div>
    			</div>
    		</div>
    	</div>
        <div class="col-md-4">
            @include('elements/publishers/video')
            <br/>
            @include('elements/publishers/support')
        </div>
    </div>
</div>
@stop


