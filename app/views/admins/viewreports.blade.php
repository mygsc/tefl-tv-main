@extends('layouts.admin')
@section('content')
<div class="container page">
	<center>
		<h2>Reports</h2>
		<br/>
		Id: {{$report->id}} <br/>
		Description: {{$report->copyrighted_description}} <br/>
		Contact Number: {{$report->contact_number}} <br/>
		Fax: {{$report->fax}} <br/>
		Street Address: Id: {{$report->streetaddress}} <br/>
		City: {{$report->city}} <br/>
		State / Province: {{$report->state_province}} <br/>
		Zip / Postal Code: {{$report->zip_postal}} <br/>
		Signature: {{$report->signature}} <br/>
	</center>
</div>
@stop