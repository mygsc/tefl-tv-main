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
		</div><!--searchbox-->
		<br/>

		<div class="subscriptions">
			<div class="row">
				<br/>	
				<table class="table">
					<tr class="divHeading">
						<td>{{ Form::checkbox(false)}}</td>
						<td>
							<select>
								<option>Actions</option>
							</select>
						</td>
						<td class="text-center">
							Send me updates
						</td>
						<td class="text-center">
							Actvity Feeds
						</td>
						<td class="text-right">
							Subscribe/Unsubscribe
						</td>
					</tr>
					@foreach($subscriptionLists as $SubscriptionList)
					<tr>
						<td>{{ Form::checkbox(false)}}</td>
						<td>
							<img src="/img/user/u1.png" class="userRep2">&nbsp;
							<span><b>{{$SubscriptionList[0]['first_name']}} {{$SubscriptionList[0]['last_name']}}</b></span>&nbsp;
						</td>
						<td class="text-center">{{ Form::checkbox(false)}}</td>
						<td class="text-center">
							<select>
								<option>All Activities</option>
							</select>
						</td>
						<td class="text-center"><button class="btn btn-unsub btn-xs pull-right">Unsubscribe</button></td>
					</tr>
					@endforeach
				</table>
			</div><!--/.row-->
		</div><!--/.subscription-->
	</div>
</div>