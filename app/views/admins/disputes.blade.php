@extends('layouts.admin')

@section('content')
	<div class="container page">
        <div class="row">
        	<h1>Disputes</h1>
       		<div class="dropdown">
				<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Sort
				</button>
				<ul class="dropdown-menu" aria-labelledby="dLabel">
					<li><a href="{{route('get.admin.reports')}}">Latest</a></li>
					<li><a href="{{route('get.admin.sortdisputes', 'deleted')}}">Deleted</a></li>
					<li><a href="{{route('get.admin.sortdisputes', 'all')}}">All</a></li>
				</ul>
			</div>
       	</div>
		<div class="row">
			<div class="col-md-12">
				 <br/>
				<table class="table-striped table">
					<tr class="tbHead">
						<th>#</th>
						<th>Report ID</th>
						<th>Dependant's Channel</th>
						<th>Legal Name</th>
						<th>Title / Job Position</th>
						<th>Country</th>
						<th>Signature</th>
						<th>Deleted</th>
						<th>Created</th>
						<th>Actions</th>
					</tr>
					@foreach($disputes as $dispute)
						<tr>
							<td>{{$dispute->id}}</td>
							<td><a href="{{route('get.admin.viewreports', $dispute->report_id)}}" target="_blank">{{$dispute->report_id}}</a></td> 
							<td>{{$dispute->case_number}}</td>
							<td><a href="{{route('view.users.channel', $dispute->complainants_channel)}}" target="_blank">{{$dispute->complainants_channel}}</a></td> 
							<td><a href="{{route('view.users.channel', $dispute->uploaders_channel)}}" target="_blank">{{$dispute->uploaders_channel}}</a></td> 
							<td><a href="{{route('homes.watch-video', array('v='.$dispute->video_url))}}">{{$dispute->video_title}}</a></td>
							<td>{{$dispute->legal_name}}</td>
							<td>{{$dispute->authority_position}}</td>
							<td>{{$dispute->signature}}</td>
							<?php
							if($dispute->deleted_at == NULL) $deletedat = "Not Deleted";
							if($dispute->deleted_at != NULL) $deletedat = date("M d, Y", strtotime($dispute->deleted_at));
							?>
							<td>{{$deletedat}}</td>
							<td>{{ date("M d, Y", strtotime($dispute->created_at))}}</td>
							<td>
								{{Form::open(array('style'=>'float:right','route' => array('post.admin.deletereports', Crypt::encrypt($dispute->id)),'onsubmit'=> 'return confirm("Are you sure you want to delete this?")' ))}}&nbsp;
									<span title="Delete Report">{{Form::button('<i class="fa fa-trash" ></i>', array('type' => 'submit','id' => 'favoriteVideo','class'=> 'btn-ico btn-default'))}}</span>
								{{Form::close()}}
								<a href="{{route('get.admin.viewreports', $dispute->id)}}" target="_blank" class='btn-ico btn-default fa fa-search' title="View Other Information"></a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@stop