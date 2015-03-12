@extends('layouts.default')

@section('content')
<div class="container page">
	<br/>
	<div class="row">
		@include('elements/users/profileTop')
		<br/>
		<div class="Div-channel-border">
			<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation">{{link_to_route('users.channel', 'Home', Auth::User()->channel_name)}}</li>
					<li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
					<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
					<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
					<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
					<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
					<li role="presentation" class="active">{{link_to_route('users.subscribers', 'Subscribers')}}</li>

				</ul><!--tabNav-->
			</div>
			<div class="subscibersDiv">
				@foreach($subscriberLists as $subscriberList)
				<div class="subscribers">
					<div class="col-md-6">
						<img src="/img/user/u1.png" class="userRep2">&nbsp;
						<a href="{{route('view.users.channel',$subscriberList->user->channel_name)}}"><span><b>{{$subscriberList->first_name}} {{$subscriberList->last_name}}</b></span></a>&nbsp;
						<br/>&nbsp;
						<span>w/ <b>{{$subscriberList->count}}</b> Subscribers</span>&nbsp;
						<button class="btn btn-primary btn-xs pull-right">Subscribe</button>
					</div>
				</div><!--subscibersDiv-->
				@endforeach
			</div>
			<div class="subscriptionsDiv">
				<table class="table">
					<tr>
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
							<a href="{{route('view.users.channel')}}"><span><b>{{$SubscriptionList->first_name}} {{$SubscriptionList->last_name}}</b></span></a>&nbsp;
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
			</div><!--subscriptions-->
		</div><!--/.shadow Div-channel-border-->
	</div><!--/.row-->
</div><!--container-->
@stop