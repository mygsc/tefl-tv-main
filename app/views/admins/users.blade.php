@extends('layouts.default')

@section('content')
	<div class="container">
		<h1><center>Users</center></h1>
		<div class="row">
			<table class="table">
				<tr>
					<th>ID</th>
					<th>Email</th>
					<th>Channel Name</th>
					<th>Verified</th>
					<th>Status</th>
					<th>Role</th>
					<th>Created</th>
				</tr>
				@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->email}}</td>
						<td><a href="http://localhost:8000/channel/{{$user->channel_name}}" target="_blank">{{$user->channel_name}}</a></td> 
						<!--Hindi pa na fifinalize ung link kaya static muna-->

						<td>{{$user->verified}}</td>
						<td>{{$user->status}}</td>
						<td>{{$user->role}}</td>
						<td>{{ date("M d, Y H:ma", strtotime($user->created_at))}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{ link_to_route('admin.logout', 'Logout', null, array('class' => 'btn btn-danger')) }}
		{{ link_to_route('get.admin.changepassword', 'Change Password', null, array('class' => 'btn btn-danger')) }}
	</div>
@stop