@extends('layouts.frontend.app')

@section('title',$site_value->site_title)

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
    <div class="main-area pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-area-title">
                                <h2>{{ __('Trending') }}</h2>
                                <p>{{ __('Watch the latest videos from our community') }}</p>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <div class="row grid">
                        @foreach($videos as $video)
                        @include('layouts.frontend.section.singlevideo')
                        @endforeach
                    </div>
                    <div class="page-load-status">
                      <p class="infinite-scroll-request"></p>
                      <p class="infinite-scroll-error">{{ __('No more pages to load') }}</p>
                    </div>
                </div>
                @include('layouts.frontend.partials.sidebar')
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="popup_url" value="{{ route('popup') }}">
<input type="hidden" id="ellipsis_url" value="{{ route('ellipsis') }}">
<input type="hidden" id="asset_url" value="{{ route('welcome') }}">

<!-- copied to clipboard -->
<div class="copied">
  <p>{{ __('Link copied to clipboard.') }}</p>
</div>
@endsection
