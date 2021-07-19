@extends('layouts.app')

@section('content')
<div class="heading">
    <div class="row">
        <div class="col-sm-6">
            <h3>Dashboard</h3>
        </div>
        <div class="col-sm-6">
            <nav class="navigation-heading" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xl-3 col-lg-6">
        <div class="card l-bg-cherry">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                <div class="mb-4">
                    <h5 class="card-title mb-0">Produk Terjual</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            <span class="count">{{ App\Http\Controllers\HomeController::produk('terjual') }}</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card l-bg-blue-dark">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                <div class="mb-4">
                    <h5 class="card-title mb-0">Jumlah Pegawai</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            <span class="count">{{ count($user)-1 }}</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card l-bg-green-dark">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-heart"></i></div>
                <div class="mb-4">
                    <h5 class="card-title mb-0">Jumlah Pelanggan</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            <span class="count">{{ count($toko) }}</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card l-bg-orange-dark">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                <div class="mb-4">
                    <h5 class="card-title mb-0">Total Keuntungan</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            Rp
                            <span>
                                @php
                                    $a = 0;
                                @endphp
                                @if (count($keuntungan) > 0)
                                    @foreach ($keuntungan as $benefits)
                                        @php
                                            $a = $a + $benefits->keuntungan;
                                        @endphp
                                    @endforeach
                                    {{ $a }}
                                @else
                                    {{ $a }}
                                @endif
                            </span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="table-data table-responsive card col-6">
        <div class="heading-table">
            <div class="row">
                <div class="col">
                    <h5>Data tabel</h5>
                </div>
                <div class="col">
                    <button class="btn-hide"><i class="fa fa-minus" onclick="iconTable(this)"></i></button>
                </div>
            </div>
        </div>
        <div id="body-table" class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-row card">
            <div class="heading-form">
                <div class="row">
                    <div class="col">
                        <h5>Form</h5>
                    </div>
                    <div class="col">
                        <button class="btn-hide"><i class="fa fa-minus" onclick="iconForm(this)"></i></button>
                    </div>
                </div>
            </div>
            <div id="body-form">
                <form class="row g-3 needs-validation" novalidate>
                    <div class="col-md-2">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">City</label>
                        <input type="text" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">State</label>
                        <select class="form-select" id="validationCustom04" required>
                    <option selected disabled value="">Choose...</option>
                    <option>...</option>
                  </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="validationCustom05" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                      Agree to terms and conditions
                    </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-7 chart-row card">
        <div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="col-sm-4 chart-row card" style="margin-left: 10px; height: 300px;">
        <div class="heading">
            <div class="row">
                <div class="col">
                    <h5>Grafik Keseluruhan Produk</h5>
                </div>
            </div>
        </div>
        <div>
            <div id="pieChart"></div>
        </div>
    </div>
    <div class="col-sm-7 chart-row card">
        <div class="heading">
            <div class="row">
                <div class="col">
                    <h5>Grafik Produksi Setiap Pabrik</h5>
                </div>
            </div>
        </div>
        <div>
            <div id="barChart"></div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    @php
        $year = date("Y");
    @endphp
    <script type="text/javascript">
        const labels = [
            'Januari',
            'Febuari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Penjualan tahun {{ $year }}',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [{{ App\Http\Controllers\HomeController::penjualan($year, '01') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '02') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '03') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '04') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '05') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '06') }}, 
                {{ App\Http\Controllers\HomeController::penjualan($year, '07') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '08') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '09') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '10') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '07') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '08') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '11') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '12') }}],
            }]
        };

        const config = {
            type: 'line',
            data,
            options: {}
        };
        // === include 'setup' then 'config' above ===

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <script type="text/javascript">
        var options = {
            series: [{{ App\Http\Controllers\HomeController::produk('gudang') }}, {{ App\Http\Controllers\HomeController::produk('dijual') }}, {{ App\Http\Controllers\HomeController::produk('terjual') }}, {{ App\Http\Controllers\HomeController::produk('dikembalikan') }}],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Di Gudang', 'di Toko', 'Terjual', 'Dikembalikan'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pieChart = new ApexCharts(document.querySelector("#pieChart"), options);
        pieChart.render();
    </script>
    <script type="text/javascript">
        var options = {
            series: [
                @php
                    $jumlahProduct = count($kategori);
                    $jumlahPabrik = count($pabrik);
                @endphp
                @for ($a = 0; $a < $jumlahProduct; $a++)
                    @if ($a+1 == $jumlahProduct)
                    {
                        name: '{{ $kategori[$a]->nama_kategori }}',
                        data: [
                            @for ($b = 0;$b < $jumlahPabrik; $b++)
                                {{ App\Http\Controllers\HomeController::hitungProdukPabrik(($b+1), $kategori[$a]->id) }},
                            @endfor
                        ]
                    }
                    @else
                    {
                        name: '{{ $kategori[$a]->nama_kategori }}',
                        data: [
                            @for ($b = 0;$b < $jumlahPabrik; $b++)
                                {{ App\Http\Controllers\HomeController::hitungProdukPabrik($b+1, $kategori[$a]->id) }},
                            @endfor
                        ]
                    },
                    @endif
                @endfor
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: [
                    @for ($namaPabrik = 0; $namaPabrik < $jumlahPabrik; $namaPabrik++)
                        '{{ $pabrik[$namaPabrik]->nama_pabrik }}',
                    @endfor
                ],
            },
            yaxis: {
                title: {
                    text: 'Produk'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return ": " + val + " Produk"
                    }
                }
            }
        };

        var barChart = new ApexCharts(document.querySelector("#barChart"), options);
        barChart.render();
    </script>
@endsection