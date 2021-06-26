@extends('layouts.frontend.app')

@section('title',$user->first_name.$user->last_name)

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

<!-- main area start -->
<section>
    <div class="main-area pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="user-profile-main-info">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="user-main-info d-flex">
                                            <div class="profile-user-img">
                                                <img src="{{ asset($user->image) }}" alt="">
                                            </div>
                                            <div class="profile-another-info d-block">
                                                <div class="profile-username">
                                                    <h4>{{ $user->username }}</h4>
                                                </div>
                                                <div class="profile-name">
                                                    <h5>{{ $user->first_name }}&nbsp;{{ $user->last_name }}</h5>
                                                </div>
                                                <div class="follow-btn">
                                                    @if(Auth::check())
                                                    @if($user->id == Auth::User()->id)
                                                    <a class="pjax" href="{{ route('profile.edit') }}">{{ __('Edit Profile') }}</a>
                                                    @else
                                                    @if(Auth::User()->isFollowing($user->id))
                                                    <a class="pjax" href="{{ route('unfollow',$user->id) }}">{{ __('Unfollow') }}</a>
                                                    @else
                                                    <a class="pjax" href="{{ route('follow',$user->id) }}">{{ __('Follow') }}</a>
                                                    @endif
                                                    @endif
                                                    @else
                                                    <a class="pjax" href="{{ route('follow',$user->id) }}">{{ __('Follow') }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-follow-info">
                                            <span><strong>{{ App\Helpers\UserSystemInfo::conveter($user->followings()->count()) }}</strong>{{ __('Following') }}</span>
                                            <span><strong>{{ App\Helpers\UserSystemInfo::conveter($user->followers()->count()) }}</strong>{{ __('Followers') }}</span>
                                            <span><strong>{{ App\Helpers\UserSystemInfo::conveter($user->videos()->sum('view')) }}</strong>{{ __('Views') }}</span>
                                        </div>
                                        @php 
                                        $user_value = json_decode($user->value);
                                        @endphp
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="profile-report-area f-right">
                                            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                            @if(Auth::check())
                                            <a href="javascript:void(0)" class="dropdown-item" onclick="user_report('{{ $user->slug }}')"><i class="far fa-flag"></i> {{ __('Report') }}</a>
                                            @else
                                            <a href="{{ route('login') }}" class="pjax dropdown-item"><i class="far fa-flag"></i> {{ __('Report') }}</a>
                                            @endif
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-bio">
                                    <p>{{ $user_value->bio }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row usergrid" id="results">
                    	@foreach($videos as $video)
                        @include('layouts.frontend.section.singlevideo')
                        @endforeach
                    </div>
                    <div class="page-load-status">
                      <p class="scroll-request"></p>
                      <p class="scroll-error">{{ __('No more pages to load') }}</p>
                  </div>
              </div>
              @include('layouts.frontend.partials.sidebar')
          </div>
      </div>
  </div>
</section>
<!-- main area end -->
<input type="hidden" id="popup_url" value="{{ route('popup') }}">
<input type="hidden" id="ellipsis_url" value="{{ route('ellipsis') }}">
<input type="hidden" id="asset_url" value="{{ route('welcome') }}">
<input type="hidden" id="user_url" value="{{ route('profile.show',$user->slug) }}">
<input type="hidden" id="user_slug" value="{{ $user->slug }}">
<input type="hidden" id="scroll_top" value="1">
<input type="hidden" id="user_report_url" value="{{ route('user_report') }}">

<!-- copied to clipboard -->
<div class="copied">
  <p>{{ __('Link copied to clipboard.') }}</p>
</div>

@endsection

