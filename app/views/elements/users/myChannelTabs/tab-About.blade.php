<br/>
<div class="row">
	<div class="col-md-12">
		<div class="" id="about">
			<div class="col-md-12 grey">
				<h3 class="orangeC text-center">-Interests-</h3>
				<div class="well2">
					<p class="text-justify">
						@if(empty($usersChannel->interests))

						@else
							{{$usersChannel->interests}}
						@endif
					</p>
				</div>
			</div>
		</div>
	
		<div class="col-md-12 ">
			<h3 class="orangeC text-center">-Personal Information-</h3>
			<div class="well2">
				<table class="tableLayout">
					<tr class="">
						<td width="20%"><small><label>Name</label></small> </td>
						<td width="5%"><b>:</b></td>
						<td width="75%">{{$usersChannel->first_name}} {{$usersChannel->last_name}}</td>
					</tr>
					<tr>
						@if(empty($usersChannel->birthdate))

						@else
							<td><small><label>Birthdate</label></small></td>
							<td><b>:</b></td>
							<td>{{$usersChannel->birthdate}}</td>
						@endif
					</tr>
					<tr>
						@if(empty(Auth::User()->organization))

						@else
							<td><small><label>Organizations</label></small></td>
							<td><b>:</b></td>
							<td>{{Auth::User()->organization}}</td>
						@endif
					</tr>
					<tr>
						@if(empty($usersChannel->work))

						@else
							<td><small><label>Work</label></small></td>
							<td><b>:</b></td>
							<td>{{$usersChannel->work}}</td>
						@endif
					</tr>
				</table>
			</div>
		</div>
		<div class="col-md-12 grey">
			<h3 class="orangeC text-center">-Contact Information-</h3>
			<div class="well2">
				<table class="tableLayout">
					
					<tr>
						@if(empty(Auth::User()->email))

						@else
							<td width="20%"><small><label>Email</label></small> </td>
							<td width="5%"><b>:</b></td>
							<td width="75%">{{Auth::User()->email}}</td>
						@endif
					</tr>
					<tr>
						@if(empty(Auth::User()->website))

						@else
							<td><small><label>Website</label></small></td>
							<td><b>:</b></td>
							<td>{{Auth::User()->website}}</td>
						@endif
					</tr>
					<tr>
						@if(empty($usersChannel->contact_number))

						@else
							<td><small><label>Contact Number</label></small></td>
							<td><b>:</b></td>
							<td>{{$usersChannel->contact_number}}</td>
						@endif
					</tr>
					<tr>
						@if(empty($usersChannel->zip_code))

						@else
							<td><small><label>Zip Code</label></small></td>
							<td><b>:</b></td>
							<td>{{$usersChannel->zip_code}}</td>
						@endif
					</tr>
				</table>
			</div>
		</div>
		<div class="col-md-12">
			<h3 class="orangeC text-center">-Address-</h3>
			<div class="well2">
				<table class="tableLayout">
					<tr>
						@if(empty($usersChannel->address))

						@else
							<td width="20%"><small><label>Address</label></small></td>
							<td width="5%"><b>:</b></td>
							<td width="75%">{{$usersChannel->address}}</td>
						@endif
					</tr>
					<tr>
						@if(empty($usersChannel->city))

						@else
							<td><small><label>City</label></small> </td>
							<td><b>:</b></td>
							<td>{{$usersChannel->city}}</td>
						@endif
					</tr>
					<tr>
						@if(empty($usersChannel->state))

						@else
							<td><small><label>State</label></small></td>
							<td><b>:</b></td>
							<td>{{$usersChannel->state}}</td>
						@endif
					</tr>
					
					<tr>
						@if(empty($usersChannel->country_id))

						@else
						<td><small><label>Country</label></small></td>
						<td><b>:</b></td>
						<td>{{$usersChannel->country_id}}</td>
						@endif
					</tr>
				</table>
			</div>
		</div>

		</div><!--/.tabpanel-->
	</div><!--/.tab-content-->
</div>