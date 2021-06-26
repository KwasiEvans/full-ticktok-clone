@extends('layouts.frontend.app')

@section('title','Advertising')

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

<!-- main area start -->
<section>
    <div class="main-area pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                	<div class="ads-content-area">
                		@php 
						$currency_code = App\Option::where('key','currency')->first();
        				$currency_value = json_decode($currency_code->value);
						@endphp
                		<div class="ads-header d-flex">
                			<h4><i class="fab fa-adn ads"></i> <span class="ads">{{ __('
                		Advertising > Create Advertising') }}</span></h4>
                			<h4><i class="far fa-credit-card"></i> {{ __('Wallet') }}({{ $currency_value->symbol }}{{ number_format($user_data->wallet,2) }})</h4>
                		</div>
                		<input type="hidden" id="ads_url" value="{{ route('ads.index') }}">
                		<div class="create-ads-area">
                			<form action="{{ route('ads.store') }}" class="create-ads-form" id="ads_form" method="POST">
                				@csrf
                				<div class="row">
	                				<div class="col-lg-8">
	                					<h6>{{ __('Title') }}</h6>
	                					<div class="login-form-group">
	                						<input type="text" name="title" class="login-form-control" placeholder="{{ __('Title') }}">
	                					</div>
	                					<h6>{{ __('Url') }}</h6>
	                					<div class="login-form-group">
	                						<input type="text" name="url" class="login-form-control" placeholder="{{ __('Url') }}">
	                					</div>
	                					<h6>{{ __('Select Media(480*100)') }}</h6>
	                					<div class="ads-select-media">
	                						<label for="ads_media" id="ads_label">
	                							<i class="fas fa-image"></i>
	                						</label>
	                						<input type="file" name="media" id="ads_media" class="d-none">
	                					</div>
	                				</div>
	                				<div class="col-lg-4">
	                					<h6>{{ __('Target Audience') }}</h6>
	                					<div class="login-form-group">
	                						<select class="login-form-control" name="country">
	                							<option value="select_all">{{ __('Select All') }}</option>
	                							@foreach($countries as $country)
	                							<option value="{{ $country }}">{{ $country }}</option>
	                							@endforeach
	                						</select>
	                					</div>
	                					<h6>{{ __('Pricing') }}</h6>
	                					<div class="login-form-group">
	                						<select class="login-form-control" name="pricing" id="ads_pricing">
	                							<option value="per_link" selected>{{ __('Pay per link') }}({{ $currency_value->symbol }}{{ $per_link->value }})</option>
	                							<option value="per_impression">{{ __('Pay per Impression') }}({{ $currency_value->symbol }}{{ $per_impression->value }})</option>
	                						</select>
	                					</div>
	                					<h6>{{ __('Total ads spending limit') }}</h6>
	                					<div class="login-form-group">
	                						<input type="number" name="total_limit" min="1" id="total_limit" class="login-form-control" value="20">
	                						<div class="up-down-btn">
	                							<a href="javascript:void(0)" class="minus" onclick="limit_minus()"><i class="fas fa-minus-circle"></i></a>
	                							<a href="javascript:void(0)" onclick="limit_plus()"><i class="fas fa-plus-circle"></i></a>
	                						</div>
	                					</div>
	                					<div class="boot-your-post">
	                						<a href="{{ route('ads.index') }}" class="pjax cancel">{{ __('Cancel') }}</a>
	                						<button  type="submit" class="ads_button publish">{{ __('Publish') }}</button>
	                					</div>
	                				</div>
	                			</div>
                			</form>
                		</div>		
                	</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- main area end -->
@endsection