@if($notifications->count() > 0)
@foreach($notifications as $notification)
<div class="single-notification-colum">
	<a  href="{{ url($notification->link) }}" target="_blank" class="dropdown-item">
		<div class="notification-single-content d-flex">
			<img src="{{ asset($notification->user->image) }}">
			<div class="notification-content">
				<p><b>{{ $notification->user->username }}</b> {{ $notification->body }} </p>
				<time>{{ $notification->created_at->diffForHumans() }}</time>
			</div>
		</div>
	</a>
</div>
@endforeach
@endif
