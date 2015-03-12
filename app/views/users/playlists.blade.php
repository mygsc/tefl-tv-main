@extends('layouts.default')

@section('content')

	<div class="container">
		<div class="row">
			<div>
				Create Playlists
				<br/>
				{{Form::open()}}
					{{Form::label('title', 'Playlist Title: ')}} &nbsp; {{Form::text('title', null, array('class' => 'form-control'))}}
					<br/>
					{{Form::submit('Create Playlist')}}
				{{Form::close()}}
			</div>
		</div>
	</div>
@stop