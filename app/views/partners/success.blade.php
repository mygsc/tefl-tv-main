@extends('layouts.partner')

	@section('title')
        Success | TEFLTV Partners
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
<div class="page_wrapper">
	<div class="top-bg">
	</div>
</div>
<div class="absolute-wrapper_2">
    <div class="col-md-8 col-md-offset-2">
    		<div class="paper_2 White text-center">
			
			<!--for publisher-->
			<div class="message-wrap">

				<h1 class="blueC message-text">Hi {{Auth::User()->channel_name}}!</h1>
				<h2>
					Congratulations you just became a TEFLTV partner.
					<!--{{Session::get('partnership_type')}}-->
					<br/>
					We are excited for you! Go upload, share or embed your videos and start earning now!
				</h2>
				<div class="message-link">
				<a href="{{route('homes.index')}}">TEFLTV Home</a> | <a href="{{route('get.upload')}}">Upload</a> | <a href="{{route('partners.faqs')}}">FAQs</a> | <a href="{{route('homes.aboutus')}}">Contact Us</a>
				</div>
				<hr/>
				<div class="icons_style ">
                      <img src="/img/icons/par-upload.png"><img src="/img/icons/par-earn.png"><img src="/img/icons/par-share.png">
                   </div>
			</div>
			<!--for partner
			<div class="text-center good">
				<h3>
					Congratulations you just became a TEFLTV Partner.
					<br/>
					We are excited for you! Go upload, share, embed your vidoes and start earning now!
				</h3>
				<a href="">Go to your TEFLTV channel.</a>
			</div>-->
		</div>
	</div>
</div>

@stop