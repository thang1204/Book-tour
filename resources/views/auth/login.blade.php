@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-center align-items-center mb-3">
            <i class="fas fa-plane-departure"></i>
            &nbsp;
            {{ __('Log in and get exploring') }}
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="d-flex justify-content-center mb-3">
                <div class="col-6">
                    <label for="email" class="col-md-8 col-form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-center mb-3">
                <div class="col-6">
                    <label for="password" class="col-md-8 col-form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3 d-flex justify-content-center">
                <div class="col-6 ">
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn text-white col-6 btn-login">
                    {{ __('Login') }}
                </button>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <div class="col-6 d-flex justify-content-center">
                    <hr class="hr-line">
                    <div class="px-2" style="min-width: fit-content;">
                        or continue with
                    </div>
                    <hr class="hr-line">
                </div>
            </div>
            
            {{-- <div class="d-flex justify-content-center">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div> --}}

            <div class="d-flex justify-content-center mt-3">
                <div class="d-flex justify-content-center justify-content-evenly col-6">
                    <button class="btn-icon d-flex justify-content-center align-items-center">
                        <i class="fab fa-google-plus-g fs-24" style="color: #EA4335"></i>
                    </button>
                    <button class="btn-icon d-flex justify-content-center align-items-center">
                        <i class="fa-brands fa-square-facebook fs-24" style="color: #0866FF"></i>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
