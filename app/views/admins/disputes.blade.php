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
					<li><a href="{{route('get.admin.sortreports', 'deleted')}}">Deleted</a></li>
					<li><a href="{{route('get.admin.sortreports', 'all')}}">All</a></li>
				</ul>
			</div>
       	</div>
		<div class="row">
			<div class="col-md-12">
				 <br/>
				<table class="table-striped table">
					<tr class="tbHead">
						<th>ID</th>
						<th>Case Number</th>
						<th>Complainant's Channel</th>
						<th>Uploader's Channel</th>
						<th>Video Title</th>
						<th>Legal Name</th>
						<th>Title / Job Position</th>
						<!-- 		
						<th>Contact Number</th>
						<th>Fax</th>
						<th>Street Address</th>
						<th>City</th>
						<th>State / Province</th>
						<th>Zip / Postal Code</th>
						<th>Country</th> -->
						<th>Signature</th>
						<th>Deleted</th>
						<th>Created</th>
						<th>Actions</th>
					</tr>
					@foreach($reports as $report)
						<tr>
							<td>{{$report->id}}</td>
							<td>{{$report->case_number}}</td>
							<td><a href="{{route('view.users.channel', $report->complainants_channel)}}" target="_blank">{{$report->complainants_channel}}</a></td> 
							<td><a href="{{route('view.users.channel', $report->uploaders_channel)}}" target="_blank">{{$report->uploaders_channel}}</a></td> 
							<td><a href="{{route('homes.watch-video', array('v='.$report->video_url))}}">{{$report->video_title}}</a></td>
							<td>{{$report->legal_name}}</td>
							<td>{{$report->authority_position}}</td>
							<td>{{$report->signature}}</td>
							<?php
							if($report->deleted_at == NULL) $deletedat = "Not Deleted";
							if($report->deleted_at != NULL) $deletedat = date("M d, Y", strtotime($report->deleted_at));
							?>
							<td>{{$deletedat}}</td>
							<td>{{ date("M d, Y", strtotime($report->created_at))}}</td>
							<td>
								{{Form::open(array('style'=>'float:right','route' => array('post.admin.deletereports', Crypt::encrypt($report->id)),'onsubmit'=> 'return confirm("Are you sure you want to delete this?")' ))}}&nbsp;
									<span title="Delete Report">{{Form::button('<i class="fa fa-trash" ></i>', array('type' => 'submit','id' => 'favoriteVideo','class'=> 'btn-ico btn-default'))}}</span>
								{{Form::close()}}
								<a href="{{route('get.admin.viewreports', $report->id)}}" target="_blank" class='btn-ico btn-default fa fa-search' title="View Other Information"></a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@stop