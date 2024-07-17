@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-center align-items-center mb-3">
            <i class="fas fa-plane-departure"></i>
            &nbsp;
            {{ __('Đăng nhập và khám phá') }}
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="d-flex justify-content-center mb-3">
                <div class="col-6">
                    <label for="email" class="col-md-8 col-form-label">{{ __('Email') }}</label>
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
                    <label for="password" class="col-md-8 col-form-label">{{ __('Mật khẩu') }}</label>
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
                            {{ __('Ghi nhớ') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn text-white col-6 btn-login">
                    {{ __('Đăng nhập') }}
                </button>
            </div>
            

        </form>
    </div>
</div>
@endsection
