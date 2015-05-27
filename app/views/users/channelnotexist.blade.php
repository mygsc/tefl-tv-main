@extends('layouts.default')

@section('content')

<div class="container page">
	<br/>
	<div class="row">
		<div style="border:5px solid #8b9dc1;" class="shadow">
		
			<div class="col-md-2 hidden-xs">
				<div class="row">
					<div class="crop-square">
						{{HTML::image('http://www.fm-base.co.uk/forum/attachments/football-manager-2014-manager-stories/618828d1403554937-ups-downs-building-one-default_original_profile_pic.png'. '.jpg', 'alt', array('class' => 'pic-Dp'))}}
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">

					<div class="" style="background-image:url('/img/user/cover.jpg'); height:224px;">
						<div class="">
							<div class="overlay-cover">
								This channel does not exist.
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>

		<br/>
	</div><!--/.contentpadding-->
	<br/>
</div><!--/.container page-->

@stop
@section('script')
	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
	{{HTML::script('js/subscribe.js')}}
@stop