@extends('layouts.backend.app')

@section('title','Site Settings')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/selectric.css') }}">
@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Site Settings') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Site Settings') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Site Settings') }}</h2>
			<p class="section-lead">{{ __('Site Settings Section') }}</p>
			<form action="{{ route('admin.settings.sitesettings.update') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-12 col-md-6 col-lg-6">
						<div class="card">
							<div class="card-header">
								<h4>{{ __('Website Settings') }}</h4>
							</div>
							<div class="card-body">
								<div class="form-group">
			                      <label>{{ __('Site Title') }}</label>
			                      <input type="text" name="site_title" class="form-control" value="{{ $info->site_title }}">
			                    </div>
			                    <div class="form-group">
			                      <label>{{ __('Site Name') }}</label>
			                      <input type="text" class="form-control" name="site_name" value="{{ $info->site_name }}">
			                    </div>
			                    <div class="form-group">
			                      <label>{{ __('Site Email') }}</label>
			                      <input type="text" class="form-control" name="site_email" value="{{ $info->site_email }}">
			                    </div>
			                    <div class="form-group">
			                      <label>{{ __('Site Description') }}</label>
			                      <textarea class="form-control" cols="8" name="site_description" rows="30">{{ $info->site_description }}</textarea>
			                    </div>
			                    <div class="form-group">
			                      <label>{{ __('Facebook Url') }}</label>
			                      <input type="text" class="form-control" name="facebook_url" value="{{ $info->facebook_url }}">
			                    </div>
			                    <div class="form-group">
			                      <label>{{ __('Twitter Url') }}</label>
			                      <input type="text" name="twitter_url" class="form-control" value="{{ $info->twitter_url }}">
			                    </div>
			                    <div class="form-group">
			                      <label>{{ __('Google Url') }}</label>
			                      <input type="text" class="form-control" name="google_url" value="{{ $info->google_url }}">
			                    </div>
			                    <div class="form-group">
			                      <label>{{ __('Currency Code') }}</label>
			                      <input type="text" class="form-control" name="code" value="{{ $currency_value->code }}">
			                    </div>
			                    <div class="form-group">
			                      <label>{{ __('Currency Symbol') }}</label>
			                      <input type="text" class="form-control" name="symbol" value="{{ $currency_value->symbol }}">
			                    </div>
			                    <div class="form-group">
			                      <label>{{ __('Ads Show Per Secound') }}</label>
			                      <input type="text" class="form-control" name="ads_show_per_second" value="{{ $ads_show_per_second }}" required>
			                    </div>
			                    <h6>{{ __('Ads Settings') }}</h6>
			                    <div class="form-group">
			                    	<label>{{ __('Ads Per Click Price') }}</label>
			                    	<input type="text" class="form-control" name="per_link" value="{{ $per_link }}">
			                    </div>
			                    <div class="form-group">
			                    	<label>{{ __('Ads Per Impression Price') }}</label>
			                    	<input type="text" class="form-control" name="per_impression" value="{{ $per_impression }}">
			                    </div>
			                    <div class="form-group">
			                    	<label>{{ __('Author Get Per Click') }}</label>
			                    	<input type="text" class="form-control" name="author_get_per_link" value="{{ $author_get_per_link }}">
			                    </div>
			                    <div class="form-group">
			                    	<label>{{ __('Author Get Per Impression') }}</label>
			                    	<input type="text" class="form-control" name="author_get_per_impression" value="{{ $author_get_per_impression }}">
			                    </div>
			                    <h6>{{ __('Paypal Settings') }}</h6>
			                    <div class="form-group">
			                    	<label for="PAYPAL_ID">Paypal Client Id</label>
			                    	<input type="text" class="form-control" id="PAYPAL_ID" name="PAYPAL_ID" value="{{ env('PAYPAL_ID') }}">
			                    </div>
			                    <div class="text-right">
									<button class="btn btn-primary">{{ __('Update') }}</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6">
						<div class="card">
							<div class="card-header">
								<h4>{{ __('Other Settings') }}</h4>
							</div>
							<div class="card-body">
								<div class="form-group imgUp">
			                      <label class="logo_label" for="dark_logo">{{ __('Dark Mode Logo') }}
			                      	<div class="form-logo-area imagePreview" style="background-image: url('{{ asset($info->dark_logo) }}');">
			                      	</div>
			                      </label>
			                      <input type="file" name="dark_logo" id="dark_logo" class="uploadFile form-control d-none">
			                    </div>
			                    <div class="form-group imgUp">
			                      <label class="logo_label" for="light_logo">{{ __('Light Mode Logo') }}
			                      	<div class="form-logo-area imagePreview" style="background-image: url('{{ asset($info->light_logo) }}');">
			                      	</div>
			                      </label>
			                      <input type="file" name="light_logo" id="light_logo" class="uploadFile form-control d-none">
			                    </div>
			                    <div class="form-group imgUp">
			                      <label class="logo_label" for="favicon">{{ __('Favicon Upload') }}
			                      	<div class="form-logo-area imagePreview" style="background-image: url('{{ asset($info->favicon) }}');">
			                      	</div>
			                      </label>
			                      <input type="file" name="favicon" id="favicon" class="uploadFile form-control d-none">
			                    </div>
			                    <div class="form-group">
									<div class="form-group">
										<label>{{ __('Default Language') }}</label>
										<select class="form-control selectric" name="default_language">
											@php 
											$lang_option = App\Option::where('key','site_value')->first();
											$default_lang = json_decode($lang_option->value);
											@endphp
											@foreach(App\Language::where('status','active')->get() as $lang)
											<option {{ $lang->code == $default_lang->default_language ? 'selected' : '' }} value="{{ $lang->code }}">{{ $lang->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">{{ __('Update') }}</button>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<h5>{{ __('Mail Settings') }}</h5>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label for="MAIL_DRIVER">{{ __('MAIL DRIVER') }}</label>
									<input id="MAIL_DRIVER" class="form-control" type="text" name="MAIL_DRIVER" value="{{ env('MAIL_DRIVER') }}">
								</div>
								<div class="form-group">
									<label for="MAIL_HOST">{{ __('MAIL HOST') }}</label>
									<input type="text" name="MAIL_HOST" class="form-control" value="{{ env('MAIL_HOST') }}">
								</div>
								<div class="form-group">
									<label for="MAIL_PORT">{{ __('MAIL PORT') }}</label>
									<input type="text" name="MAIL_PORT" class="form-control" value="{{ env('MAIL_PORT') }}">
								</div>
								<div class="form-group">
									<label for="MAIL_USERNAME">{{ __('MAIL USERNAME') }}</label>
									<input type="text" name="MAIL_USERNAME" class="form-control" value="{{ env('MAIL_USERNAME') }}">
								</div>
								<div class="form-group">
									<label for="MAIL_PASSWORD">{{ __('MAIL PASSWORD') }}</label>
									<input type="password" name="MAIL_PASSWORD" class="form-control" value="{{ env('MAIL_PASSWORD') }}">
								</div>
								<div class="form-group">
									<label for="MAIL_ENCRYPTION">{{ __('MAIL ENCRYPTION') }}</label>
									<input type="text" name="MAIL_ENCRYPTION" class="form-control" value="{{ env('MAIL_ENCRYPTION') }}">
								</div>
								<div class="form-group">
									<label for="MAIL_FROM_ADDRESS">{{ __('MAIL FROM ADDRESS') }}</label>
									<input type="text" name="MAIL_FROM_ADDRESS" class="form-control" value="{{ env('MAIL_FROM_ADDRESS') }}">
								</div>
								<div class="form-group">
									<label for="MAIL_FROM_NAME">{{ __('MAIL FROM NAME') }}</label>
									<input type="text" name="MAIL_FROM_NAME" class="form-control" value="{{ env('MAIL_FROM_NAME') }}">
									<input type="hidden" name="APP_NAME" value="{{ env('APP_NAME') }}">
									<input type="hidden" name="APP_ENV" value="{{ env('APP_ENV') }}">
									<input type="hidden" name="APP_URL" value="{{ env('APP_URL') }}">
									<input type="hidden" name="DB_HOST" value="{{ env('DB_HOST') }}">
									<input type="hidden" name="DB_PORT" value="{{ env('DB_PORT') }}">
									<input type="hidden" name="DB_DATABASE" value="{{ env('DB_DATABASE') }}">
									<input type="hidden" name="DB_USERNAME" value="{{ env('DB_USERNAME') }}">
									<input type="hidden" name="DB_PASSWORD" value="{{ env('DB_PASSWORD') }}">
								</div>
								<div class="text-right">
									<button class="btn btn-primary">{{ __('Update') }}</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/assets/js/jquery.selectric.min.js') }}"></script>
@endpush