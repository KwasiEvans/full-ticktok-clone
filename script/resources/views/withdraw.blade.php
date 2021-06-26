@extends('layouts.frontend.app')

@section('title','Withdraw')

@section('content')
<!-- main area start -->
<section>
	<div class="main-area pb-50">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="settings-area p-0">
						<div class="withdraw-body">
							<h4>{{ __('Withdraw History') }}</h4>
							<div class="ads-table table-responsive mt-30">
								<table class="table">
									<thead class="thead-light">
										<tr>
											<th scope="col">#</th>
											<th scope="col">{{ __('Transaction Id') }}</th>
											<th scope="col">{{ __('Email') }}</th>
											<th scope="col">{{ __('Payment Method') }}</th>
											<th scope="col">{{ __('Total Amount') }}</th>
											<th scope="col">{{ __('Status') }}</th>
										</tr>
									</thead>
									<tbody>
										@php 
										$currency_code = App\Option::where('key','currency')->first();
        								$currency_value = json_decode($currency_code->value);
										@endphp
										@foreach($withdraws as $key=>$withdraw)
										<tr>
											<th scope="row">{{ $key + 1 }}</th>
											<td>{{ $withdraw->withdraw_id }}</td>
											<td class="email">{{ $withdraw->email }}</td>
											<td>{{ $withdraw->type }}</td>
											<td>{{ $currency_value->symbol }}{{ number_format($withdraw->amount,2) }}</td>
											<td>
												@if($withdraw->status == 'pending')
												<div class="ads-publish">
										      		<a href="javascript:void(0)" class="pjax pending disabled">{{ __('Pending') }}</a>
										      	</div>
												@elseif($withdraw->status == 'approve')
												<div class="ads-publish">
										      		<a href="javascript:void(0)" class="pjax publish disabled">{{ __('Approved') }}</a>
										      	</div>
										      	@else
										      	<div class="ads-publish">
										      		<a href="javascript:void(0)" class="pjax reject disabled">{{ __('Rejected') }}</a>
										      	</div>
												@endif
											</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot class="thead-light">
										<tr>
											<th scope="col">#</th>
											<th scope="col">{{ __('Transaction Id') }}</th>
											<th scope="col">{{ __('Email') }}</th>
											<th scope="col">{{ __('Payment Method') }}</th>
											<th scope="col">{{ __('Total Amount') }}</th>
											<th scope="col">{{ __('Status') }}</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div> 
	</div>
</section>
@endsection