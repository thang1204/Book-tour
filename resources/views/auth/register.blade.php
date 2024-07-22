@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="d-flex justify-content-center mb-3">
                <div class="col-6">
                    <label for="name" class="col-md-8 col-form-label">{{ __('Tên') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-center mb-3">
                <div class="col-6">
                    <label for="email" class="col-md-8 col-form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <div class="col-6">
                    <label for="password-confirm" class="col-md-8 col-form-label">{{ __('Xác nhận mật khẩu') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn col-6 btn-login text-white">
                    {{ __('Đăng ký') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
