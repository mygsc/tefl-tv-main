@extends('layouts.admin')



@section('content')
	<div class="container">
		<h1><center>Admins Index</center></h1>
		{{ link_to_route('admin.logout', 'Logout', null, array('class' => 'btn btn-danger')) }}
		{{ link_to_route('get.admin.changepassword', 'Change Password', null, array('class' => 'btn btn-danger')) }}
		{{ link_to_route('get.admin.recommendedvideos', 'Recommended Videos', null, array('class' => 'btn btn-danger')) }}
	</div>
@stop