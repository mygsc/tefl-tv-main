<br/>
<div class="row">
	<div class="col-md-12">
		<div class="" id="about">
			<div class="col-md-12 LighterBlue">
			<h3 class="tBlue text-center">-Interests-</h3>
			<div class="well2">
				<p class="text-justify">
					{{$usersChannel->interests}}
				</p>
				</div>
			</div>
		</div>
	
		<div class="col-md-12 LightestBlue">
			<h3 class="tBlue text-center">-Personal Information-</h3>
			<div class="well2">
				<table class="tableLayout">
					<tr class="">
						<td width="20%"><small><label>Name</label></small> </td>
						<td width="5%"><b>:</b></td>
						<td width="75%">{{$usersChannel->first_name}} {{$usersChannel->last_name}}</td>
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
				</table>
			</div>
		</div>
		<div class="col-md-12 LighterBlue">
			<h3 class="tBlue text-center">-Contact Information-</h3>
			<div class="well2">
				<table class="tableLayout">
					
					<tr>
						<td width="20%"><small><label>Email</label></small> </td>
						<td width="5%"><b>:</b></td>
						<td width="75%">{{Auth::User()->email}}</td>
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
						<td><small><label>Zip Code</label></small></td>
						<td><b>:</b></td>
						<td>{{$usersChannel->zip_code}}</td>
					</tr>
					
				</table>
			</div>
		</div>
		<div class="col-md-12 LightestBlue">
			<h3 class="tBlue text-center">-Address-</h3>
			<div class="well2">
				<table class="tableLayout">
					<tr>
						<td width="20%"><small><label>Address</label></small></td>
						<td width="5%"><b>:</b></td>
						<td width="75%">{{$usersChannel->address}}</td>
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
						<td><small><label>Country</label></small></td>
						<td><b>:</b></td>
						<td>{{$usersChannel->country_id}}</td>
					</tr>
				</table>
			</div>
		</div>
		


		</div><!--/.tabpanel-->
	</div><!--/.tab-content-->
</div>