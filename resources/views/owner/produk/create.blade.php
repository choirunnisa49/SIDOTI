@extends('layouts.app')

@section('content')
<div class="heading">
    <div class="row">
        <div class="col-sm-6">
            <h3>Produk</h3>
        </div>
        <div class="col-sm-6">
            <nav class="navigation-heading" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/owner/produk">Produk</a></li>
                    <li class="breadcrumb-item" aria-current="page">Tambah</li>
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
                        <h5>Tambah Produk</h5>
                    </div>
                </div>
            </div>
            <div id="body-form">
                <form class="row g-3 needs-validation" action="{{ route('owner.produk.buat.post') }}" method="POST">
                    @csrf
                    <div class="col-md-3">
                        <label for="produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="produk" required placeholder="Masukkan Nama Kategori" autocomplete="off">
                    </div>
                    {{-- <div class="col-md-3">
                        <label for="pabrik" class="form-label">Tempat Produksi</label>
                        <select name="pabrik" id="pabrik" class="form-control" required>
                            <option value="">Pilih Salah Satu Pabrik</option>
                            @foreach ($pabrik as $pabrik)
                                <option value="{{ $pabrik->id }}" kodenya="{{ $pabrik->kode_pabrik }}">{{ $pabrik->nama_pabrik }}</option>                                
                            @endforeach
                        </select>
                        <input type="text" name="kode_pabriknya" id="kode_pabriknya">
                    </div> --}}
                    <div class="col-md-3">
                        <label for="netto" class="form-label">Berat Bersih</label>
                        <div class="input-group has-validation">
                            <input type="number" class="form-control" name="netto" aria-describedby="inputNetto" required placeholder="contoh: 46" min="1">
                            <span class="input-group-text" id="inputNetto">gram</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="harga" class="form-label">Harga Produk</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputHarga">Rp</span>
                            <input type="number" class="form-control" id="harga" name="harga" aria-describedby="inputHarga" required placeholder="contoh: 10000" min="1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="keuntungan" class="form-label">Keuntungan Produk</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputKeuntungan">Rp</span>
                            <input type="number" class="form-control" id="keuntungan" name="keuntungan" aria-describedby="inputKeuntungan" required placeholder="contoh: 10000" min="1">
                            <span class="input-group-text" id="inputKeuntungan">/ produk</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="komposisi" class="form-label">Komposisi</label><br>
                        <textarea name="komposisi" class="form-control textarea-form" required placeholder="Masukkan Komposisinya"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="alergen" class="form-label">Informasi Alergen</label><br>
                        <textarea name="alergen" class="form-control textarea-form" required placeholder="Masukkan Informasi Alergennya"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="saran" class="form-label">Saran Penyimpanan</label><br>
                        <textarea name="saran" class="form-control textarea-form" required placeholder="Masukkan Saran Penyimpnannya"></textarea>
                    </div>
                    <div class="col">
                        <a href="javascript: history.go(-1)" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary btn-submit" type="submit"><i class="bx bx-paper-plane"></i> Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        //ini ketika provinsi tujuan di klik maka akan eksekusi perintah yg kita mau
        //name select nama nya "pabrik" kalian bisa sesuaikan dengan form select kalian
        $('select[name="pabrik"]').on('change', function(){
            // membuat variable namaprovinsiku untyk mendapatkan atribut nama provinsi
            var kode = $("#pabrik option:selected").attr("kodenya");
            // menampilkan hasil nama provinsi ke input id nama_provinsi
            $("#kode_pabriknya").val(kode);
        });
    });
</script>
@endsection
