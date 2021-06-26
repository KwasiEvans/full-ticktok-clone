@extends('layouts.frontend.app')

@section('title','Login')

@section('content')


<!-- main area start -->
<section>
    <div class="login-area pt-200 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-section">
                        <div class="login-title">
                            <h3>{{ __('Log in') }}</h3>
                            <div class="login-form">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <h6>{{ __('Email or Username') }}</h6>
                                    <div class="login-form-gorup">
                                        <input type="text" id="email" class="login-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email or Username') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="login-form-gorup">
                                        <input type="password" id="password" class="login-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                    </div>
                                    <div class="login-form-group">
                                        <div class="custom-login-remember-forgotten">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                            @if (Route::has('password.request'))
                                            <a class="pjax f-right" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="login-form-button">
                                        <button type="submit">{{ __('Login') }}</button>
                                    </div>
                                    <div class="login-form-group not-registered text-center">
                                        <p>{{ __('Not registered?') }}<a class="pjax" href="{{ route('register') }}">{{ __('Create a account') }}</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- main area end -->
@endsection
