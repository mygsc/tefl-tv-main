@extends('layouts.default')
@section('some_script')
	{{HTML::style('css/vid.player.css')}}
	{{HTML::script('js/jquery.js')}}
	{{HTML::script('js/subscribe.js')}}
	{{HTML::script('js/media.player.min.js')}}
	{{HTML::script('js/homes/convert_specialString.js')}}

	<script type="text/javascript">
		$('.grid').click(function() {
		    $('#videosContainer #list').removeClass('col-md-12').addClass('col-md-3');
		});
		$('.list').click(function() {
		    $('#videosContainer #list').removeClass('col-md-3').addClass('col-md-12');
		});
		$(document).ready( function( $ ) {
			$('#form-add-setting').on('submit', function() {
		        //.....
		        //show some spinner etc to indicate operation in progress
		        //.....
		        $.post(
		        	$(this).prop( 'action' ),{
		        		"_token": $( this ).find( 'input[name=_token]' ).val(),
		        		"setting_name": $( '#setting_name' ).val(),
		        		"setting_value": $( '#setting_value' ).val()
		        	},
		        	function( data ) {
		                //do something with data/response returned by server
		            },'json'
		        );
		        //.....
		        //do anything else you might want to do
		        //.....

		        //prevent the form from actually submitting in browser
		        return false;
		    } );
		} );
	</script>
@stop

@section('content')
<div class="row">
	<br/>
	<div class="container pageH">
		<div class="row same-H">
			@include('elements/users/profileTop')		
			<div class="Div-channel-border White channel-content">

				<div role="tabpanel">
				  <!-- Nav tabs -->
				 	<ul class="nav nav-tabs" role="tablist">
				    	<li role="presentation" class="active">{{link_to_route('users.channel', 'Home')}}</li>
				    	<li role="presentation">{{link_to_route('users.about', 'About')}}</li>
				    	<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
				    	<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
				    	<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
				  		<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
				  		<!--<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>-->
				  		<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
				  		
				  	</ul><!--tabNav-->

				  	<!-- Tab panes -->
				    <div class="tab-content">
					  	<div role="tabpanel" class="tab-pane active" id="home">
							@include('elements/users/myChannelTabs/tab-Home')
					
					  	</div>				    
				  	</div><!--/.tab-content-->
				</div><!--/.tabpanel-->		
			</div><!--/.div-channel-border-->
			
		</div><!--/.contentpadding-->
		<br/>
	</div><!--/.container page-->
</div>

@stop

