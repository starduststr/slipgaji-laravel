@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mb-4">
                <h3 class="text-center mt-2"><strong>LOGIN</strong></h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <img class="mt-4 position-relative start-50 translate-middle" src="{{ asset('img/logorobonesia.png') }}" style="width: 200px; height: 50px;">
                    <form method="POST" action="{{ route('login') }}" class="form-group">
                        @csrf

                        <div class="">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Ingat Saya') }}
                                </label>
                            </div>

                            <button type="submit" class="mt-2 btn btn-primary position-relative start-50 translate-middle">
                                {{ __('Masuk') }}
                            </button>
                            
                            @if (Route::has('password.request'))
                            <a class="mt-2 btn btn-link position-relative start-50" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                            @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection