@extends('layouts.backend.app')

@section('title','Dashboard')

@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Dashboard') }}</h1>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-primary">
						<i class="far fa-file-video"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>{{ __('Total Video') }}</h4>
						</div>
						<div class="card-body">
							{{ $video_count }}
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-danger">
						<i class="far fa-user"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>{{ __('Total User') }}</h4>
						</div>
						<div class="card-body">
							{{ $user_count }}
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-warning">
						<i class="fab fa-buysellads"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>{{ __('Total Advertising') }}</h4>
						</div>
						<div class="card-body">
							{{ $ads_count }}
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-success">
						<i class="fas fa-allergies"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>{{ __('Total Sponsor') }}</h4>
						</div>
						<div class="card-body">
							{{ $sponsor_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>{{ __('Manage Videos') }}</h4>
						<div class="card-header-form">
							<div class="input-group">
								<input type="text" id="data_search" class="form-control" placeholder="Search">
								<div class="input-group-btn">
									<button class="btn btn-primary"><i class="fas fa-search"></i></button>
								</div>
							</div>
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