@extends('layouts.default')

@section('content')
	<div class="container">
		<h1><center>Reported Videos</center></h1>
		<div class="row">
			<table class="table">
				<tr>
					<th>ID</th>
					<th>User ID</th>
					<th>Title</th>
					<th>Views</th>
					<th>Likes</th>
					<th>Report Count</th>
					<th>Update</th>
					<th>Created</th>
				</tr>
				@foreach($videos as $video)
					<tr>
						<td>{{$video->id}}</td>
						<td>{{$video->user_id}}</td>
						<td><a href="http://localhost:8000/watchvideo={{$video->user_id}}%{{$video->title}}" target="_blank">{{$video->title}}</a></td> 
						<!--Hindi pa tapos ni gil ung link kaya static muna-->
						<td>{{$video->views}}</td>
						<td>{{$video->likes}}</td>
						<td>{{$video->report_count}}</td>
						<td>{{date("M d, Y H:ma", strtotime($video->deleted_at))}}</td>
						<td>{{ date("M d, Y H:ma", strtotime($video->created_at))}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{ link_to_route('admin.logout', 'Logout', null, array('class' => 'btn btn-danger')) }}
		{{ link_to_route('get.admin.changepassword', 'Change Password', null, array('class' => 'btn btn-danger')) }}
	</div>
@stop