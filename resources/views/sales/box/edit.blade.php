@extends('layouts.app')

@section('content')
<div class="heading">
    <div class="row">
        <div class="col-sm-6">
            <h3>Ubah Data Box</h3>
        </div>
        <div class="col-sm-6">
            <nav class="navigation-heading" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/produksi/box">Box</a></li>
                    <li class="breadcrumb-item" aria-current="page">Ubah</li>
                </ol>
            </nav>
        </div>
        <div class="col-sm-12">
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-row card">
            <div class="heading-form">
                <div class="row">
                    <div class="col">
                        <h5>Kode Box : {{ $boxnya[0]->kode_box }}</h5>
                    </div>
                </div>
            </div>
            <div id="body-form">
                <form class="row g-3 needs-validation" action="{{ route('sales.box.ubah.proses') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode" id="kode" value="{{ $boxnya[0]->kode_box }}">
                    <div class="col-md-6">
                        <label for="produk" class="form-label">Kategori</label>
                        <input type="text" class="form-control" name="kategori" required placeholder="Masukkan Nama Kategori" readonly value="{{ $boxnya[0]->nama_kategori }}">
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <br>
                        <select name="status" id="status" class="form-select">
                            <option value="{{ $boxnya[0]->status }}" style="text-transform: capitalize;">{{ $boxnya[0]->status }}</option>
                            <option value="">---- Pilih Salah Satu ----</option>
                            <option value="gudang">Gudang</option>
                            <option value="dijual">Dijual</option>
                            <option value="terjual">Terjual</option>
                            <option value="dikembalikan">Dikembalikan</option>
                        </select>
                    </div>
                    @if ($boxnya[0]->status == 'dijual' || $boxnya[0]->status == 'terjual')
                        <div class="col-md-12" id="form-toko">
                            <label for="toko" class="form-label">Tempat penjualan</label>
                            <select name="toko" id="toko" class="form-select">
                                <option value="{{ $boxnya[0]->id }}" namatoko="{{ $boxnya[0]->id }}">
                                    {{ App\Http\Controllers\Produksi\BoxController::cariToko($boxnya[0]->id) }}
                                </option>
                                <option value="">---- Pilih Salah Satu ----</option>
                                @foreach ($toko as $tokonya)
                                    <option value="{{ $tokonya->id }}" namatoko="{{ $tokonya->nama_toko }}">{{ $tokonya->nama_toko }}</option>                                
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="col-md-12" id="form-toko" style="display: none">
                            <label for="toko" class="form-label">Tempat penjualan</label>
                            <select name="toko" id="toko" class="form-select">
                                <option value="" namatoko="">Pilih Salah Satu</option>                                
                                @foreach ($toko as $tokonya)
                                    <option value="{{ $tokonya->id }}" namatoko="{{ $tokonya->nama_toko }}">{{ $tokonya->nama_toko }}</option>                                
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col">
                        <a href="javascript: history.go(-1)" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary btn-submit" type="submit"><i class="bx bx-paper-plane"></i> Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            //name select nama nya "toko_id" kalian bisa sesuaikan dengan form select kalian
            $('select[name="status"]').on('change', function(){
                // membuat variable namatoko untyk mendapatkan atribut nama toko
                var statusnya = $("#status option:selected").attr("value");
                // menampilkan hasil nama provinsi ke input id nama_provinsi
                // document.getElementById("pilihan").innerHTML = statusnya;
                if(statusnya == 'dijual' || statusnya == 'terjual' || statusnya == 'dikembalikan') {
                    document.getElementById('form-toko').style.display = 'block';
                } else {
                    document.getElementById('form-toko').style.display = 'none';
                }
            });
        });
    </script>
@endsection