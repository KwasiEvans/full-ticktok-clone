@extends('layouts.backend.app')

@section('title','Manage User Reports')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage Reports') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage Reports') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage Reports') }}</h2>
			<p class="section-lead">{{ __('Manage Reports Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage Reports') }}</h4>
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
										<th>{{ __('Reporter') }}</th>
										<th>{{ __('Report Text') }}</th>
										<th>{{ __('Report Time') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
									@foreach($reports as $key=>$report)
									<tr>
										<td>{{ $key + 1 }}</td>
										<th><a target="__blank" href="{{ route('profile.show',App\User::find($report->user_id)->slug) }}">{{ App\User::find($report->user_id)->username }}</a></th>
										<td>{{ $report->body }}</td>
										<td>{{ $report->created_at->diffForHumans() }}</td>
										<td>
											<a target="__blank" href="{{ route('profile.show',App\User::find($report->parent_id)->slug) }}" class="btn btn-primary">View</a>
											<a href="{{ route('admin.video.report_delete',$report->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
										</td>
									</tr>
									@endforeach
								</table>
								<div class="f-right">
									{{ $reports->links() }}
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
