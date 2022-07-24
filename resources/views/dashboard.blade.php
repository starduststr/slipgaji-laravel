@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body text-center">
                    SELAMAT DATANG <strong>{{ strtoupper(Auth::user()->name) }}</strong>
                    <p>Silahkan pilih salah satu menu untuk mengelola aplikasi!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
