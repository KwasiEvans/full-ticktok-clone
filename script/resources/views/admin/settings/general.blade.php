@extends('layouts.backend.app')

@section('title','General Settings')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/selectric.css') }}">
@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('General Settings') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('General Settings') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('General Settings') }}</h2>
			<p class="section-lead">{{ __('General Settings Section') }}</p>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('User Settings') }}</h4>
						</div>
						<div class="card-body">
							<form action="{{ route('admin.settings.general.update') }}" method="POST">
								@csrf
								<div class="form-group">
									<label>{{ __('User Registration') }}</label>
									<select class="form-control selectric" name="user_registation">
										<option {{ $info->user_registation == 'enabled' ? 'selected' : '' }} value="enabled">{{ __('Enabled') }}</option>
										<option {{ $info->user_registation == 'disabled' ? 'selected' : '' }} value="disabled">{{ __('Disabled') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label>{{ __('User Email Verification') }}</label>
									<select class="form-control selectric" name="email_verification">
										<option {{ $info->email_verification == 'enabled' ? 'selected' : '' }} value="enabled">{{ __('Enabled') }}</option>
										<option {{ $info->email_verification == 'disabled' ? 'selected' : '' }} value="disabled">{{ __('Disabled') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label>{{ __('Delete User Account') }}</label>
									<select class="form-control selectric" name="delete_account">
										<option {{ $info->delete_account == 'enabled' ? 'selected' : '' }} value="enabled">{{ __('Enabled') }}</option>
										<option {{ $info->delete_account == 'disabled' ? 'selected' : '' }} value="disabled">{{ __('Disabled') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label>{{ __('User Monetization') }}</label>
									<select class="form-control selectric" name="user_monetization">
										<option {{ $info->user_monetization == 'enabled' ? 'selected' : '' }} value="enabled">{{ __('Enabled') }}</option>
										<option {{ $info->user_monetization == 'disabled' ? 'selected' : '' }} value="disabled">{{ __('Disabled') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label>{{ __('User Payment Withdraw') }}</label>
									<select class="form-control selectric" name="user_payment_withdraw">
										<option {{ $info->user_payment_withdraw == 'enabled' ? 'selected' : '' }} value="enabled">{{ __('Enabled') }}</option>
										<option {{ $info->user_payment_withdraw == 'disabled' ? 'selected' : '' }} value="disabled">{{ __('Disabled') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label>{{ __('User Verification') }}</label>
									<select class="form-control selectric" name="user_verification">
										<option {{ $info->user_verification == 'enabled' ? 'selected' : '' }} value="enabled">{{ __('Enabled') }}</option>
										<option {{ $info->user_verification == 'disabled' ? 'selected' : '' }} value="disabled">{{ __('Disabled') }}</option>
									</select>
								</div>
								<div class="text-right">
									<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/assets/js/jquery.selectric.min.js') }}"></script>
@endpush