@extends('layouts.partner')

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

<div class="top-bg"></div>

<div class="paper_wrap" data-sticky_parent="" style="position: relative;">
    <div class="col-md-10 col-md-offset-1">
        <div class="col-md-8">
            <div class="paper">
                <div class="content-padding">
                    <div class="icons_style pull-right">
                        <img src="/img/icons/par-upload.png"><img src="/img/icons/par-earn.png"><img src="/img/icons/par-share.png">
                    </div>
    				<div class="row text-justify">
                        <h2 class="blueC">Introduction:</h2>
                        <p>
                        If you are a copyright holder of videos and host these on TEFLtv, then you are eligible to become a TEFLtv partner and monetize your videos. In other words; make money from the ads shown before, during or at the end of your videos. For more information about copyright, please follow this <a href="{{route('homes.copyright')}}">link. </a> 
                        </p>
                        <p>
                        If you don’t own copyrights of videos but still want the possibility to monetize them, please follow this link to our <a href="{{route('publishers.index')}}">publishers’ page.</a>
                        </p>
                        <br/>
                        <h2 class="blueC">How can I become a partner? </h2>
                        <p>
                        To become a TEFLtv partner, you need to sign up as a “partner”. You can signup here.
                        </p>
                        <p>
                        You will also need an AdSense account.
                        </p>
                        <br/>
                        <h2 class="blueC">Why do I need an AdSense account? </h2>
                        <p>
                        There are a few reasons why you need an AdSense account before you can become a Partner. The tools that come with AdSense are important to keep track of your revenue, and of course Google AdSense has a proven track record of being a reliable partner.  You will have the tools that give you reports you can trust. This way, there is never any confusion about your earnings from advertisements on our website.  
                        </p>
                        <br/>
                        <h2 class="blueC">More information about our program. </h2>
                        <p>
                        We like our partners to inform themselves about the many facets of our program. Therefore, we encourage current and prospective partners to read our <a href="{{route('partners.termsandconditions')}}">Terms and conditions</a> and <a href="{{route('homes.privacy')}}">Privacy </a> statements. This way, you know what we expect from you and what you can expect from us.
                        </p>


    					<br/>
    					<hr/>
    					<h3>Start earning money. <a href="{{route('partners.verification')}}">Become a Partner Now!</a></h3>

    				</div>
    			</div>
    		</div>
    	</div>
		<div class="col-md-4">
            
				@include('elements/partners/video')
				<br/>
            
				@include('elements/partners/support')
          
		</div>
	</div>
</div>
@stop


