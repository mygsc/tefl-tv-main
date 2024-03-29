<div class="row White same-H side_top">
	<div class="pad-10">
		<div class="vid-wrapperb p-relative same-H">
			<div id="vid-controls">
				<div class="embed-responsive embed-responsive-16by9 n-mg-b">
					<video id="media-video" poster="/img/thumbnails/v1.png" autoplay loop muted>
						<source  src='/videos/tefltv_partners.mp4' id="mp4" type='video/mp4'/>
						<source  src='/videos/tefltv_partners.webm' id="webm" type='video/webm'/>
					</video>	
				</div><!--/embed-responsive-->
				<div class="n-mg-b">
					@include('elements/videoPlayer')
				</div>
			</div>
		</div>
	</div>
	<div style="margin-top:10px;" class="become">
		<a href="{{route('partners.verification')}}">Become a Partner now <i class="fa fa-hand-o-up"></i></a>
	</div>
</div>