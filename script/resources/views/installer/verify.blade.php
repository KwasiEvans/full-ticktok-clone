<!DOCTYPE html>
<html>
<head>
	<title>{{ __('Installer') }}</title>
	<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/font.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/default.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.ico') }}">
	
</head>
<body>

	

	<!-- requirments-section-start -->
	<section class="pt-50 mb-50">
		<div class="requirments-section">
			<div class="content-requirments d-flex justify-content-center">
				<div class="requirments-main-content">
					<div class="multi-step text-center">
						<nav>
							<ul id="progressbar">
								<li class="active">
									<div class="step-number">
										<span>{{ __(1) }}</span>
									</div>
									<div class="step-info">
										{{ __('Requirments') }}
									</div>
								</li>
								<li class="active">
									<div class="step-number">
										<span>{{ __(2) }}</span>
									</div>
									<div class="step-info">
										{{ __('Verify') }}
									</div>
								</li>
								<li>
									<div class="step-number">
										<span>{{ __(3) }}</span>
									</div>
									<div class="step-info">
										{{ __('Configuration') }}
									</div>
								</li>
								<li>
									<div class="step-number">
										<span>{{ __(4) }}</span>
									</div>
									<div class="step-info">
										{{ __('Complete') }}
									</div>
								</li>
							</ul>
						</nav>
					</div>
					<div class="installer-header text-center">

					</div>
					<form action="{{ route('install.verify_check') }}" method="POST">
						@csrf
						<div class="custom-form install-form">
							<div class="row">
								<div class="col-lg-12">
									@if(Session::has('error_msg'))
									<div class="alert alert-danger" role="alert">
									  {{ Session::get('error_msg') }}
									</div>
									@endif
									<div class="form-group">
										<label for="key">{{ __('Enter Purchase Key') }}</label>
										<input type="text" class="form-control" id="key" name="key" required placeholder="Enter Purchase Key">
									</div>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary install-btn f-right">{{ __('Verify') }}</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- requirments-section-end -->
	<script src="{{ asset('frontend/js/vendor/jquery-3.5.1.js') }}"></script>
	<script src="{{ asset('frontend/js/install/install.js') }}"></script>
</body>
</html>