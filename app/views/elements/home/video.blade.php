
<h1>Videos</h1>
@foreach($datas as $randomResult)


	<div class="col-md-4 col-sm-6 hidden-xs">
		<span class="v-time inline">{{$randomResult->total_time}}</span>
		<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">	
			<div class="thumbnail-2"> 

					<img class="hvr-grow-rotate" src="{{$randomResult->thumbnail}}">
				
			</div>
			<div class="v-Info">
				<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">{{$randomResult->title}}</a>
			</div>
		
			<div class="count">
				by: <a href="{{route('view.users.channel', array($randomResult->channel_name))}}">{{$randomResult->channel_name}}</a>
				<br />
				<i class="fa fa-eye"></i> {{$randomResult->views}} | <i class="fa fa-thumbs-up"></i> {{$randomResult->likes}} | {{date('F d, Y',strtotime($randomResult->created_at))}}
			</div>
		</a>
	</div>


	<div class="col-xs-12 visible-xs">
		<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">
			<div class="row">
				<div class="col-xs-4">
						<img class="thumbnail" src="{{$randomResult->thumbnail}}">
				</div>
				<div class="col-xs-8">
					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">{{$randomResult->title}}</a>
					</div>
			
					<div class="count">
						by: <a href="{{route('view.users.channel', array($randomResult->channel_name))}}">{{$randomResult->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{$randomResult->views}} | <i class="fa fa-thumbs-up"></i> {{$randomResult->likes}}| {{date('F d, Y',strtotime($randomResult->created_at))}}
					</div>
				</div>
			</div>
		</a>
	</div>
@endforeach