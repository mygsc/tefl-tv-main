@extends('layouts.default')

@section('title')
	Search Result
@stop

@section('content')
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				@if(empty($searchResults))
					Nothing Found
				@else
					@if($type == 'playlist')
						@include('elements.home.searchs.video')
					@elseif($type == 'channel')
						@include('elements.home.searchs.video')
					@else
						@include('elements.home.searchs.video')
					@endif
				@endif
			</div>
		</div>
	</div>
@stop