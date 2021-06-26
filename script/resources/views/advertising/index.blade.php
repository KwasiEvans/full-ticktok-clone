@extends('layouts.frontend.app')

@section('title','Advertising')

@section('content')
<!-- success-alert start -->
<div class="alert-message-area">
	<div class="alert-content">
		<h4 class="ale">{{ __('Your Settings Successfully Updated') }}</h4>
	</div>
</div>
<!-- success-alert end -->

<!-- error-alert start -->
<div class="error-message-area">
	<div class="error-content">
		<h4 class="error-msg">{{ __('Your Settings Successfully Updated') }}</h4>
	</div>
</div>
<!-- error-alert end -->

<!-- main area start -->
<section>
    <div class="main-area pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                	<div class="ads-content-area">
                		@php 
						$currency_code = App\Option::where('key','currency')->first();
        				$currency_value = json_decode($currency_code->value);
						@endphp
                		<div class="ads-header d-flex">
                			<h4><i class="fab fa-adn ads"></i> <span class="ads">{{ __('Advertising') }}</span></h4>
                			<h4><a href="#" data-toggle="modal" data-target="#wallet"><i class="far fa-credit-card"></i> {{ __('Wallet') }}({{ $currency_value->symbol }}{{ number_format($user_data->wallet,2) }})</a></h4>
                			<div class="create-ads-button">
                				<a class="pjax" href="{{ route('ads.create') }}"><i class="fas fa-plus"></i> {{ __('Create Ad') }}</a>
                			</div>
                		</div>
                		<div class="ads-table table-responsive mt-30">
                			<table class="table">
							  <thead class="thead-light">
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">{{ __('Status') }}</th>
							      <th scope="col">{{ __('Name') }}</th>
							      <th scope="col">{{ __('Results') }}</th>
							      <th scope="col">{{ __('Spent') }}</th>
							      <th scope="col">{{ __('Action') }}</th>
							    </tr>
							  </thead>
							  <tbody>
							  	@foreach($advertising as $key=>$ads)
							    <tr>
							      <th scope="row">{{ $key + 1 }}</th>
							      <td>
							      	@if($ads->status == 'publish')
							      	<div class="ads-publish">
							      		<a href="{{ route('ads.pending',$ads->id) }}" class="pjax publish">{{ __('published') }}</a>
							      	</div>
							      	@elseif($ads->status == 'pending')
							      	<div class="ads-publish">
							      		<a href="{{ route('ads.approved',$ads->id) }}" class="pjax pending">{{ __('pending') }}</a>
							      	</div>
							      	@elseif($ads->status == 'complete')
							      	<div class="ads-publish">
							      		<a href="javascript:void(0)" class="complete">{{ __('completed') }}</a>
							      	</div>
							      	@else
							      	<div class="ads-publish">
							      		<a href="javascript:void(0)" class="reject disabled">{{ __('rejected') }}</a>
							      	</div>
							      	@endif
							      </td>
							      <td>{{ $ads->title }}</td>
							      <td>
							      	@if($ads->pricing == 'per_link')
							      	{{ $ads->result }} {{ __('Clicks') }}
							      	@else
							      	{{ $ads->result }} {{ __('People Impression') }}
							      	@endif
							      </td>
							      <td>{{ $currency_value->symbol }}{{ $ads->total_spent }}</td>
							      <td>
							      	<a class="pjax" href="{{ route('ads.edit',$ads->id) }}"><i class="far fa-edit"></i></a>
							      	<a href="javascript:void(0)" onclick="ads_delete('{{ $ads->id }}')"><i class="fas fa-trash-alt"></i></a>
							      </td>
							    </tr>
							    @endforeach
							    <input type="hidden" id="ads_delete_url" value="{{ route('ads.delete') }}">
							  </tbody>
							  <tfoot class="thead-light">
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">{{ __('Status') }}</th>
							      <th scope="col">{{ __('Name') }}</th>
							      <th scope="col">{{ __('Results') }}</th>
							      <th scope="col">{{ __('Spent') }}</th>
							      <th scope="col">{{ __('Action') }}</th>
							    </tr>
							  </tfoot>
							</table>
                		</div>		
                	</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- main area end -->


<div class="modal fade" id="wallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content paypal-balence">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('My Balence') }} <span class="balence_color">{{ $currency_value->symbol }}{{ number_format($user_data->wallet,2) }}</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="paypal_form">
	      <div class="modal-body">
	          <div class="form-group">
	            <label for="wallet_amount" class="col-form-label">{{ __('Amount') }}:</label>
	            <input type="number" class="form-control" id="wallet_amount" required>
	          </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> {{ __('Close') }}</button>
	        <button type="submit" class="btn btn-primary"><i class="fab fa-paypal"></i> {{ __('Replenish') }}</button>
	      </div>
       </form>
    </div>
  </div>
</div>

<div class="modal fade" id="paypalb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content paypal-balence">
    	<div class="modal-header">
    		<input type="hidden" id="_token" value="{{ csrf_token() }}">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Pay With Paypal') }}</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	     <div class="modal-body text-center mt-5 mb-5">
	          <div id="paypal-button"></div>
	     </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="{{ asset('frontend/js/payment.js') }}"></script>
@endpush