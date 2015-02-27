@extends('layouts.default')
@section('content')
	<div class="container page">
		<div class="row">	
			<br/>
			<div class="col-md-8" style="margin-bottom:20px;">

                <img src="/img/thumbnails/v6-2.png" class="h-video">
                
			</div><!--/.col-md-8-->

			<div class="col-md-4">
                <div class="row">
                    <div class="ad1 col-md-12 col-sm-6" style="margin-bottom:20px;">
                        <img src="/img/thumbnails/ad1.png" class="adDiv">
                    </div><!--/.ad1-->
                    
                    <div class="ad2 col-md-12 col-sm-6">
                        <img src="/img/thumbnails/ad2.png" class="adDiv">
                   </div><!--/.ad2-->
                </div><!--/.row of col4-->
			</div><!--/.col-md-4-->


		</div><!--/.row 1st-->

		<br/>

		<div class="row">
			<div class="categoryHead">
	            <h3>Recommended Videos</h3>
	      	</div><!--/.recommended video-->

			<div class="col-md-12">
	            <div class="col-md-2">
	            	<img src="/img/thumbnails/v3.png" class="h-video">
	            	<div class="v-Info">
	            		5 Ways to improve your English
	            	</div>
	            	<div class="count">
	            		55 Views, 40 Likes
	            	</div>
	            </div>

	            <div class="col-md-2">
	            	<img src="/img/thumbnails/v3.png" class="h-video">
	            	<div class="v-Info">
	            		5 Ways to improve your English
	            	</div>
	            	<div class="count">
	            		55 Views, 40 Likes
	            	</div>
	            </div>

	            <div class="col-md-2">
	            	<img src="/img/thumbnails/v3.png" class="h-video">
	            	<div class="v-Info">
	            		5 Ways to improve your English
	            	</div>
	            	<div class="count">
	            		55 Views, 40 Likes
	            	</div>
	            </div>

	            <div class="col-md-2">
	            	<img src="/img/thumbnails/v3.png" class="h-video">
	            	<div class="v-Info">
	            		5 Ways to improve your English
	            	</div>
	            	<div class="count">
	            		55 Views, 40 Likes
	            	</div>
	            </div>

	            <div class="col-md-2">
	            	<img src="/img/thumbnails/v3.png" class="h-video">
	            	<div class="v-Info">
	            		5 Ways to improve your English
	            	</div>
	            	<div class="count">
	            		55 Views, 40 Likes
	            	</div>
	            </div>

	            <div class="col-md-2">
	            	<img src="/img/thumbnails/v3.png" class="h-video">
	            	<div class="v-Info">
	            		5 Ways to improve your English
	            	</div>
	            	<div class="count">
	            		55 Views, 40 Likes
	            	</div>
	            </div>
	        </div><!--/.col-md-12-->
		</div><!--/.row for recommended videos-->

		<div class="row">
			<div class="col-md-4">
				<div class="categoryHead">
					<h3>Popular</h3>
				</div>
				<div class="col-md-6">
					<img src="/img/thumbnails/v3.png" class="h-video">
					<div class="v-Info">
						5 Ways to improve your English
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
					<img src="/img/thumbnails/v9.png" class="h-video">
					<div class="v-Info">
						How to build your spoken English confidence?
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
				</div>
				<div class="col-md-6">
					<img src="/img/thumbnails/v2.png" class="h-video">
					<div class="v-Info">
						5 Ways to improve your English
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
					<img src="/img/thumbnails/v4.png" class="h-video">
					<div class="v-Info">
						How to build your spoken English confidence?
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
				</div>
				<div class="btn-pos">
					{{ link_to_route('homes.popular', 'see more..', null) }}
				</div>
			</div><!--/.col-4 for Popular-->


			<div class="col-md-4">
				<div class="categoryHead">
					<h3>Recent Uploads</h3>
				</div>
				<div class="col-md-6">
					<img src="/img/thumbnails/v3.png" class="h-video">
					<div class="v-Info">
						5 Ways to improve your English

					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
					<img src="/img/thumbnails/v9.png" class="h-video">
					<div class="v-Info">
						How to build your spoken English confidence?
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
				</div>
				<div class="col-md-6">
					<img src="/img/thumbnails/v2.png" class="h-video">
					<div class="v-Info">
						5 Ways to improve your English
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
					<img src="/img/thumbnails/v4.png" class="h-video">
					<div class="v-Info">
						How to build your spoken English confidence?
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
				</div>
				<div class="btn-pos">
					{{ link_to_route('homes.popular', 'see more..', null) }}
				</div>
			</div><!--/.col-4 for Recent Uploads-->

			<div class="col-md-4">
				<div class="categoryHead">
					<h3>Random</h3>
				</div>
				<div class="col-md-6">
					<img src="/img/thumbnails/v3.png" class="h-video">
					<div class="v-Info">
						5 Ways to improve your English

					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
					<img src="/img/thumbnails/v9.png" class="h-video">
					<div class="v-Info">
						How to build your spoken English confidence?
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
				</div>
				<div class="col-md-6">
					<img src="/img/thumbnails/v2.png" class="h-video">
					<div class="v-Info">
						5 Ways to improve your English
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
					<img src="/img/thumbnails/v4.png" class="h-video">
					<div class="v-Info">
						How to build your spoken English confidence?
					</div>
					<div class="count">
						55 Views, 40 Likes
					</div>
					<br>
				</div>
				<div class="btn-pos">
					{{ link_to_route('homes.popular', 'see more..', null) }}
				</div>
			</div><!--/.col-4 for random-->

		</div><!--/.row for threee categories-->

	</div><!--/.container page-->

@stop