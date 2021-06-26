@extends('layouts.backend.app')

@section('title','Manage Verification Request')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage Verification Request') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage Verification Request') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage Verification Request') }}</h2>
			<p class="section-lead">{{ __('Manage Verification Request Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage Verification Request') }}</h4>
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
										<th>{{ __('National Id') }}</th>
										<th>{{ __('User Name') }}</th>
										<th>{{ __('Message') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
									@foreach($verifications as $key=>$verification)
									<tr>
										<td>{{ $key + 1 }}</td>
										<td><img class="table_img" src="{{ asset($verification->image) }}"></td>
										<th><a target="__blank" href="{{ route('profile.show',App\User::find($verification->user_id)->slug) }}">{{ App\User::find($verification->user_id)->username }}</a></th>
										<td>{{ $verification->message }}</td>
										<td>
											@if($verification->status == 'pending')
											<div class="badge badge-danger">{{ __('Pending') }}</div>
											@endif
										</td>
										<td>
											<a href="{{ route('admin.user.verify',$verification->id) }}" class="btn btn-primary">{{ __('Verify') }}</a>
											<a href="#" data-toggle="modal" data-target="#verify_{{ $verification->id }}" class="btn btn-info">View</a>
											<a href="{{ route('admin.user.verify_delete',$verification->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
										</td>
									</tr>
									@endforeach
								</table>
								<div class="f-right">
									{{ $verifications->links() }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@foreach($verifications as $verify)
<div class="modal fade" id="verify_{{ $verify->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('National Id Card') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="img-fluid" src="{{ asset($verify->image) }}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Close') }}</button>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
