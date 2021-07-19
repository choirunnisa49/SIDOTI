@extends('layouts.app-auth')

@section('content')
<div class="container">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html"> <h4>{{ env('APP_NAME') }}</h4></a>
                                <h6 class="text-center">Verifikasi Email Kamu</h6>
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        Tautan baru telah dikirim ke alamat email kamu.
                                    </div>
                                @endif

                                <p>Sebelum melanjutkan, silahkan lihat email kamu untuk verifikasi akun anda.
                                    Jika kamu belum mendapatkan email,</p>
                                <form class="mt-5 mb-3 login-input"  method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button class="form-control btn btn-primary submit px-3">Kirim ulang tautan verifikasi</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
