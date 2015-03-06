<br/>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="col-md-6 pull-right">
			<div class="input-group">
				{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
				<span class="input-group-btn">
					{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
				</span>
			</div>

		</div>
		<br/>
		<hr/>
		
		@foreach($subscriberLists as $subscriberList)
		<div class="subscribers">
			<div class="col-md-6">
				<img src="/img/user/u1.png" class="userRep2">&nbsp;
				<a href="{{route('view.users.channel')}}"><span><b>{{$subscriberList->first_name}} {{$subscriberList->last_name}}</b></span></a>&nbsp;
				<br/>&nbsp;
				<span>w/ <b>2k</b> Subscribers</span>&nbsp;
				<button class="btn btn-primary btn-xs pull-right">Subscribe</button>
			</div>
		</div>
		@endforeach
	</div>	
</div>