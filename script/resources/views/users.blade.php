@extends('layouts.frontend.app')

@section('title','Find User')

@section('content')
<!-- main area start -->
<section>
    <div class="main-area pt-50">
        <div class="container">
            <div class="row allusergrid" id="user_results">
                @foreach($users as $user)
                @if(!Auth::User()->isFollowing($user->id))
                <input type="hidden" id="follow_url" value="{{ route('follow',$user->id) }}">
                <input type="hidden" id="unfollow_url" value="{{ route('unfollow',$user->id) }}">
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
                <input type="hidden" id="user_loadmore_url" value="{{ route('users') }}">
            </div>
            <div class="page-load-status">
              <p class="scroll-request"></p>
              <p class="scroll-error">{{ __('No more pages to load') }}</p>
            </div>
        </div>
    </div>
</section>
<!-- main area end -->
@endsection