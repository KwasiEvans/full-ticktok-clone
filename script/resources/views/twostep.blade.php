@extends('layouts.frontend.app')

@section('title','Two Factor')

@section('content')
<div class="main-content pt-200 pb-50">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 offset-lg-4">
				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				@if(Session::has('message'))
				<p class="alert alert-danger">{{ Session::get('message') }}</p>
				@endif
				<div class="verification-form text-center">
					<div class="verification-title">
						<h3>{{ __('Two-factor authentication') }}</h3>
					</div>
					<div class="verification-header">
						<p>{{ __('Please enter the 4-digit verification code we sent via Email:') }}</p>
					</div>
					<form action="{{ route('two.step.verify') }}" method="POST">
						@csrf
						<div class="form-group">
							<input type="text" class="form-control" name="two_factor">
						</div>
						<button type="submit">{{ __('Verify') }}</button>
					</form>
					<div class="verification-footer">
						<p>{{ __("Didn't receive the code?") }}</p>
						<a href="{{ route('two.step.notify') }}">{{ __('Send code again') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection