@extends('layouts.admin')

@section('content')
	<div class="container page">
		<div class="content-padding">
			<div class="col-md-6">
				<h1>Users</h1>
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
			<table class="table-striped table">
				<tr class="tbHead">
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
						<?php
							if($user->verified == 0) $verified = "Not Verified";
							if($user->verified == 1) $verified = "Verified";
							if($user->status == 0) $status = "Not Activated";
							if($user->status == 1) $status = "Activated";
							if($user->status == 2) $status = "Banned";
							if($user->role == 1) $role = "User";
							if($user->role == 2) $role = "admin";
						?>
						<td>{{$user->id}}</td>
						<td>{{$user->email}}</td>
						<td><a href="http://localhost:8000/channel/{{$user->channel_name}}" target="_blank">{{$user->channel_name}}</a></td> 
						<!--Hindi pa na fifinalize ung link kaya static muna-->

						<td>{{$verified}}</td>
						<td>{{$status}}</td>
						<td>{{$role}}</td>
						<td>{{ date("M d, Y H:ma", strtotime($user->created_at))}}</td>
					</tr>
				@endforeach
			</table>
		</div>
	
	</div>
@stop