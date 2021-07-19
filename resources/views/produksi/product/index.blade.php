@extends('layouts.app')

@section('content')
<div class="heading">
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <h3>Produk</h3>
        </div>
        <div class="col-sm-6 col-md-6">
            <nav class="navigation-heading" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">List Produk</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="table-data card">
    <div class="heading-table">
        <div class="row">
            <div class="col-sm-6">
                <h5>List Produk</h5>
                <button type="button" class="btn btn-table" data-bs-toggle="modal" data-bs-target="#form-popup" style="margin-left: 200px;">Buat Produk</button>
            </div>
            <div class="col-sm-6 heading-button">
                <a type="button" class="btn btn-table-phone" data-bs-toggle="modal" data-bs-target="#form-popup">Buat Produk</a>
                <form action="#" class="search">
                    <span><i class="fa fa-search"></i></span>
                    <input type="text" class="search" id="search" onkeyup="doSearch()" placeholder="Cari kode produk...">
                </form>
                <div class="modal fade" id="form-popup" tabindex="-1" aria-labelledby="form-popup-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="form-popup-label">Tambah Pabrik</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('produksi.produk.buat') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="pabrik" class="col-form-label">Lokasi Pabrik</label>
                                        <select name="pabrik" id="pabrik" class="form-control">
                                            @foreach ($pabrik as $pabrik)
                                                <option value="{{ $pabrik->id }}">{{ $pabrik->nama_pabrik }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori" class="col-form-label">Jenis Produk</label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            @foreach ($kategori as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah" class="col-form-label">Jumlah Produksi</label>
                                        <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="contoh: 1" min="1" required>
                                    </div>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                    <button type="sumbit" class="btn btn-primary" style="float: right;">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 search-phone">
                <form action="#" class="search">
                    <span><i class="fa fa-search"></i></span>
                    <input type="text" class="search" id="search" onkeyup="doSearch()" placeholder="Cari bedasarkan nama...">
                </form>
            </div>
            <div class="col-12">
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
    <div id="body-table" class="table-responsive">
        <table class="table table-striped table-bordered zero-configuration" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kategori Id</th>
                    <th scope="col">Kode Produk</th>
                    <th scope="col">Box id</th>
                    <th scope="col">Status</th>
                    <th scope="col">Toko Id</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($product as $item)
                    <tr>
                        <td scope="row">{{ $no++ }}</td>
                        <td>{{ $item->kategori_id }}</td>
                        <td>
                            @php
                                echo DNS1D::getBarcodeHTML($item->kode_produksi, 'EAN13');
                            @endphp
                            {{ $item->kode_produksi }}
                        </td>
                        <td>{{ $item->box_id }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->toko_id }}</td>
                        <td>
                            <a href="{{ url('/owner/produk/' .Crypt::encryptString($item->id). '/edit') }}" title="Ubah Detail Pabrik">
                                <button class="btn btn-warning btn-sm">
                                    <i class="bx bx-pencil" aria-hidden="true"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection