@extends('layouts.backend.app')

@section('title','Edit Language')

@push('css')

@endpush

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>{{ __('Manage & Edit Languages') }}</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
				<div class="breadcrumb-item">{{ __('Manage & Edit Languages') }}</div>
			</div>
		</div>

		<div class="section-body">
			<h2 class="section-title">{{ __('Manage & Edit Languages') }}</h2>
			<p class="section-lead">{{ __('Manage & Edit Languages section') }}</p>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>{{ __('Manage & Edit Languages') }}</h4>
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
								<table class="table table-striped" id="table_id">
									<thead>
										<tr>
											<th>{{ __('Id') }}</th>
											<th>{{ __('Key Name') }}</th>
											<th>{{ __('Value') }}</th>
											<th>{{ __('Action') }}</th>
										</tr>
									</thead>
									@php 
									$a = 1;
									@endphp
									<tbody>
										@foreach($language_values as $key=>$lang)
										<tr>
											<td>{{ $a++ }}</td>
											<td>{{ $key }}</td>
											<td>{{ $lang }}</td>
											<td>
												<a href="#" data-toggle="modal" data-target="#lang_value{{ Str::slug($key) }}" class="btn btn-primary">{{ __('Edit') }}</a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


@foreach($language_values as $key=>$lang)
<div class="modal fade mymodel" id="lang_value{{ Str::slug($key) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit Value') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.language.update',$id) }}" method="POST" class="edit_lang">
      	@csrf
	      <div class="modal-body">
		      <div class="form-group">
		        <label for="message-text" class="col-form-label">{{ __('Value') }}:</label>
		        <input type="hidden" name="key" value="{{ $key }}">
		        <textarea class="form-control" id="message-text" name="value">{{ $lang }}</textarea>
		      </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
	        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
	      </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endsection

@push('js')

@endpush