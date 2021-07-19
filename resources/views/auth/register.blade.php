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
                            <h6 class="text-center">Daftar</h6>

                            <form class="mt-5 mb-5 login-input" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="label" for="name">Nama</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama Lengkap">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="label" for="phone">No Telepon</label>
                                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="Nomer Telepon">
                                    <small>Contoh : +628xxxxxx</small>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="label" for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Anda">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="label" for="password">Kata Sandi</label>
                                    <input id="password" type="password" class="form-control password @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Kata Sandi">
                                    <i class="fa fa-eye icon-password" id="togglePassword"></i>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="label" for="password">Konfirmasi Kata Sandi</label>
                                    <input id="password-confirm" type="password" class="form-control password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi Kata Sandi">
                                    <i class="fa fa-eye icon-password" id="toggleRePassword"></i>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">Daftar</button>
                                </div>
                                <div class="w-50 text-md-right float-right">
                                    <a class="btn btn-link forgot-password" href="{{ route('password.request') }}">
                                        Sudah punya akun?
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    togglePassword.addEventListener('click', function (e) {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            this.classList.toggle('fa-eye-slash');
        } else {
            x.type = "password";
            this.classList.toggle('fa-eye-slash');
        }
    });

    toggleRePassword.addEventListener('click', function (e) {
        var x = document.getElementById("password-confirm");
        if (x.type === "password") {
            x.type = "text";
            this.classList.toggle('fa-eye-slash');
        } else {
            x.type = "password";
            this.classList.toggle('fa-eye-slash');
        }
    });
</script>
@endsection