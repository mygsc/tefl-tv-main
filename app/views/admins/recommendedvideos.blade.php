@extends('layouts.admin')

@section('content')
	<div class="container page">
		<div class="content-padding">
			<div class="col-md-6">
				<h1>Recommended Videos</h1>
			</div>
		</div>
		<div class="col-md-6">
			<br/>
			<div class="input-group">
                {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search User', 'class' => 'form-control c-input ')) }}
                    <div class="input-group-btn">
                        <!--simple button-->    
                        {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
                    </div><!--/.input-group-btn-->    
                {{ Form::close()}}
            </div><!--/.input-group-btn-->    
                
        </div>

		<div class="col-md-12">
			 <br/>
			<table class="table table-striped">
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
						<td><a href="http://localhost:8000/watchvideo={{$video->user_id}}%{{$video->title}}" target="_blank">{{$video->title}}</a></td> 
						<!--Hindi pa tapos ni gil ung link kaya static muna-->
						<td>{{$video->views}}</td>
						<td>{{$video->likes}}</td>
						<td>{{$video->report_count}}</td>
						<td>{{ Form::checkbox('recommended['.$video->id.']', $video->id, $checked) }}</td>
						<td>{{date("M d, Y H:ma", strtotime($video->updated_at))}}</td>
						<td>{{ date("M d, Y H:ma", strtotime($video->created_at))}}</td>
					</tr>
				@endforeach
				<div class="text-right">
					{{Form::submit('Set Recommended Videos',array('class'=>'btn btn-primary'))}}
				</div>
				<br/>
				{{Form::close()}}
			</table>
		</div>
	</div>
	</div>
@stop