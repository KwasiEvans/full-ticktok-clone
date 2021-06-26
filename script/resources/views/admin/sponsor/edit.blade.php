@extends('layouts.backend.app')

@section('title','Edit Sponsor')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Edit Sponsor') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Edit Sponsor') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Edit Sponsor') }}</h2>
			<p class="section-lead">{{ __('Edit Sponsor Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Edit Sponsor') }}</h4>
						</div>
						<div class="card-body">
							<form action="{{ route('admin.sponsor.update',$sponsor->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="form-group">
									<label>{{ __('Title') }}</label>
									<input type="text" class="form-control" name="title" value="{{ $sponsor->title }}">
								</div>
								<div class="form-group">
									<label>{{ __('Url') }}</label>
									<input type="text" class="form-control" name="url" value="{{ $sponsor->url }}">
								</div>
								<div class="form-group imgUp">
									<label class="logo_label" for="sponsor_image">{{ __('Image') }}
										<div class="form-logo-area imagePreview" style="background-image: url('{{ asset($sponsor->image) }}');">
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
