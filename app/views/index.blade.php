@extends('layouts.default')
<<<<<<< HEAD
=======
@section('content')


	<div class="footer1 ">
    <div class="container">
        <div class="row">
        <div class="col-md-7 col-xs-12">
            <span class="ctgryNav-f">
                {{ link_to_route('homes.index', 'Home', null) }}
                {{ link_to_route('homes.aboutus', 'About Us', null) }}
                {{ link_to_route('homes.advertisements', 'Advertisement', null) }}
                {{ link_to_route('homes.privacy', 'Privacy', null) }}
                {{ link_to_route('homes.termsandconditions', 'Terms and Condition', null) }}
                {{ link_to_route('homes.copyright', 'Copy Right', null) }}

        </div>
>>>>>>> fcc698b89bf11c4286b717defb50c8c3a2fc880c

@section('content')

	<div class="container page">
		<div class="row">
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
			

		</div>
	</div><!--/.container page-->

@stop