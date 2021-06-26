@extends('layouts.backend.app')

@section('title','Manage Ads')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage Ads') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage Ads') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage Ads') }}</h2>
			<p class="section-lead">{{ __('Manage Ads Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage Ads') }}</h4>
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
										<th>{{ __('Pricing') }}</th>
										<th>{{ __('Result') }}</th>
										<th>{{ __('Total Spent') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
									@php 
									$currency_code = App\Option::where('key','currency')->first();
        							$currency_value = json_decode($currency_code->value);
									@endphp
									@foreach($ads as $key=>$ad)
									<tr>
										<td>{{ $key + 1 }}</td>
										<th>{{ $ad->title }}</th>
										<td>
											@if($ad->pricing == 'per_link')
											{{ __('Per Link') }}
											@else
											{{ __('Per Impression') }}
											@endif
										</td>
										<td>
											@if($ad->pricing == 'per_link')
											{{ $ad->result }} {{ __('Clicks') }}
											@else
											{{ $ad->result }} {{ __('Impression') }}
											@endif
										</td>
										<td>{{ $currency_value->symbol }}{{ number_format($ad->total_spent,2) }}</td>
										<td>
											@if($ad->status == 'publish')
											<div class="badge badge-success">{{ __('published') }}</div>
											@elseif($ad->status == 'pending')
											<div class="badge badge-danger">{{ __('pending') }}</div>
											@elseif($ad->status == 'reject')
											<div class="badge badge-danger">{{ __('rejected') }}</div>
											@elseif($ad->status == 'complete')
											<div class="badge badge-primary">{{ __('completed') }}</div>
											@endif
										</td>
										<td>
											<a href="{{ route('admin.ads.edit',$ad->id) }}" class="btn btn-info">{{ __('Edit') }}</a>
											<a href="{{ route('admin.ads.delete',$ad->id) }}" class="btn btn-danger">{{ __('Delete') }}</a>
										</td>
									</tr>
									@endforeach
								</table>
								<div class="f-right">
									{{ $ads->links() }}
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
