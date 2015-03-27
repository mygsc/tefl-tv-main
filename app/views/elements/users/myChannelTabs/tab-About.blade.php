<br/>
<div class="row">
	<div class="col-md-12">
		<div class="well" id="about" style="margin:20px 20px;">
			<div class="" >
				<h3 class="tBlue">-Interests-</h3>
				<p class="text-justify">
					{{$usersChannel->interests}}
				</p>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="well-2" style="margin:20px 30px;">
		<h3 class="tBlue">-Personal Information-</h3>
			<table class="tableLayout">
				<tr>
					<td width="10%"><small><label>Name</label></small> </td>
					<td width="5%"><b>:</b></td>
					<td>{{$usersChannel->first_name}} {{$usersChannel->last_name}}</td>
				</tr>
				<tr>
					<td><small><label>Birthdate</label></small></td>
					<td><b>:</b></td>
					<td>{{$usersChannel->birthdate}}</td>
				</tr>
				<tr>
					<td><small><label>Organizations</label></small></td>
					<td><b>:</b></td>
					<td>{{Auth::User()->organization}}</td>
				</tr>
				<tr>
					<td><small><label>Work</label></small></td>
					<td><b>:</b></td>
					<td>{{$usersChannel->work}}</td>
				</tr>

				<tr>
					<td><small><label>Email</label></small> </td>
					<td><b>:</b></td>
					<td>{{Auth::User()->email}}</td>
				</tr>
				<tr>
					<td><small><label>Website</label></small></td>
					<td><b>:</b></td>
					<td>{{Auth::User()->website}}</td>
				</tr>
				<tr>
					<td><small><label>Contact Number</label></small></td>
					<td><b>:</b></td>
					<td>{{$usersChannel->contact_number}}</td>
				</tr>
				<tr>
					<td><small><label>Address</label></small></td>
					<td><b>:</b></td>
					<td>{{$usersChannel->address}}</td>
				</tr>

				<tr>
					<td><small><label>City</label></small> </td>
					<td><b>:</b></td>
					<td>{{$usersChannel->city}}</td>
				</tr>
				<tr>
					<td><small><label>State</label></small></td>
					<td><b>:</b></td>
					<td>{{$usersChannel->state}}</td>
				</tr>
				<tr>
					<td><small><label>Zip Code</label></small></td>
					<td><b>:</b></td>
					<td>{{$usersChannel->zip_code}}</td>
				</tr>
				<tr>
					<td><small><label>Country</label></small></td>
					<td><b>:</b></td>
					<td>{{$usersChannel->country_id}}</td>
				</tr>
			</table>

		</div><!--/.tabpanel-->
	</div><!--/.tab-content-->
</div>