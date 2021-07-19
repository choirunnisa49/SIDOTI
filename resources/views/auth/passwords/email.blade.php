@extends('layouts.app-auth')

@section('content')
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <a class="text-center" href="/">
                                <h4>{{ env('APP_NAME') }}</h4>
                            </a>
                            <h6 class="text-center">Lupa Kata Sandi</h6>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    Kami telah mengirimkan email yang berisi tautan reset kata sandi!
                                </div>
                            @endif

                            <form class="mt-5 mb-5 login-input" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button class="form-control btn btn-primary submit px-3">Kirim Link Reset Kata Sandi</button>
                            </form>
                            <p class="mt-5 text-right">Sudah ingat kata sandinya? <a href="/login" class="text-primary">Masuk</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection