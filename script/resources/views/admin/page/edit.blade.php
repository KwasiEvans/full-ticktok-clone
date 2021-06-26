@extends('layouts.backend.app')

@section('title','Edit Page')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Edit Page') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Edit Page') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Edit Page') }}</h2>
			<p class="section-lead">{{ __('Edit Page section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Edit Page') }}</h4>
						</div>
						<div class="card-body">
							<form action="{{ route('admin.page.update',$page->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="form-group">
									<label>{{ __('Title') }}</label>
									<input type="text" class="form-control" name="title" value="{{ $page->title }}">
								</div>
								<div class="form-group">
									<label>{{ __('Description') }}</label>
									<textarea class="form-control" name="description">{{ $page->description }}</textarea>
								</div>
								<div class="form-group imgUp">
									<label class="logo_label" for="page_image">{{ __('Image') }}
										<div class="form-logo-area imagePreview" style="background-image: url('{{ asset($page->image) }}');">
											<i class="fas fa-camera-retro"></i>
										</div>
									</label>
									<input type="file" name="image" id="page_image" class="uploadFile form-control d-none">
								</div>
								<div class="text-right">
									<button class="btn btn-primary">{{ __('Update') }}</button>
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
