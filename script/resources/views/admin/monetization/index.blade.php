@extends('layouts.backend.app')

@section('title','Manage Monetization Request')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage Monetization Request') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage Monetization Request') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage Monetization Request') }}</h2>
			<p class="section-lead">{{ __('Manage Monetization Request section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage Monetization Request') }}</h4>
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
										<th>{{ __('Username') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
									@foreach($monetizations as $key=>$monetization)
									<tr>
										<td>{{ $key + 1 }}</td>
										
										<th><a target="__blank" href="{{ route('profile.show',App\User::find($monetization->user_id)->slug) }}">{{ App\User::find($monetization->user_id)->username }}</a></th>
										<td>
											@if($monetization->status == 'pending')
											<div class="badge badge-danger">{{ __('Pending') }}</div>
											@endif
										</td>
										<td>
											<a href="{{ route('admin.monetization.verify',$monetization->id) }}" class="btn btn-primary">{{ __('Verify') }}</a>
											<a target="__blank" href="{{ route('profile.show',App\User::find($monetization->user_id)->slug) }}" class="btn btn-info">{{ __('View') }}</a>
											<a href="{{ route('admin.monetization.delete',$monetization->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
										</td>
									</tr>
									@endforeach
								</table>
								<div class="f-right">
									{{ $monetizations->links() }}
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
