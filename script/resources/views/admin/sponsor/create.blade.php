@extends('layouts.backend.app')

@section('title','Add New Sponsor')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Add New Sponsor') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Add New Sponsor') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Add New Sponsor') }}</h2>
			<p class="section-lead">{{ __('Add New Sponsor Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Create Sponsor') }}</h4>
						</div>
						<div class="card-body">
							<form action="{{ route('admin.sponsor.store') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label>{{ __('Title') }}</label>
									<input type="text" class="form-control" name="title">
								</div>
								<div class="form-group">
									<label>{{ __('Url') }}</label>
									<input type="text" class="form-control" name="url">
								</div>
								<div class="form-group imgUp">
									<label class="logo_label" for="sponsor_image">{{ __('Image') }}
										<div class="form-logo-area imagePreview">
											<i class="fas fa-camera-retro"></i>
										</div>
									</label>
									<input type="file" id="sponsor_image" name="image" class="uploadFile form-control d-none">
								</div>
								<div class="text-right">
									<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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
