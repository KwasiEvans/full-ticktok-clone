@extends('layouts.frontend.app')

@section('title','Settings')

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
				<div class="col-lg-4">
					<div class="settings-sidebar-card">
						<h5>{{ __('Settings') }}</h5>
						<div class="settings-main-menu">
							<nav>
								<ul class="nav nav-tabs">
									@php 
									$site_data = App\Option::where('key','user_value')->first();
									$info = json_decode($site_data->value);
									@endphp
									<li><a href="#avatar" data-toggle="tab" class="active"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M262.3 199.2c-1.6-2.8-5.6-3.2-7.7-.7l-91.9 122.2c-2.5 2.9-.6 7.4 3.2 7.7l161.1 14c3.8.3 6.4-3.8 4.5-7.1l-69.2-136.1zM367.2 264.1c-1.6-2.8-5.6-3.2-7.7-.7l-24.8 25.1a4.68 4.68 0 0 0-.5 5.4l25.4 49.5c.8 1.3 2.1 2.2 3.7 2.3l44.9 3.9c3.8.3 6.4-3.8 4.5-7.1l-45.5-78.4zM378.1 224.4c11.2-.1 20.9-8.3 23-19.2 2.8-14.8-8.6-28.3-23.7-28.1-11.2.1-20.9 8.3-23 19.2-2.8 14.8 8.6 28.3 23.7 28.1z"></path><path fill="currentColor" d="M455.2 129.3l-65.8-5.7-6.1-67c-1.3-14.9-14.5-25.9-29.5-24.5L56.7 58.9c-14.9 1.3-25.9 14.5-24.6 29.4l26.8 296.5c1.3 14.9 14.5 25.9 29.5 24.5l15.7-1.4-1.5 16.7c-1.3 14.9 9.7 28 24.7 29.3l297.3 25.9c14.9 1.3 28.1-9.7 29.4-24.6l26-296.6c1.2-14.8-9.8-28-24.8-29.3zM87.6 300.7c-3.7.3-7-2.4-7.4-6.1l-18-200c-.3-3.7 2.4-7 6.1-7.3l279.2-25.1c3.7-.3 7 2.4 7.4 6.1l4.8 52.8L158 103.4c-14.9-1.3-28.1 9.7-29.4 24.6l-14.9 170.3-26.1 2.4zm362.2-135.6l-17.5 200c-.3 3.7-3.6 6.5-7.3 6.2l-18.6-1.6L145.7 347c-3.7-.3-6.5-3.6-6.2-7.3l3.8-43.9L157 139.7c.3-3.7 3.6-6.5 7.3-6.2l198 17.3 29.7 2.6 51.6 4.5c3.8.2 6.6 3.5 6.2 7.2z"></path></svg> {{ __('Avatar & Cover') }}</a></li>
									@if($info->user_monetization == 'enabled')
									<li><a href="#monetization" data-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M404 160H108c-33.1 0-60 26.9-60 60v168c0 33.1 26.9 60 60 60h296c33.1 0 60-26.9 60-60V220c0-33.1-26.9-60-60-60zM342.9 65L108 110.9c-18 4-44 22.1-44 44.1 0 0 15-19 49-19h287v-20.5c0-12.6-5-28.7-13.9-37.6-11.3-11.3-27.5-16.2-43.2-12.9z"></path></svg> {{ __('Monetization') }}</a></li>
									@endif
									<li><a href="#balence" data-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> {{ __('Balance') }}</a></li>
									<li><a href="#verify" data-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 48C141.1 48 48 141.1 48 256s93.1 208 208 208 208-93.1 208-208S370.9 48 256 48zm106.5 150.5L228.8 332.8h-.1c-1.7 1.7-6.3 5.5-11.6 5.5-3.8 0-8.1-2.1-11.7-5.7l-56-56c-1.6-1.6-1.6-4.1 0-5.7l17.8-17.8c.8-.8 1.8-1.2 2.8-1.2 1 0 2 .4 2.8 1.2l44.4 44.4 122-122.9c.8-.8 1.8-1.2 2.8-1.2 1.1 0 2.1.4 2.8 1.2l17.5 18.1c1.8 1.7 1.8 4.2.2 5.8z"></path></svg> {{ __('Verification') }}</a></li>
									<li><a href="#twofactor" data-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg> {{ __('Two-factor authentication') }}</a></li>
									<li><a href="#manage" data-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="feather" stroke="currentColor"><path fill="none" d="M17.81,4.47C17.73,4.47 17.65,4.45 17.58,4.41C15.66,3.42 14,3 12,3C10.03,3 8.15,3.47 6.44,4.41C6.2,4.54 5.9,4.45 5.76,4.21C5.63,3.97 5.72,3.66 5.96,3.53C7.82,2.5 9.86,2 12,2C14.14,2 16,2.47 18.04,3.5C18.29,3.65 18.38,3.95 18.25,4.19C18.16,4.37 18,4.47 17.81,4.47M3.5,9.72C3.4,9.72 3.3,9.69 3.21,9.63C3,9.47 2.93,9.16 3.09,8.93C4.08,7.53 5.34,6.43 6.84,5.66C10,4.04 14,4.03 17.15,5.65C18.65,6.42 19.91,7.5 20.9,8.9C21.06,9.12 21,9.44 20.78,9.6C20.55,9.76 20.24,9.71 20.08,9.5C19.18,8.22 18.04,7.23 16.69,6.54C13.82,5.07 10.15,5.07 7.29,6.55C5.93,7.25 4.79,8.25 3.89,9.5C3.81,9.65 3.66,9.72 3.5,9.72M9.75,21.79C9.62,21.79 9.5,21.74 9.4,21.64C8.53,20.77 8.06,20.21 7.39,19C6.7,17.77 6.34,16.27 6.34,14.66C6.34,11.69 8.88,9.27 12,9.27C15.12,9.27 17.66,11.69 17.66,14.66A0.5,0.5 0 0,1 17.16,15.16A0.5,0.5 0 0,1 16.66,14.66C16.66,12.24 14.57,10.27 12,10.27C9.43,10.27 7.34,12.24 7.34,14.66C7.34,16.1 7.66,17.43 8.27,18.5C8.91,19.66 9.35,20.15 10.12,20.93C10.31,21.13 10.31,21.44 10.12,21.64C10,21.74 9.88,21.79 9.75,21.79M16.92,19.94C15.73,19.94 14.68,19.64 13.82,19.05C12.33,18.04 11.44,16.4 11.44,14.66A0.5,0.5 0 0,1 11.94,14.16A0.5,0.5 0 0,1 12.44,14.66C12.44,16.07 13.16,17.4 14.38,18.22C15.09,18.7 15.92,18.93 16.92,18.93C17.16,18.93 17.56,18.9 17.96,18.83C18.23,18.78 18.5,18.96 18.54,19.24C18.59,19.5 18.41,19.77 18.13,19.82C17.56,19.93 17.06,19.94 16.92,19.94M14.91,22C14.87,22 14.82,22 14.78,22C13.19,21.54 12.15,20.95 11.06,19.88C9.66,18.5 8.89,16.64 8.89,14.66C8.89,13.04 10.27,11.72 11.97,11.72C13.67,11.72 15.05,13.04 15.05,14.66C15.05,15.73 16,16.6 17.13,16.6C18.28,16.6 19.21,15.73 19.21,14.66C19.21,10.89 15.96,7.83 11.96,7.83C9.12,7.83 6.5,9.41 5.35,11.86C4.96,12.67 4.76,13.62 4.76,14.66C4.76,15.44 4.83,16.67 5.43,18.27C5.53,18.53 5.4,18.82 5.14,18.91C4.88,19 4.59,18.87 4.5,18.62C4,17.31 3.77,16 3.77,14.66C3.77,13.46 4,12.37 4.45,11.42C5.78,8.63 8.73,6.82 11.96,6.82C16.5,6.82 20.21,10.33 20.21,14.65C20.21,16.27 18.83,17.59 17.13,17.59C15.43,17.59 14.05,16.27 14.05,14.65C14.05,13.58 13.12,12.71 11.97,12.71C10.82,12.71 9.89,13.58 9.89,14.65C9.89,16.36 10.55,17.96 11.76,19.16C12.71,20.1 13.62,20.62 15.03,21C15.3,21.08 15.45,21.36 15.38,21.62C15.33,21.85 15.12,22 14.91,22Z"></path></svg> {{ __('Manage Sessions') }}</a></li>
									@if($info->delete_account == 'enabled')
									<li><a href="#delete" data-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M128 405.429C128 428.846 147.198 448 170.667 448h170.667C364.802 448 384 428.846 384 405.429V160H128v245.429zM416 96h-80l-26.785-32H202.786L176 96H96v32h320V96z"></path></svg> {{ __('Delete account') }}</a></li>
									@endif
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="tab-content">
						<div class="setting-main-area tab-pane fade in active show" id="avatar">
							<div class="settings-content-area">
								<h4>{{ __('Avatar & Cover') }}</h4>
								@php 
								$user_data = json_decode(Auth::User()->value);
								@endphp
								<div class="settings-form">
									<div class="row">
										<div class="col-lg-12">
											<form action="{{ route('settings.cover') }}" method="POST" id="cover_form">
												@csrf
												<div class="cover-img">
													<label for="cover" id="cover_img" style="background-image: url({{ asset($user_data->cover) }});">
														<i class="fas fa-image d-none"></i>
													</label>
													<input type="file" name="cover" id="cover" class="d-none">
													<input type="hidden" id="cover_img_url" value="{{ route('settings.cover') }}">
												</div>
											</form>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<form action="{{ route('settings.profile') }}" method="POST" id="profile_form">
												<div class="profile-img">
													<label for="profile" id="profile_img" style="background-image: url({{ asset(Auth::User()->image) }});">
														<i class="fas fa-camera d-none"></i>
													</label>
													<input type="file" name="profile" id="profile" class="d-none">
													<input type="hidden" id="profile_img_url" value="{{ route('settings.profile') }}">
												</div>
												<input type="hidden" id="csrf_token_get" value="{{ csrf_token() }}">
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="setting-main-area verification_area tab-pane fade" id="verify">
							<div class="settings-content-area">
								@if($verification && $verification->status == 'pending')
								<div class="review-verification text-center">
									<i class="fas fa-history"></i>
									<div class="review-info">
										<h4>{{ __('Your request was received and is pending approval') }}</h4>
									</div>
								</div>
								@elseif($verification && $verification->status == 'approved')
								<div class="review-verification text-center">
									<i class="far fa-check-circle"></i>
									<div class="review-info">
										<h4>{{ __('Congratulations, you are verified. Thanks for verifying your ID') }}</h4>
									</div>
								</div>
								@else
								<h4>{{ __('Verification') }}</h4>
								<form action="{{ route('profile.verification') }}" method="POST" id="verification_form">
									@csrf
									<div class="settings-form">
										<div class="row">
											<div class="col-lg-4">
												<div class="upload-national-card" id="national_card">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="nation-card-content">
													<h4>{{ __('Upload Passport or ID') }}</h4>
													<p>{{ __('Please select a recent picture of your passport or id') }}</p>
													<a href="#"><label for="verification_id"><i class="fas fa-upload"></i> {{ __('Choose File') }} </label></a>
													<input type="file" name="national_id" id="verification_id" class="d-none">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="{{ __('First Name') }}" name="first_name">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="{{ __('Last Name') }}" name="last_name">
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<textarea class="form-control" placeholder="{{ __('Message') }}" name="message"></textarea>
												</div>
											</div>
										</div>
										<div class="settings-btn">
											<button id="profile_verify" type="submit f-right">{{ __('Submit') }}</button>
										</div>
									</div>
								</form>
								@endif
							</div>
						</div>
						<div class="setting-main-area tab-pane fade" id="twofactor">
							<form action="{{ route('profile.two_step') }}" method="POST" id="two_step_form">
								@csrf
								<div class="settings-content-area">
									<h4>{{ __('Two-factor authentication') }}</h4>
									<div class="settings-form">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<select class="form-control" name="two_step">
														<option {{ $user_data->two_step == 'enable' ? 'selected' : '' }} value="enable">{{ __('Enable') }}</option>
														<option {{ $user_data->two_step == 'disable' ? 'selected' : '' }} value="disable">{{ __('Disable') }}</option>
													</select>
												</div>
											</div>
										</div>
										<div class="important-note">
											<hr>
											<div class="main-note">
												<p>{{ __("Turn on 2-step login to level-up your account's security, Once turned on, you'll use both your password and a 6-digit security code sent to your email to log in.") }}</p>
											</div>
										</div>
										<div class="settings-btn">
											<button id="two_factor_button" type="submit f-right">{{ __('Submit') }}</button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="setting-main-area tab-pane fade" id="balence">
							<div class="settings-content-area">
								<div class="row">
									<div class="col-lg-6">
										<h4>{{ __('Balence') }}</h4>
									</div>
									<div class="col-lg-6">
										<div class="withdraw f-right">
											<a class="pjax" href="{{ route('withdraw.index') }}"><i class="far fa-clock"></i> {{ __('Withdrawals') }}</a>
										</div>
									</div>
								</div>
								@php 
								$currency_code = App\Option::where('key','currency')->first();
        						$currency_value = json_decode($currency_code->value);
								@endphp
								<div class="settings-form">
									<div class="row">
										<div class="col-lg-12">
											<div class="total-balence">
												<h2>{{ $currency_value->symbol }}{{ number_format($user_data->wallet,2) }}</h2>
												<p>{{ __('Your Balence') }}</p>
											</div>
										</div>
									</div>
									@if($info->user_payment_withdraw == 'enabled')
									<div class="row">
										<div class="col-lg-12">
											<div class="withdraw-dashboard">
												<hr>
												<h4>{{ __('Withdraw Request') }}</h4>
												<div class="withdraw-payment-choose">
													<nav>
														<ul class="nav nav-tabs">
															<li>
																<a href="#paypal_section" data-toggle="tab" class="active">
																	<div class="single-payment-method text-center">
																		<img src="{{ asset('frontend/img/paypal.png') }}">
																		<p>{{ __('Minimum') }} {{ $currency_value->symbol }}50.00</p>
																	</div>
																</a>
															</li>
															<li>
																<a href="#swift_section" data-toggle="tab">
																	<div class="single-payment-method text-center">
																		<img src="{{ asset('frontend/img/swift.png') }}">
																		<p>{{ __('Minimum') }} {{ $currency_value->symbol }}500.00</p>
																	</div>
																</a>
															</li>
														</ul>
													</nav>
													<div class="tab-content">
														<div class="paypal-section tab-pane fade active show" id="paypal_section">
															<form class="withdraw_form" action="{{ route('withdraw.store') }}" method="post">
																@csrf
																<div class="row">
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label>{{ __('PayPal E-mail') }}</label>
																			<input type="email" class="form-control" placeholder="{{ __('PayPal E-mail') }}" name="email">
																			<input type="hidden" name="type" value="paypal">
																		</div>
																	</div>	
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label>{{ __('Amount') }}</label>
																			<input type="number" class="form-control" placeholder="{{ __('Amount') }}" name="amount">
																		</div>
																	</div>
																</div>
																<div class="settings-btn">
																	<button class="withdraw_button" type="submit">{{ __('Submit withdrawal request') }}</button>
																</div>
															</form>
														</div>
														<div class="swift-section tab-pane fade" id="swift_section">
															<form class="withdraw_form" action="{{ route('withdraw.store') }}" method="POST">
																@csrf
																<div class="row">
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Full Name') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('Full Name') }}" name="name">
																			<input type="hidden" id="withdraw_index" value="{{ route('withdraw.index') }}">
																		</div>
																	</div>	
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Email') }}</label>
																			<input type="email" class="form-control" placeholder="{{ __('Email') }}" name="email">
																			<input type="hidden" name="type" value="swift">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Billing Address Line 1') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('Billing Address Line 1') }}" name="billing_address_1">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Billing Address Line 2(Optional)') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('Billing Address Line 2(Optional)') }}" name="billing_address_2">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('City') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('City') }}" name="city">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('State(Optional)') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('State(Optional)') }}" name="state">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Postal Code') }}</label>
																			<input type="number" class="form-control" placeholder="{{ __('Postal Code') }}" name="postal_code">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Amount') }}</label>
																			<input type="number" class="form-control" placeholder="{{ __('Amount') }}" name="amount">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Country') }}</label>
																			<div class="login-birthday-display">
																				<div class="login-form-gorup">
																					<select name="country">
																						@foreach($countries as $country)
																						<option value="{{ $country }}">{{ $country }}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<hr>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __("Bank Account Holder's Name") }}</label>
																			<input type="text" class="form-control" placeholder="{{ __("Bank Account Holder's Name") }}" name="account_holder_name">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Bank Account Number/IBAN') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('Bank Account Number/IBAN') }}" name="account_number">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('SWIFT Code') }}</label>
																			<input type="number" class="form-control" placeholder="{{ __('SWIFT Code') }}" name="swift_code">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Bank Name in Full') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('Bank Name in Full') }}" name="bank_full_name">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Bank Branch City') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('Bank Branch City') }}" name="bank_branch_city">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Bank Branch Country') }}</label>
																			<div class="login-birthday-display">
																				<div class="login-form-gorup">
																					<select name="bank_branch_country">
																						@foreach($countries as $country)
																						<option value="{{ $country }}">{{ $country }}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<hr>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Intermediary Bank - Bank Code') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('Intermediary Bank - Bank Code') }}" name="intermediary_bank_code">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Intermediary Bank - Name') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('Intermediary Bank - Name') }}" name="intermediary_bank_name">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Intermediary Bank - City') }}</label>
																			<input type="text" class="form-control" placeholder="{{ __('Intermediary Bank - City') }}" name="intermediary_bank_city">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="form-group">
																			<label>{{ __('Intermediary Bank - Country') }}</label>
																			<div class="login-birthday-display">
																				<div class="login-form-gorup">
																					<select name="intermediary_bank_country">
																						@foreach($countries as $country)
																						<option value="{{ $country }}">{{ $country }}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="settings-btn">
																	<button class="withdraw_button" type="submit">{{ __('Submit withdrawal request') }}</button>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif
								</div>
							</div>
						</div>
						@if($info->delete_account == 'enabled')
						<div class="setting-main-area tab-pane fade" id="delete">
							<form action="{{ route('profile.delete') }}" method="POST" id="delete_form">
								@csrf
								<div class="settings-content-area">
									<h4>{{ __('Delete account') }}</h4>
									<div class="settings-form">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="{{ __('Current Password') }}" name="password">
												</div>
											</div>
										</div>
										<div class="settings-btn">
											<button id="delete_form_button" type="submit f-right">{{ __('Delete') }}</button>
										</div>
									</div>
								</div>
							</form>
						</div>
						@endif
						<div class="setting-main-area tab-pane fade" id="manage">
							<div class="settings-content-area">
								<h4>{{ __('Manage Sessions') }}</h4>
								<div class="settings-form">
									<div class="row">
										<div class="col-lg-12">
											<div class="manage-session d-flex">
												<div class="main-icon">
													<i class="fas fa-laptop"></i>
												</div>
												<div class="manage-device d-block">
													<h4>{{ App\Helpers\UserSystemInfo::get_os() }}</h4>
													<div class="manage-join">
														<i class="far fa-window-restore"></i> {{ App\Helpers\UserSystemInfo::get_browsers() }}&nbsp;&nbsp;	
														<i class="fas fa-desktop"></i>{{ App\Helpers\UserSystemInfo::get_device() }}&nbsp;&nbsp;
														<i class="fas fa-map-marker-alt"></i> {{ App\Helpers\UserSystemInfo::get_ip() }}&nbsp;&nbsp;
													</div>
												</div>
												<input type="hidden" id="delete_session_url" value="{{ route('profile.delete_session') }}">
												<div class="delete-session">
													<a href="#" id="delete_session" class="f-right"><i class="fas fa-trash-alt"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@if($info->user_monetization == 'enabled')
						<div class="setting-main-area monetization_area tab-pane fade" id="monetization">
							@if($monetization && $monetization->status == 'pending')
							<div class="settings-content-area">
								<div class="review-verification text-center">
									<i class="fas fa-history"></i>
									<div class="review-info">
										<h4>{{ __('Your request was received and is pending approval') }}</h4>
									</div>
								</div>
							</div>
							@elseif($monetization && $monetization->status == 'approved')
							<div class="settings-content-area">
								<div class="review-verification text-center">
									<i class="far fa-check-circle"></i>
									<div class="review-info">
										<h4>{{ __('Congratulations, Your Monetization Request is Approved.') }}</h4>
									</div>
								</div>
							</div>
							@else
							<div class="settings-content-area">
								<h4>{{ __('Monetization') }}</h4>
								<div class="settings-form">
									<div class="row">
										<div class="col-lg-12">
											<div class="monetization-area text-center">
												<div class="monetization-vector">
													<img class="img-fluid" src="{{ asset('frontend/img/monetization.jpg') }}">
												</div>
												<div class="monetization-info">
													<h3>{{ __('Grow with TongTang') }}</h3>
													<p>{{ __("As a TongTang partner, you'll be eligible to earn money from your videos") }}</p>
													<p>{{ __('To get into the TongTang Partner Program, your channel needs 4,000 public watch hours in the last 12 months, and 1,000 followers.') }}</p>
												</div>
												<div class="monetization-box d-flex">
													<i class="far fa-clock"></i>
													<div class="monetization-require-info first d-block">
														<h5>{{ $total_followers }} {{ __('Followers') }}</h5>
														<p>{{ number_format(App\Option::where('key','followers')->first()->value) }} {{ __('required') }}</p>
													</div>
													<i class="far fa-clock"></i>
													<div class="monetization-require-info d-block">
														<h5>{{ $video_total_view }} {{ __('Total Public View') }}</h5>
														<p>{{ number_format(App\Option::where('key','total_view')->first()->value) }} {{ __('required') }}</p>
													</div>
												</div>
												<input type="hidden" id="monetization_request_url" value="{{ route('monetization_request') }}">
												@if($video_total_view >= App\Option::where('key','total_view')->first()->value && $total_followers >= App\Option::where('key','followers')->first()->value)
												<div class="send-monetization-area">
													<a href="#" id="monetization_request">{{ __('Send Monetization Request') }}</a>
												</div>
												@else
												<div class="send-monetization-area">
													<a href="javascript:void(0)" class="disabled">{{ __('Send Monetization Request') }}</a>
												</div>
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
							@endif
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- main area end -->
@endsection