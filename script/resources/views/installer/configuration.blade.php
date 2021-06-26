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

	<!-- loader seaction start -->
	<section class="loading_bar">
		<div class="load">
			<div class="fusion-slider-loading">
			</div>
			<div>
				<h3 class="install-info"></h3>
				<div class="back-btn d-flex justify-content-center">
					<a class="back btn d-none" href="{{ route('install.configuration') }}">{{ __('Try Again') }}</a>
				</div>
			</div>
		</div>
	</section>
	<!-- loader seaction start -->

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
								<li class="active">
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
						<h2>{{ __('Configuration') }}</h2>
						<p>{{ __('Please enter your database connection details') }}</p>
					</div>
					<form action="{{ route('install.store') }}" method="POST" id="install_submit">
						@csrf
						<div class="custom-form install-form">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="app_name">{{ __('App Name') }}</label>
										<input type="text" class="form-control" id="app_name" name="app_name" required="" placeholder="App Name without space">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="db_host">{{ __('Database Host') }}</label>
										<input type="text" value="localhost" class="form-control" id="db_host" name="db_host" required="" placeholder="Database Host">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="db_name">{{ __('Database Name') }}</label>
										<input type="text" class="form-control" id="db_name" name="db_name" required="" placeholder="Database Name">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="db_user">{{ __('Database Username') }}</label>
										<input type="text" class="form-control" id="db_user" name="db_user" required="" placeholder="Database Username">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="db_pass">{{ __('Database Password') }}</label>
										<input type="text" class="form-control" id="db_pass" name="db_pass" placeholder="Database Password">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="hidden" value="{{ url('/') }}" class="form-control none" id="app_url" name="app_url" required="" placeholder="App Url">
										<input type="hidden" id="migrate_url" value="{{ route('install.migrate') }}">
										<input type="hidden" id="seed_url" value="{{ route('install.seed') }}">
										<input type="hidden" id="check_url" value="{{ route('install.check') }}">
										<input type="hidden" id="home_url" value="{{ url('/') }}">
									</div>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary install-btn f-right">{{ __('Save & Install') }}</button>
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