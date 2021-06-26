@extends('layouts.frontend.app')

@section('title','Latest Videos')

@section('content')
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
                                @if($type == 'latest')
                                <h2>{{ __('Latest Videos') }}</h2>
                                @endif
                                @if($type == 'popular')
                                <h2>{{ __('Most View') }}</h2>
                                @endif
                                @if($type == 'trending')
                                <h2>{{ __('Trending') }}</h2>
                                @endif
                                <p>{{ __('Watch the latest videos from our community') }}</p>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <div class="row {{ $type == 'popular' ? 'popular' : '' }}{{ $type == 'latest' ? 'latest' : '' }}{{ $type == 'trending' ? 'trending' : '' }}" id="results">
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
<input type="hidden" id="popup_url" value="{{ route('popup') }}">
<input type="hidden" id="ellipsis_url" value="{{ route('ellipsis') }}">
<input type="hidden" id="asset_url" value="{{ route('welcome') }}">
<input type="hidden" id="latest_url" value="{{ route('latest') }}">
<input type="hidden" id="popular_url" value="{{ route('popular') }}">
<input type="hidden" id="trending_url" value="{{ route('trending') }}">

<!-- copied to clipboard -->
<div class="copied">
  <p>{{ __('Link copied to clipboard.') }}</p>
</div>
@endsection