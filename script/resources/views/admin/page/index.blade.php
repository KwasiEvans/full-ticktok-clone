@extends('layouts.backend.app')

@section('title','Manage Page')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage Page') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage Page') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage Page') }}</h2>
			<p class="section-lead">{{ __('Manage Page section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage Page') }}</h4>
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
										<th>{{ __('Description') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
									@foreach($pages as $key=>$page)
									<tr>
										<td>{{ $key + 1 }}</td>
										<th>{{ $page->title }}</th>
										<td>{{ Str::limit($page->description,50) }}</td>
										<td>
											<a href="{{ route('admin.page.edit',$page->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
											<a href="{{ route('admin.page.delete',$page->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
										</td>
									</tr>
									@endforeach
								</table>
								<div class="f-right">
									{{ $pages->links() }}
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
