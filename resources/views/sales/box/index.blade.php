@extends('layouts.app')

@section('content')
<div class="heading">
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <h3>Box Produk</h3>
        </div>
        <div class="col-sm-6 col-md-6">
            <nav class="navigation-heading" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Box Produk</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="table-data card">
    <div class="heading-table">
        <div class="row">
            <div class="col-sm-6">
                <h5>List Box Produk</h5>
                <a href="{{ route('owner.produk.buat') }}" class="btn btn-table btn-produk d-none d-sm-none d-md-block d-lg-block" style="margin-left: 150px;" data-bs-toggle="modal" data-bs-target="#form-popup" onclick="turnOnCam()">Scan QR</a>
            </div>
            <div class="col-sm-6 heading-button">
                <a href="{{ route('owner.produk.buat') }}" class="btn btn-table-phone" data-bs-toggle="modal" data-bs-target="#form-popup">Scan QR</a>
                <div class="modal fade" id="form-popup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="form-popup-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="form-popup-label">Cari QR Box</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="turnOffCam()"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3 row">
                                    <div class="col-12">
                                        <video id="preview" style="width: 100%;"></video>
                                    </div>
                                    <div class="col-6">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label class="btn btn-secondary" style="float: right;">
                                            <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="#" class="search">
                    <span><i class="fa fa-search"></i></span>
                    <input type="text" class="search" id="search" onkeyup="doSearch()" placeholder="Cari bedasarkan kode">
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
                    <th scope="col">Kode Box</th>
                    <th scope="col">Jenis Produk</th>
                    <th scope="col">Isi</th>
                    <th scope="col">Max</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($box as $item)
                    <tr>
                        <td scope="row">{{ $no++ }}</td>
                        <td>
                            @php
                                echo DNS2D::getBarcodeSVG($item->kode_box, 'QRCODE');
                            @endphp
                            {{ $item->kode_box }}
                        </td>
                        <td>{{ $item->kategori_id }}</td>
                        <td>{{ $item->isi }}</td>
                        <td>{{ $item->max }}</td>
                        <td>{{ $item->status }}</td>
                        @if ($item->status == "gudang" || $item->status == "dijual")
                        <td>
                            <a href="{{ url('/sales/box/' .$item->kode_box. '/edit') }}" title="Ubah status produk">
                                <button class="btn btn-warning btn-sm">
                                    <i class="bx bx-pencil" aria-hidden="true"></i>
                                </button>
                            </a>
                        </td>
                        @else
                        <td>
                            <a href="#" title="Ubah status produk" disabled>
                                <button class="btn btn-warning btn-sm" disabled>
                                    <i class="bx bx-pencil" aria-hidden="true"></i>
                                </button>
                            </a>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('javascript')
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">
        var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
        function turnOnCam() {
            scanner.addListener('scan',function(content){
                // alert(content);
                window.location.href=content + "/edit";
                scanner.stop();
            });
            Instascan.Camera.getCameras().then(function (cameras){
                if(cameras.length>0){
                    scanner.start(cameras[0]);
                    $('[name="options"]').on('change',function(){
                        if($(this).val()==1){
                            if(cameras[0]!=""){
                                scanner.start(cameras[0]);
                            }else{
                                alert('No Front camera found!');
                            }
                        }else if($(this).val()==2){
                            if(cameras[1]!=""){
                                scanner.start(cameras[1]);
                            }else{
                                alert('No Back camera found!');
                            }
                        }
                    });
                }else{
                    console.error('No cameras found.');
                    alert('No cameras found.');
                }
            }).catch(function(e){
                console.error(e);
                alert(e);
            });
        }
        function turnOffCam() {
            scanner.stop();
        }
    </script>
@endsection