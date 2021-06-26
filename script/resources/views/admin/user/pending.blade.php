@extends('layouts.backend.app')

@section('title','Pending Users')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Pending Users') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Pending Users') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Pending Users') }}</h2>
			<p class="section-lead">{{ __('Pending Users Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Pending Users') }}</h4>
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
										<th>{{ __('Email') }}</th>
										<th>{{ __('Country') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
									@foreach($pending_users as $key=>$user)
									@if(json_decode($user->value)->status == 'deactive')
									<tr>
										<td>{{ $key + 1 }}</td>
										<th><a target="__blank" href="{{ route('profile.show',$user->slug) }}">{{ $user->username }}</a></th>
										<td>{{ $user->email }}</td>
										<td>{{ $user->country }}</td>
										@php 
										$user_data = json_decode($user->value);
										@endphp
										<td>
											@if($user_data->status == 'active')
											<div class="badge badge-success">{{ __('Approved') }}</div>
											@else
											<div class="badge badge-danger">{{ __('Pending') }}</div>
											@endif
										</td>
										<td>
											<a href="{{ route('admin.user.approved',$user->id) }}" class="btn btn-primary">{{ __('Approved') }}</a>
											<a href="{{ route('admin.user.delete',$user->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
										</td>
									</tr>
									@endif
									@endforeach
								</table>
								<div class="f-right">
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
