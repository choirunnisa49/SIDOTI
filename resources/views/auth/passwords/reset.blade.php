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
                            <h6 class="text-center">Reset Kata Sandi</h6>

                            <form class="mt-5 mb-5 login-input" method="POST" action="{{ route('password.update') }}">
                                @csrf
        
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Email Anda">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus placeholder="Kata Sandi Baru">
                                    <i class="fa fa-eye icon-password" id="togglePassword"></i>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Kata Sandi">
                                    <i class="fa fa-eye icon-password" id="toggleRePassword"></i>
                                </div>
                                <button class="form-control btn btn-primary submit px-3">Reset Kata Sandi</button>
                            </form>
                            <p class="mt-5 text-right">Sudah ingat kata sandinya? <a href="/login" class="text-primary">Masuk</a></p>
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