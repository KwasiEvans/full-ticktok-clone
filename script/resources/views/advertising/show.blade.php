<div class="advise-show">
	<a target="__blank" href="{{ route('ads.redirect',['ads_id'=>$advertising->id,'user_id'=>$login_user->id]) }}"><img src="{{ asset($advertising->media) }}"></a>
	<a href="javascript:void(0)" class="ads_close" onclick="ads_close()"><img src="{{ asset('frontend/img/cancel.png') }}"></a>
</div>