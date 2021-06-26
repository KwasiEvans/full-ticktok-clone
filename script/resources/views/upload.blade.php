@extends('layouts.frontend.app')

@section('title','Upload')

@section('content')
<!-- error-alert start -->
<div class="error-message-area">
    <div class="error-content">
        <h4 class="error-msg">{{ __('Your Settings Successfully Updated') }}</h4>
    </div>
</div>
<!-- error-alert end -->
<!-- main area start -->
<section>
    <!-- ellipsis modal -->
    <div class="ellipish-modal d-none">
      <div class="ellipish-modal-content">
        
      </div>
  </div>

  <div class="main-area pt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="video-upload-title">
                    <h2>{{ __('Upload video') }}</h2>
                    <p class="percentence">{{ __('Post a video to your account') }}</p>
                </div>
                <div class="custom-form">
                    <div class="row">
                        <div class="col-lg-4">
                            <form action="{{ route('video.upload') }}" id="video_form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="video_url" value="{{ route('video.upload') }}">
                                <input type="hidden" id="main_url" value="{{ route('welcome') }}">
                                <div class="load-area">
                                    <div class="video-upload-input-area">
                                        <label for="video_upload" class="text-center">
                                            <div class="info-star">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <h5>{{ __('Select Video to Upload') }}</h5>
                                                <h6>{{ __('Max limit 10MB') }}</h6>
                                            </div>
                                        </label>
                                        <input type="file" name="video" class="d-none" id="video_upload">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-8">
                            <form action="{{ route('post.store') }}" method="POST" id="submit_post">
                                @csrf
                                <input type="hidden" id="post_url" value="{{ route('post.store') }}">
                                <div class="form-group">
                                    <label for="caption">{{ __('Caption') }}</label>
                                    <textarea name="caption" oninput="mycaption()" id="caption" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <div class="video-public-privet-action">
                                    <h3>{{ __('Who can view this video') }}</h3>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" checked id="public" name="status" class="custom-control-input" value="1">
                                        <label class="custom-control-label" for="public">{{ __('Public') }}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="privet" name="status" class="custom-control-input" value="0">
                                        <label class="custom-control-label" for="privet">{{ __('Privet') }}</label>
                                    </div>
                                </div>
                                <div class="submit-post-action f-right">
                                    <a href="#">{{ __('Cancel') }}</a>
                                    <button class="disabled" id="upload_btn" type="submit">{{ __('Post') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- main area end -->
@endsection