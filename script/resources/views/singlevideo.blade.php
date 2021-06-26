@extends('layouts.frontend.app')

@section('title',$video->title)

@section('content')

<!-- success-alert start -->
<div class="alert-message-area">
    <div class="alert-content">
        <h4 class="ale">{{ __('Your Settings Successfully Updated') }}</h4>
    </div>
</div>
<!-- success-alert end -->

<!-- error-alert start -->
<div class="error-message-area">
    <div class="error-content">
        <h4 class="error-msg">{{ __('Your Settings Successfully Updated') }}</h4>
    </div>
</div>
<!-- error-alert end -->

<!-- ellipsis modal -->
<div class="ellipish-modal d-none">
	<div class="ellipish-modal-content">

	</div>
</div>


<!-- modal -->
<div class="bg-modal d-none">
	<div class="close-btn">
		<a href="javascript:void(0)"><img src="{{ asset('frontend/img/cancel.png') }}"></a>
	</div>
	<div class="modal-content-area">

	</div>
</div>

<section>
	<div class="single-video-area">
		<div class="main-area pt-50">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="container-fluid">
							<div class="row">
								<div class="col-lg-7 p-0">
									<div class="video-empty">
										<div class="video-section" onclick="single_play()">
											<video id='singlevideo'>
												<source src='{{ asset($video->url) }}' type='video/mp4'>
											</video>
											<div class="video-action">
												<a href="javascript:void(0)" class="single_play"><i class="fas fa-play"></i></a>
											</div>
										</div>
									</div>
									<div class="volume-action">
										<input type="hidden" id="volume_img" value="{{ asset('frontend/img/volume.png') }}">
										<input type="hidden" id="muted_img" value="{{ asset('frontend/img/muted.png') }}">
										<a href="javascript:void(0)" class="volume"><img class="volume_img" src="{{ asset('frontend/img/volume.png') }}"></a>
									</div> 
									<div class="loader">
										<div class="video-single-loader"></div>
									</div>
									<div class="video-ads-append-area">

									</div>
								</div>
								<div class="col-lg-5 p-0">
									<div class="single_video">
										<div class="modal-right-section">
											<div class="user-top-info">
												<div class="user-profile-info">
													<a class="pjax" href="{{ route('profile.show',$video->user->slug) }}" onclick="profileshow()"> <img src="{{ asset($video->user->image) }}" alt=""> {{ $video->user->username }}</a>
												</div>
												<div class="arrow-button">
													<a href="javascript:void(0)" onclick="ellipsis_open('{{ $video->slug }}')"><i class="fas fa-ellipsis-h"></i></a>
												</div>
											</div>
											<div class="modal-comment-list">
												@foreach($video->comments()->where('parent_id',null)->latest()->get() as $comment)
												<div class="single-comment">
													<a class="pjax" href="{{ route('profile.show',$comment->user->slug) }}" onclick="profileshow()">
														<img src="{{ asset($comment->user->image) }}" alt="">
													</a>
													<span> 
														<a class="pjax" href="{{ route('profile.show',$comment->user->slug) }}" onclick="profileshow()">{{ $comment->user->username }}</a>{{ $comment->message }} 
														<div class="comment-info">
															<span>{{ $comment->created_at->isoFormat('Do') }} <span id="comment_like_count{{ $comment->id }}" class="likes"> {{ $comment->favourite_to_user->count() }}likes</span><a href="javascript:void(0)" onclick="reply('{{ $comment->id }}','{{ $comment->user->username }}','{{ $comment->user->id }}')">{{ __('Reply') }}</a></span>
														</div>
													</span>
													<input type="hidden" id="comment_like_url" value="{{ route('comment_like') }}">
													<div class="favourite-icon">
														@if(Auth::check())
														<a href="javascript:void(0)" onclick="comment_like('{{ $comment->id }}')"><i id="comment_like{{ $comment->id }}" class="{{ !Auth::User()->favourite_comments->where('pivot.comment_id',$comment->id)->count() == 0 ? 'fas fa-heart' : 'far fa-heart' }}"></i></a>
														@else
														<a href="{{ route('login') }}" class="pjax" onclick="profileshow()"><i id="like" class="far fa-heart"></i></a>
														@endif
													</div>
												</div>
												@foreach($comment->replies as $value)
												<div class="single-comment ml-50">
													<a class="pjax" href="{{ route('profile.show',$value->user->slug) }}" onclick="profileshow()">
														<img src="{{ asset($value->user->image) }}" alt="">
													</a>
													<span> 
														<a class="pjax" href="{{ route('profile.show',$value->user->slug) }}" onclick="profileshow()">{{ $value->user->username }}</a><br><a class="username" href="{{ $value->mention_id != null ? route('profile.show',$value->mention_user->slug) : '' }}" onclick="profileshow()">{{ $value->mention_id != null ? $value->mention_user->username : '' }}</a>{{ $value->message }} 
														<div class="comment-info">
															<span>{{ $value->created_at->isoFormat('Do') }} <span id="comment_like_count{{ $value->id }}" class="likes"> {{ $value->favourite_to_user->count() }}likes</span><a href="javascript:void(0)" onclick="reply('{{ $value->main_comment->id }}','{{ $value->user->username }}','{{ $value->user->id }}')">{{ __('Reply') }}</a></span>
														</div>
													</span>
													<div class="favourite-icon">
														@if(Auth::check())
														<a href="javascript:void(0)" onclick="comment_like('{{ $value->id }}')"><i id="comment_like{{ $value->id }}" class="{{ !Auth::User()->favourite_comments->where('pivot.comment_id',$value->id)->count() == 0 ? 'fas fa-heart' : 'far fa-heart' }}"></i></a>
														@else
														<a href="{{ route('login') }}" class="pjax" onclick="profileshow()"><i id="like" class="far fa-heart"></i></a>
														@endif
													</div>
												</div>
												@endforeach
												@endforeach
											</div>
											<div class="modal-video-post-action">
												<div class="modal-main-action">
													@if(Auth::check())
													<a href="javascript:void(0)" onclick="like('{{ $video->id }}')"><i id="like" class="{{ !Auth::User()->favourite_videos->where('pivot.video_id',$video->id)->count() == 0 ? 'fas fa-heart' : 'far fa-heart' }}"></i></a>
													@else
													<a href="{{ route('login') }}" class="pjax" onclick="profileshow()"><i id="like" class="far fa-heart"></i></a>
													@endif
													@if(Auth::check())
													<a href="javascript:void(0)"><label for="comment"><i class="far fa-comment"></i></label></a>
													@else
													<a href="{{ route('login') }}" class="pjax" onclick="profileshow()"><label for="comment"><i class="far fa-comment"></i></label></a>
													@endif
													<a href="javascript:void(0)" onclick="share('{{ $video->slug }}')"><i class="far fa-paper-plane"></i></a>
												</div>
												<div class="modal-total-views">
													{{ App\Helpers\UserSystemInfo::conveter($video->view) }} {{ __('views') }}
												</div>
												<div class="modal-video-date">
													{{ $video->created_at->isoFormat('LL') }}
												</div>
											</div>
											<input type="hidden" id="like_url" value="{{ route('like') }}">
											<div class="send-comment-area">
												@if(Auth::check())
												<form action="{{ route('comment') }}" method="POST" id="comment_send">
													@csrf
													<div class="d-flex">
														<span class="d-none" id="comment_username">@arafat</span>
														<input type="hidden" name="video_id" value="{{ $video->id }}">
														<input type="hidden" id="comment_parent" name="parent_id">
														<input type="hidden" id="mention_id" name="mention_id">
														<input type="text" id="comment" name="comment" autocomplete="off" placeholder="{{ __('Add a comment') }}">
														<button type="submit">{{ __('Post') }}</button>
													</div>
												</form>
												@else
												<div class="please-login text-center">
													<p>{{ __('Please') }} <a href="{{ route('login') }}" class="pjax" onclick="profileshow()">{{ __('Login') }}</a> {{ __('or') }} <a href="{{ route('register') }}" class="pjax" onclick="profileshow()">{{ __('SignUp') }}</a></p>
												</div>
												@endif
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>
						<input type="hidden" id="video_ads_url" value="{{ route('ads.show') }}">
					</div> 
				</div> 
			</div> 
		</div>
	</div> 
</section>
<input type="hidden" id="popup_url" value="{{ route('popup') }}">
<input type="hidden" id="ellipsis_url" value="{{ route('ellipsis') }}">
<input type="hidden" id="asset_url" value="{{ route('welcome') }}">
<input type="hidden" id="report_url" value="{{ route('report.show') }}">

<!-- copied to clipboard -->
<div class="copied">
	<p>{{ __('Link copied to clipboard.') }}</p>
</div>
@endsection