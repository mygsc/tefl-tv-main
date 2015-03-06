@extends('layouts.default')

@section('content')
	<div class="container">
		<h1><center>Recommended Videos</center></h1>
		<div class="row">
			<table>
				<tr>
					<th>ID</th>
					<th>User ID</th>
					<th>Title</th>
					<th>Views</th>
					<th>Likes</th>
					<th>Report Count</th>
					<th>Recommended</th>
					<th>Update</th>
					<th>Created</th>
				</tr>
				{{Form::open(array('route' => 'post.admin.recommendedvideos','method'=>'POST'))}}
				<?php $temp = 0; ?>
				@foreach($videos as $video)
					<tr>
						<?php
							$temp = $temp + 1;
							$checked = false;
							if($video->recommended == 1){
								$checked = true;
							}
						?>
						{{Form::hidden('id',$video->id)}}
						<td>{{$video->id}}</td>
						<td>{{$video->user_id}}</td>
						<td>{{$video->title}}</td>
						<td>{{$video->views}}</td>
						<td>{{$video->likes}}</td>
						<td>{{$video->report_count}}</td>
						<td>{{ Form::checkbox('recommended['.$video->id.']', $video->id, $checked) }}</td>
						<td>{{date("M d, Y H:ma", strtotime($video->deleted_at))}}</td>
						<td>{{ date("M d, Y H:ma", strtotime($video->created_at))}}</td>
					</tr>
				@endforeach
				{{Form::submit('Submit',array('class'=>'btn btn-primary'))}}
				{{Form::close()}}
			</table>
		</div>
		{{ link_to_route('admin.logout', 'Logout', null, array('class' => 'btn btn-danger')) }}
		{{ link_to_route('get.admin.changepassword', 'Change Password', null, array('class' => 'btn btn-danger')) }}
	</div>
@stop