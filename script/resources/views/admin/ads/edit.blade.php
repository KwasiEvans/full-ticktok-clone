@extends('layouts.backend.app')

@section('title','Edit Ads')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/selectric.css') }}">
@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Edit Ads') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Edit Ads') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Edit Ads') }}</h2>
			<p class="section-lead">{{ __('Edit Ads Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4>{{ __('Edit Ads') }}</h4>
							<form action="{{ route('admin.ads.update',$ads->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label>{{ __('Ads Title') }}</label>
									<input class="form-control" type="text" name="title" value="{{ $ads->title }}">
								</div>
								<div class="form-group">
									<label>{{ __('Url') }}</label>
									<input class="form-control" type="text" name="url" value="{{ $ads->url }}">
								</div>
								<div class="form-group imgUp">
									<label class="logo_label" for="page_image">{{ __('Select Image(480*100)') }}
										<div class="form-logo-area imagePreview" style="background-image: url('{{ asset($ads->media) }}');">
											<i class="fas fa-camera-retro"></i>
										</div>
									</label>
									<input type="file" name="media" id="page_image" class="uploadFile form-control d-none">
								</div>
								<div class="form-group">
									<label>{{ __('Target Audience') }}</label>
									<select class="form-control selectric" name="country">
            							<option value="select_all">{{ __('Select All') }}</option>
            							@foreach($countries as $country)
            							<option {{ $ads->country == $country ? 'selected' : '' }} value="{{ $country }}">{{ $country }}</option>
            							@endforeach
            						</select>
								</div>
								<div class="form-group">
									<label for="ads_pricing">{{ __('Ads Type') }}</label>
									<select class="form-control selectric" name="pricing" id="ads_pricing">
            							<option {{ $ads->pricing == 'per_link' ? 'selected' : '' }} value="per_link">{{ __('Per Click') }}</option>
            							<option {{ $ads->pricing == 'per_impression' ? 'selected' : '' }} value="per_impression">{{ __('Per Impression') }}</option>
            						</select>
								</div>
								<div class="form-group">
									<label for="ads_status">{{ __('Ads Status') }}</label>
									<select class="form-control selectric" name="status" id="ads_status">
            							<option {{ $ads->status == 'pending' ? 'selected' : '' }} value="pending">{{ __('Pending') }}</option>
            							<option {{ $ads->status == 'publish' ? 'selected' : '' }} value="publish">{{ __('Publish') }}</option>
            							<option {{ $ads->status == 'complete' ? 'selected' : '' }} value="complete">{{ __('Complete') }}</option>
            							<option {{ $ads->status == 'reject' ? 'selected' : '' }} value="reject">{{ __('Rejected') }}</option>
            						</select>
								</div>
								<div class="form-group">
									<label>{{ __('Total ads spending limit') }}</label>
									<input type="number" name="total_limit" class="form-control" value="{{ $ads->total_limit }}">
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

@push('js')
<script src="{{ asset('backend/assets/js/jquery.selectric.min.js') }}"></script>
@endpush