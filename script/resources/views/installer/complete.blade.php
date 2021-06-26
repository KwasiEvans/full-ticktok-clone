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
	<section class="mt-50 mb-50">
		<div class="requirments-section">
			<div class="content-requirments d-flex justify-content-center">
				<div class="requirments-main-content">
					<div class="multi-step text-center">
						<nav>
							<ul id="progressbar">
								<li class="active">
									<div class="step-number">
										<span>1</span>
									</div>
									<div class="step-info">
										{{ __('Requirments') }}
									</div>
								</li>
								<li class="active">
									<div class="step-number">
										<span>2</span>
									</div>
									<div class="step-info">
										{{ __('Verify') }}
									</div>
								</li>
								<li class="active">
									<div class="step-number">
										<span>3</span>
									</div>
									<div class="step-info">
										{{ __('Configuration') }}
									</div>
								</li>
								<li class="active">
									<div class="step-number">
										<span>3</span>
									</div>
									<div class="step-info">
										{{ __('Complete') }}
									</div>
								</li>
							</ul>
						</nav>
					</div>
					<div class="installer-header text-center">
						<h2>{{ __('Complete') }}</h2>
						<p>{{ __('Tongtang installed successfully!') }}</p>
					</div>
					<div class="installer-complete">
						<div class="row">
							<div class="col-lg-6">
								<a href="{{ url('/') }}">
									<div class="single-left-area text-center">
										<div class="icon">
											<i class="fas fa-tv"></i>
										</div>
										<span>{{ __('Go to HomePage') }}</span>
									</div>
								</a>
							</div>
							<div class="col-lg-6">
								<a href="{{ url('login') }}">
									<div class="single-left-area text-center">
										<div class="icon">
											<i class="fas fa-cog"></i>
										</div>
										<span>{{ __('Login to Administration') }}</span>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- requirments-section-end -->
</body>
</html>