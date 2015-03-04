@extends('layouts.default')



@section('content')
	<div class="container">
		<h1><center>Recommended Videos</center></h1>
		{{ link_to_route('admin.logout', 'Logout', null, array('class' => 'btn btn-danger')) }}
	</div>
@stop