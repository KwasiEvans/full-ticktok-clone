@foreach($users as $user)
@if(!Auth::User()->isFollowing($user->id))
<div class="col-lg-3 mb-30">
    <div class="single-user">
        @php 
        $user_data = json_decode($user->value);
        @endphp
        <img src="{{ asset($user_data->cover) }}">
        <div class="single-user-info text-center">
            <div class="single-user-img">
                <img src="{{ asset($user->image) }}">
                <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                <h5>{{ $user->username }}</h5>
                <div class="follow-unfollow-action">
                    <a class="pjax" href="{{ route('profile.show',$user->slug) }}">{{ __('View Profile') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
