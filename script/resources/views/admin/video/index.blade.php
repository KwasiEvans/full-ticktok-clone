@extends('layouts.backend.app')

@section('title','Manage Videos')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage Videos') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage Videos') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage Videos') }}</h2>
			<p class="section-lead">{{ __('Manage Videos Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage Videos') }}</h4>
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
										<th>{{ __('Title') }}</th>
										<th>{{ __('Total View') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
									@foreach($videos as $key=>$video)
									<tr>
										<td>{{ $key + 1 }}</td>
										<th><a target="__blank" href="{{ route('video.show',$video->slug) }}">{{ $video->title }}</a></th>
										<td>{{ App\Helpers\UserSystemInfo::conveter($video->view) }}</td>
										<td>
											@if($video->status == 'public')
											<div class="badge badge-success">{{ __('public') }}</div>
											@else
											<div class="badge badge-primary">{{ __('privet') }}</div>
											@endif
										</td>
										<td>
											<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#fake{{ $video->id }}">{{ __('Add Fake View') }}</a>
											<a href="{{ route('admin.video.delete',$video->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
										</td>
									</tr>
									@endforeach
								</table>
								<div class="f-right">
									{{ $videos->links() }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@foreach($videos as $video)
<div class="modal fade" id="fake{{ $video->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('Add Fake View') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('admin.video.view',$video->id) }}" method="POST">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label for="view" class="col-form-label">{{ __('View') }}:</label>
						<input type="number" class="form-control" id="view" name="view">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
					<button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endforeach
@endsection

