@extends('layouts.frontend.app')

@section('content')
<div class="login-area pt-150 pb-100">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="login-section mt-100">
					<div class="login-title text-center">
						<div class="comming-soon">
							<p>{{ __("Your account is now pending approval. This process usually takes less than 24 hours, but may take several days.") }}</p>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>
@endsection