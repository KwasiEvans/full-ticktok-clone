@extends('layouts.backend.app')

@section('title','Manage Language')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/selectric.css') }}">
@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage Language') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage Language') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage Language') }}</h2>
			<p class="section-lead">{{ __('Manage language section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage Language') }}</h4>
							<div class="card-header-form">
								<form>
									<div class="input-group">
										<input type="text" id="data_search" class="form-control" placeholder="Search">
										<div class="input-group-btn">
											<button class="btn btn-primary"><i class="fas fa-search"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="card-body">
							<form action="{{ route('admin.language.active') }}" method="POST">
								@csrf
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group">
											<select class="form-control selectric">
												<option>{{ __('Set active labguage') }}</option>
											</select>
										</div>
									</div>
									<div class="col-lg-2 p-0">
										<button type="submit" class="btn btn-primary btn-lg">{{ __('Apply') }}</button>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table table-striped">
										<tr>
											<th class="text-center">
												<div class="custom-checkbox custom-control">
													<input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
													<label for="checkbox-all" class="custom-control-label">&nbsp;</label>
												</div>
											</th>
											<th>{{ __('Language Name') }}</th>
											<th>{{ __('Action') }}</th>
										</tr>
										@foreach($languages as $lang)
										<tr>
											<td class="text-center">
												<div class="custom-checkbox custom-control">
													<input name="lang_code[]" {{ $lang->status == 'active' ? 'checked' : '' }} value="{{ $lang->code }}" type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="lang_input_{{ $lang->code }}">
													<label for="lang_input_{{ $lang->code }}" class="custom-control-label">&nbsp;</label>
												</div>
											</td>
											<td>{{ $lang->name }}</td>
											<td>
												<a href="{{ route('admin.language.edit',$lang->code) }}" class="btn btn-primary">{{ __('Edit') }}</a>
												<a href="{{ route('admin.language.delete',$lang->code) }}" class="btn btn-danger">{{ __('Delete') }}</a>
											</td>
										</tr>
										@endforeach
									</table>
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