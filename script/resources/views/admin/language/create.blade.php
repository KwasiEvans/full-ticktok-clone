@extends('layouts.backend.app')

@section('title','Add New Language')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/selectric.css') }}">
@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Add New Language') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Add New Language') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Add New Language') }}</h2>
			<p class="section-lead">{{ __('Select Language option and create a new language') }}</p>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Add New Language') }}</h4>
						</div>
						<div class="card-body">
							<form action="{{ route('admin.language.store') }}" method="POST">
								@csrf
			                    <div class="form-group">
									<label>{{ __('Select Language') }}</label>
									<select class="form-control selectric" name="language">
										@foreach($languages as $language)
										<option value="{{ $language->code }}">{{ $language->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="text-right">
									<button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
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