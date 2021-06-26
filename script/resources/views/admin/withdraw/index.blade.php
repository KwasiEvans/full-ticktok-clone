@extends('layouts.backend.app')

@section('title','Manage Withdraw Request')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage Withdraw Request') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage Withdraw Request') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage Withdraw Request') }}</h2>
			<p class="section-lead">{{ __('Manage Withdraw Request Section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage Withdraw Request') }}</h4>
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
										<th>{{ __('Transaction id') }}</th>
										<th>{{ __('Email') }}</th>
										<th>{{ __('Payment Method') }}</th>
										<th>{{ __('Total Amount') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
									@php 
									$currency_code = App\Option::where('key','currency')->first();
        							$currency_value = json_decode($currency_code->value);
									@endphp
									@foreach($withdraws as $key=>$withdraw)
									<tr>
										<td>{{ $key + 1 }}</td>
										<td>{{ $withdraw->withdraw_id }}</td>
										<td>{{ $withdraw->email }}</td>
										<td>
											@if($withdraw->type == 'paypal')
											{{ __('Paypal') }}
											@else
											{{ __('Swift') }}
											@endif
										</td>
										<td>{{ $currency_value->symbol }}{{ number_format($withdraw->amount,2) }}</td>
										<td>
											@if($withdraw->status == 'pending')
											<div class="badge badge-danger">{{ __('Pending') }}</div>
											@elseif($withdraw->status == 'approve')
											<div class="badge badge-success">{{ __('Approved') }}</div>
											@else
											<div class="badge badge-danger">{{ __('Rejected') }}</div>
											@endif
										</td>
										<td>
											<a href="{{ route('admin.withdraw.accept',$withdraw->id) }}" class="btn btn-primary">{{ __('Accept') }}</a>
											<a href="{{ route('admin.withdraw.reject',['user_id'=>$withdraw->user_id,'withdraw_id'=>$withdraw->id]) }}" class="btn btn-info">{{ __('Reject') }}</a>
											@if($withdraw->type != 'paypal')
											<a href="#" data-toggle="modal" data-target="#swift_{{ $withdraw->id }}" class="btn btn-danger">{{ __('View') }}</a>
											@endif
										</td>
									</tr>
									@endforeach
								</table>
								<div class="f-right">
									{{ $withdraws->links() }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


@foreach($withdraws as $withdraw)
@if($withdraw->type != 'paypal')
@php 
$withdraw_data = json_decode($withdraw->value);
@endphp
<!-- Modal -->
<div class="modal fade" id="swift_{{ $withdraw->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bank Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-lg-12">
        		<div class="single-content">
        			<strong>Billing Address 1:</strong><span> {{ $withdraw_data->billing_address_1 }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Billing Address 2(optional):</strong><span> {{ $withdraw_data->billing_address_2 }}</span>
        		</div>
        		<div class="single-content">
        			<strong>City:</strong><span> {{ $withdraw_data->city }}</span>
        		</div>
        		<div class="single-content">
        			<strong>State:</strong><span> {{ $withdraw_data->state }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Postal Code:</strong><span> {{ $withdraw_data->postal_code }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Amount:</strong><span> {{ $currency_value->symbol }}{{ $withdraw->amount }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Country:</strong><span> {{ $withdraw_data->country }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Bank Account Holder's Name:</strong><span> {{ $withdraw_data->account_holder_name }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Bank Account Number/IBAN:</strong><span> {{ $withdraw_data->account_number }}</span>
        		</div>
        		<div class="single-content">
        			<strong>SWIFT Code:</strong><span> {{ $withdraw_data->swift_code }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Bank Name in Full:</strong><span> {{ $withdraw_data->bank_full_name }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Bank Branch City:</strong><span> {{ $withdraw_data->bank_branch_city }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Bank Branch Country:</strong><span> {{ $withdraw_data->bank_branch_country }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Intermediary Bank - Bank Code:</strong><span> {{ $withdraw_data->intermediary_bank_code }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Intermediary Bank - Name:</strong><span> {{ $withdraw_data->intermediary_bank_name }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Intermediary Bank - City:</strong><span> {{ $withdraw_data->intermediary_bank_city }}</span>
        		</div>
        		<div class="single-content">
        			<strong>Intermediary Bank - Country:</strong><span> {{ $withdraw_data->intermediary_bank_country }}</span>
        		</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif
@endforeach

@endsection
