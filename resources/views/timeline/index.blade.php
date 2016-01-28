@extends('layouts.default')

@section('content')
	<div class="row">
	<div class="col-md-6">
		<form role="form" method="post" action="{{ route('status.post') }}">
			<div class="form-group {{$errors->has('status') ? 'has-error':''}}">
			{!! csrf_field() !!}	
				<textarea class="form-control" placeholder="What's up {{Auth::user()->getNameOrUsername() }} ?" name="status" rows='2'></textarea>
				@if ($errors->has('status'))
					<span class="help-block">
						{{ $errors->first('status') }}
					</span>
				@endif
			</div>
			<button class="btn btn-default" type="submit"> Update Status</button>
		</form>
		<hr>
	</div>	
	</div>
	<div class="row">
		<div class="col-md-5">
			<!-- Timeline status and replies -->
			@if (!$statuses->count())
				<p>There is nothing on your Timeline, yet.</p>
			@else
				@foreach ($statuses as $status)
					<div class="media">
						<a href="{{route('profile.index', ['username' => $status->user->username])}}" class="pull-left">
							<img src="{{ $status->user->getAvatarUrl() }}" alt="{{$status->user->getNameOrUsername() }}" class="media-object">
						</a>
						<div class="media-body">
							<h4 class="media-heading"><a href="#">{{$status->user->getNameOrUsername() }}</a></h4>
							<p>{{ $status->body }}</p>
							<ul class="list-inline">
								<li>{{ $status->created_at->diffForHumans() }}</li>
								<li><a href="#">Like</a></li>
								<li>10 likes</li>
							</ul>

							<!-- <div class="media">
								<a href="#" class="pull-left">
									<img src="" alt="" class="media-object">
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#">{{$status->user->getNameOrUsername() }}</a></h4>
									<p>Yeah, It's lovely.</p>
									<ul class="list-inline">
										<li>8 minutes ago</li>
										<li><a href="#">Like</a></li>
										<li>10 likes</li>
									</ul>
								</div>
							</div> -->
							<form role="form" action="{{ route('status.reply',['statusId' => $status->id]) }}" method="post">
								{!! csrf_field() !!}
								<div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error':"" }}">
									<textarea class="form-control" name="reply-{{$status->id}}" rows="2" placeholder="Reply to this status."></textarea>
									@if ($errors->has("reply-{$status->id}"))
										<span class="help-block">
											{{ $errors->first("reply-{$status->id}" ) }}
										</span>
									@endif
								</div>
								<input type="submit" class="btn btn-default btn-sm" value="Reply">
							</form>
						</div>
					</div>
				@endforeach
				{{$statuses->render()}}
			@endif
		</div>
	</div>
@stop