@extends('layouts.frontend.app')

@section('title','Register')

@section('content')
<!-- main area start -->
<section>
    <div class="login-area pt-150 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @php 
                    $user_register = App\Option::where('key','user_value')->first();
                    $user_data = json_decode($user_register->value);
                    @endphp
                    @if($user_data->user_registation == 'enabled')
                    <div class="login-section">
                        <div class="login-title">
                            <h3>{{ __('Sign up') }}</h3>
                            <div class="login-form">
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <h6>{{ __('First & Last Name') }}</h6>
                                    <div class="login-birthday-display d-flex">
                                        <div class="login-form-gorup first-name">
                                            <input type="text" id="first_name" class="login-form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="{{ __('First Name') }}">
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="login-form-gorup last-name">
                                            <input type="text" id="last_name" class="login-form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="{{ __('Last Name') }}">
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <h6>{{ __('Username') }}</h6>
                                    <div class="login-form-gorup">
                                        <input type="text" id="username" class="login-form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="{{ __('Username') }}">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <h6>{{ __('Email') }}</h6>
                                    <div class="login-form-gorup">
                                        <input type="email" id="email" class="login-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="login-form-gorup">
                                        <input type="password" id="password" class="login-form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus placeholder="{{ __('Password') }}">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="login-form-gorup">
                                        <input type="password" id="password" class="login-form-control" placeholder="{{ __('Confirm Password') }}" name="password_confirmation">
                                    </div>
                                    <div class="login-form-button">
                                        <button type="submit">{{ __('Sign up') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="login-section mt-100">
                        <div class="login-title text-center">
                            <div class="comming-soon">
                                <p>{{ __('This feature is now disabled for some technical issue. We will back right time.') }}</p>
                            </div>
                        </div> 
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- main area end -->
@endsection
