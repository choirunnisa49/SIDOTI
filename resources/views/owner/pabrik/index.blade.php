@extends('layouts.app')

@section('content')
<div class="heading">
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <h3>Pabrik</h3>
        </div>
        <div class="col-sm-6 col-md-6">
            <nav class="navigation-heading" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">List Pabrik</li>
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
                <h5>List Pabrik</h5>
                <button type="button" class="btn btn-table" data-bs-toggle="modal" data-bs-target="#form-popup">Tambah Pabrik</button>
            </div>
            <div class="col-sm-6 heading-button">
                <a type="button" class="btn btn-table-phone" data-bs-toggle="modal" data-bs-target="#form-popup">Tambah Pabrik</a>
                <form action="#" class="search">
                    <span><i class="fa fa-search"></i></span>
                    <input type="text" class="search" id="search" onkeyup="doSearch()" placeholder="Cari bedasarkan nama...">
                </form>
                <div class="modal fade" id="form-popup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="form-popup-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="form-popup-label">Tambah Pabrik</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('owner.pabrik.buat') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="pabrik" class="col-form-label">Nama Pabrik</label>
                                        <input type="text" class="form-control" name="pabrik" id="pabrik" placeholder="contoh: Pabrik Yogyakarta" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="provinsi_id" class="col-form-label">Provinsi</label>
                                        <select name="province_id" id="province_id" class="form-select">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach ($provinsi  as $row)
                                            <option value="{{$row['province_id']}}" namaprovinsi="{{$row['province']}}">{{$row['province']}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="form-control" id="nama_provinsi" name="nama_provinsi" placeholder="ini untuk menangkap nama provinsi ">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kota_id" class="col-form-label">Kota</label>
                                        <select name="kota_id" id="kota_id" class="form-select">
                                            <option value="">Pilih Kota</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kecamatan" class="col-form-label">Kecamatan</label>
                                        <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="contoh: Depok" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kelurahan" class="col-form-label">Kelurahan</label>
                                        <input type="text" class="form-control" name="kelurahan" id="kelurahan" placeholder="contoh: Condongcatur" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="col-form-label">Alamat Pabrik</label>
                                        <textarea name="alamat" class="form-control" id="alamat" placeholder="contoh: Jl. Contoh No 00, Rt 00, Rw 00" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="map" class="col-form-label">Tandai di Map</label>
                                        <div id="googleMap" style="width:100%;height:380px;"></div>
                                        <p id="peringatanMap" style="color: red;"></p>
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" name="lng" id="lng" placeholder="contoh: -3.831721" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" class="form-control" name="lat" id="lat" placeholder="contoh: 102.812615" required>
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
                    <th scope="col">Nama Pabrik</th>
                    <th scope="col">Kode Pabrik</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                 @foreach ($pabrik as $item)
                    <tr>
                        <td scope="row">{{ $no++ }}</td>
                        <td>{{ $item->nama_pabrik }}</td>
                        <td>{{ $item->kode_pabrik }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->kecamatan }}</td>
                        <td>{{ $item->kelurahan }}</td>
                        <td>{{ $item->kota }}</td>
                        <td>{{ $item->provinsi }}</td>
                        <td>
                            <a href="{{ url('/owner/pabrik/lokasi/' . $item->kode_pabrik) }}" title="Lihat Pabrik">
                                <button class="btn btn-primary btn-sm">
                                    <i class="bx bx-map" aria-hidden="true"></i>
                                </button>
                            </a>
                            <a href="{{ url('/owner/pabrik/' .$item->kode_pabrik. '/edit') }}" title="Ubah Detail Pabrik">
                                <button class="btn btn-warning btn-sm">
                                    <i class="bx bx-pencil" aria-hidden="true"></i>
                                </button>
                            </a>
                            <a href="{{ url('/owner/pabrik/hapus/' . $item->kode_pabrik) }}" class="btn btn-danger btn-sm delete-confirm"><i class="bx bx-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('javascript')
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    
    <script>
        // variabel global marker
        var marker;
        var propertiPeta = {
            center:new google.maps.LatLng(-6.200000, 106.816666),
            zoom:5,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var x = document.getElementById("peringatanMap");
                
        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        function taruhMarker(peta, posisiTitik){
            if( marker ){
            // pindahkan marker
            marker.setPosition(posisiTitik);
            } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta
            });
            }        
            // isi nilai koordinat ke form
            document.getElementById("lat").value = posisiTitik.lat();
            document.getElementById("lng").value = posisiTitik.lng();
        }
        
        function initialize() {
            // even listner ketika peta diklik
            google.maps.event.addListener(peta, 'click', function(event) {
                taruhMarker(this, event.latLng);
            });
        }

        // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);

        function getLocation() {
            // even listner ketika peta diklik
            google.maps.event.addListener(peta, 'click', function(event) {
                showPosition(this, event.latLng);
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(peta, position) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                map: peta,
                animation: google.maps.Animation.BOUNCE
            });

            if(marker){
                // pindahkan marker
                marker.setPosition(position);
            } else {
                // buat marker baru
                marker = new google.maps.Marker({
                    position: position,
                    map: peta
                });
            }
            
            document.getElementById("lat").value = position.coords.latitude;
            document.getElementById("lng").value = position.coords.longitude;
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                x.innerHTML = "Anda menolak untuk memberikan posisi anda, silahkan tandai di google map secara manual"
                break;
                case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Informasi lokasi tidak tersedia, silahkan tandai di google map secara manual"
                break;
                case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
                case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
            }
        }

        google.maps.event.addDomListener(window, 'load', getLocation);
    </script>
    <script>
        $(document).ready(function(){
            //ini ketika provinsi tujuan di klik maka akan eksekusi perintah yg kita mau
            //name select nama nya "provinve_id" kalian bisa sesuaikan dengan form select kalian
            $('select[name="province_id"]').on('change', function(){
                // membuat variable namaprovinsiku untyk mendapatkan atribut nama provinsi
                var namaprovinsiku = $("#province_id option:selected").attr("namaprovinsi");
                // menampilkan hasil nama provinsi ke input id nama_provinsi
                $("#nama_provinsi").val(namaprovinsiku);
                // kita buat variable provincedid untk menampung data id select province
                let provinceid = $(this).val();
                //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
                if(provinceid){
                    // jika di temukan id nya kita buat eksekusi ajax GET
                    jQuery.ajax({
                        // url yg di root yang kita buat tadi
                        url:"/kota/"+provinceid,
                        // aksion GET, karena kita mau mengambil data
                        type:'GET',
                        // type data json
                        dataType:'json',
                        // jika data berhasil di dapat maka kita mau apain nih
                        success:function(data){
                            // jika tidak ada select dr provinsi maka select kota kososng / empty
                            $('select[name="kota_id"]').empty();
                            // jika ada kita looping dengan each
                            $.each(data, function(key, value){
                                // perhtikan dimana kita akan menampilkan data select nya, di sini saya memberi name select kota adalah kota_id
                                $('select[name="kota_id"]').append('<option value="'+ value.city_name +'" namakota="'+ value.type +' ' +value.city_name+ '">' + value.type + ' ' + value.city_name + '</option>');
                            });
                        }
                    });
                }else {
                    $('select[name="kota_id"]').empty();
                }
            });
        });
    </script>
    <script>
        $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Apakah anda yakin menghapus data pabrik ini?',
            text: 'Data yang sudah dihapus tidak akan dapat dikembalikan lagi!',
            type: 'warning',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            showCancelButton: true,
            reverseButtons: true
        }).then(function(result) {
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