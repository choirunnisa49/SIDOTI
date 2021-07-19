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
                    <li class="breadcrumb-item" aria-current="page">Produk</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
        Apabila anda tidak bisa mengklik apapun, silahkan <strong>halaman</strong> ini!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

<div class="table-data card">
    <div class="heading-table">
        <div class="row">
            <div class="col-sm-6">
                <h5>List Produk</h5>
                <a href="{{ route('owner.produk.buat') }}" class="btn btn-table btn-produk d-none d-sm-none d-md-block d-lg-block">Tambah Jenis</a>
            </div>
            <div class="col-sm-6 heading-button">
                <a href="{{ route('owner.produk.buat') }}" class="btn btn-table-phone">Tambah Jenis</a>
                <form action="#" class="search">
                    <span><i class="fa fa-search"></i></span>
                    <input type="text" class="search" id="search" onkeyup="doSearch()" placeholder="Cari bedasarkan nama...">
                </form>
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
                    <th scope="col">Nama Kategori Produk</th>
                    <th scope="col">Kode Kategori</th>
                    <th scope="col">Komposisi</th>
                    <th scope="col">Informasi Alergen</th>
                    <th scope="col">Saran Penyimpanan</th>
                    <th scope="col">Netto</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($kategori as $item)
                    <tr>
                        <td scope="row">{{ $no++ }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>{{ $item->kode_kategori }}</td>
                        <td>{{ $item->komposisi }}</td>
                        <td>{{ $item->informasi_alergen }}</td>
                        <td>{{ $item->saran_penyimpanan }}</td>
                        <td>{{ $item->netto }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>
                            <a href="{{ url('/owner/produk/' .$item->kode_kategori. '/edit') }}" title="Ubah Detail Pabrik">
                                <button class="btn btn-warning btn-sm">
                                    <i class="bx bx-pencil" aria-hidden="true"></i>
                                </button>
                            </a>
                            <a href="{{ url('/owner/produk/hapus/' . $item->kode_kategori) }}" class="btn btn-danger btn-sm delete-confirm"><i class="bx bx-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Apakah anda yakin menghapus produk ini?',
        text: 'Data yang sudah dihapus tidak akan dapat dikembalikan lagi!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    })
    .then(function(result) {
        if (result.value) {
            swal("Berhasil!", "Mohon tunggu hingga notifikasi ini hilang dengan sendirinya!", "success");
            window.location.href = url;
        } else {
            swal("Dibatalkan", "Data pabrik anda tidak jadi dihapus.", "error");
        }
    });
});
</script>
@endsection