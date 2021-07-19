@extends('layouts.app')

@section('content')
<div class="heading">
    <div class="row">
        <div class="col-sm-6">
            <h3>{{ $pabrik[0]->nama_pabrik }}</h3>
        </div>
        <div class="col-sm-6">
            <nav class="navigation-heading" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/warehouse/kategori">Pabrik</a></li>
                    <li class="breadcrumb-item" aria-current="page">Ubah Data</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-row card">
            <div class="heading-form">
                <div class="row">
                    <div class="col">
                        <h5>Ubah data</h5>
                    </div>
                    <div class="col-lg-12">
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
            <div id="body-form">
                <form class="row g-3 needs-validation" action="{{ route('owner.pabrik.edit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $pabrik[0]->kode_pabrik }}">
                    <div class="col-md-4">
                        <label for="pabrik" class="form-label">Nama Pabrik</label>
                        <input type="text" class="form-control" name="pabrik" id="pabrik" placeholder="contoh: Pabrik Yogyakarta" value="{{ $pabrik[0]->nama_pabrik }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="lat" class="form-label">Latitude Coordinate (lat)</label>
                        <input type="text" class="form-control" name="lat" id="lat" value="{{ $pabrik[0]->lat }}" placeholder="contoh: 102.812615" required>
                        <small style="font-size: 12px; color: red;">Petunjuk pengisian <a href="https://support.google.com/maps/answer/18539?co=GENIE.Platform%3DAndroid&hl=en">Klik Disini</a></small>
                    </div>
                    <div class="col-md-4">
                        <label for="lng" class="form-label">Longtitude Coordinate (lng)</label>
                        <input type="text" class="form-control" name="lng" id="lng" value="{{ $pabrik[0]->lng }}" placeholder="contoh: -3.831721" required>
                        <small style="font-size: 12px; color: red;">Petunjuk pengisian <a href="https://support.google.com/maps/answer/18539?co=GENIE.Platform%3DAndroid&hl=en">Klik Disini</a></small>
                    </div>
                    <div class="col-md-3">
                        <label for="provinsi_id" class="form-label">Provinsi</label>
                        <select name="province_id" id="province_id" class="form-control">
                            <option value="{{ $pabrik[0]->provinsi }}">{{ $pabrik[0]->provinsi }} (Default)</option>
                                @foreach ($provinsi  as $row)
                                    <option value="{{$row['province_id']}}" namaprovinsi="{{$row['province']}}">{{$row['province']}}</option>
                                @endforeach
                        </select>
                        <input type="hidden" class="form-control" id="nama_provinsi" name="nama_provinsi" value="{{ $pabrik[0]->provinsi }}" placeholder="ini untuk menangkap nama provinsi">
                        <small style="font-size: 12px; color: red;">Silahkan pilih selain default</small>
                    </div>
                    <div class="col-md-3">
                        <label for="kota_id" class="form-label">Kabupaten / Kota</label>
                        <select name="kota_id" id="kota_id" class="form-control">
                            <option value="{{ $pabrik[0]->kota }}">{{ $pabrik[0]->kota }} (Default)</option>
                        </select>
                        <small style="font-size: 12px; color: red;">Silahkan pilih provinsi selain default terlebih dahulu sebelum mengubah kabupaten / kota</small>
                    </div>
                    <div class="col-md-3">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" id="kecamatan" value="{{ $pabrik[0]->kecamatan }}" placeholder="contoh: Depok" required>
                    </div>
                    <div class="col-md-3">
                        <label for="kelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" name="kelurahan" id="kelurahan" value="{{ $pabrik[0]->kelurahan }}" placeholder="contoh: Condongcatur" required>
                    </div>
                    <div class="col-md-12">
                        <label for="alamat" class="col-form-label">Alamat Pabrik</label>
                        <textarea name="alamat" class="form-control" id="alamat" placeholder="contoh: Jl. Contoh No 00, Rt 00, Rw 00" required>{{ $pabrik[0]->alamat }}</textarea>
                    </div>
                    <div class="col">
                        <a href="javascript: history.go(-1)" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary btn-submit" type="submit"><i class="bx bx-paper-plane"></i> Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
