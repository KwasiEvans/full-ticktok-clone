@extends('layouts.backend.app')

@section('title','Manage Sponsor')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage Sponsor') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage Sponsor') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage Sponsor') }}</h2>
			<p class="section-lead">{{ __('Manage Sponsor Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage Sponsor') }}</h4>
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
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped">
									<tr>
										<th>{{ __('Id') }}</th>
										<th>{{ __('Image') }}</th>
										<th>{{ __('Title') }}</th>
										<th>{{ __('Url') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
									@foreach($sponsors as $key=>$sponsor)
									<tr>
										<td>{{ $key + 1 }}</td>
										<td><img class="table_img" src="{{ asset($sponsor->image) }}"></td>
										<th>{{ $sponsor->title }}</th>
										<td>{{ $sponsor->url }}</td>
										<td>
											<a href="{{ route('admin.sponsor.edit',$sponsor->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
											<a href="{{ route('admin.sponsor.delete',$sponsor->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
										</td>
									</tr>
									@endforeach
								</table>
								<div class="f-right">
									{{ $sponsors->links() }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
