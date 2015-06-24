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
<div class="page_wrapper">
	<div class="top-bg">
	</div>
</div>
<div class="absolute-wrapper_2">
    <div class="col-md-10 col-md-offset-1">
    	<div class="col-md-8">
    		<div class="paper White">
    			<div class="row content-padding ">
    				<br/><br/>
    				<div class="content-padding">
    					<div class="col-md-12 text-justify">

    						<h1 class="orangeC">Partner's Privacy</h1>
    						<p class="text-justify">
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    							proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam,
    							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo. Lorem ipsum dolor sit amet, consectetur adipisicing elit
    							consequat.
    						</p>
    						<br/>
    						<p class="text-justify">
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    							cillum dolore eu fugiat nulla pariatur.
    						</p>
    					</div>
    					<div class="col-md-12">
    						<h3 class="orangeC">Perks of being a TEFLTV Partner</h3>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua, ut labore et dolore magna aliqua.
    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua ut labore et dolore magna aliqua..
    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.
    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    						</li>
    						<h3 class="orangeC">How to become a TEFLTV Partner?</h3>
    						<p class="text-justify">
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    						</p>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.Excepteur sint occaecat cupidatat non
    							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.Excepteur sint occaecat cupidatat non

    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.
    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.Excepteur sint occaecat cupidatat non
    							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.
    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.Excepteur sint occaecat cupidatat non
    							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    						</li>
    						<br/>
    						<li>
    							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    							tempor incididunt ut labore et dolore magna aliqua.
    						</li>
    						<br/>
    						<hr/>
    						<h3>Start earning money. <a href="">Become a Partner Now!</a></h3>
    						
    						<br/><br/>
    					</div>
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


