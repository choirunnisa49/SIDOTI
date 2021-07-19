@extends('layouts.app')

@section('content')
<div class="heading">
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <h3><button class="btn-back" onclick="javascript: history.go(-1)"><i class="fa fa-arrow-left"></i></button> Lokasi {{ $pabrik[0]->nama_pabrik }}</h3>
        </div>
        <div class="col-sm-6 col-md-6">
            <nav class="navigation-heading" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/owner/pabrik">Pabrik</a></li>
                    <li class="breadcrumb-item" aria-current="page">Lokasi Pabrik</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="table-data card">
    <div id="body-table" class="table-responsive">
        <div id="map"></div>
    </div>
</div>
@endsection

@section('javascript')
<script>
	mapboxgl.accessToken = 'pk.eyJ1Ijoic2tpcHBlcmhvYSIsImEiOiJjazE2MjNqMjkxMTljM2luejl0aGRyOTAxIn0.Wyvywisw6bsheh7wJZcq3Q';
	var map = new mapboxgl.Map({
	  container: 'map',
	  style: 'mapbox://styles/mapbox/streets-v11',
	  center: [110.36960644602343, -7.795873173070459], //lng,lat 10.818746, 106.629179
	  zoom: 3
	});
	var test ='<?php echo $dataArray;?>';  //we get data from Controller
	var dataMap = JSON.parse(test); //convert it to the form required by Mapbox

	// We create loops for for out objects
	dataMap.features.forEach(function(marker) {

		//create a div tag with a class of market, to tweak the css for market
		var el = document.createElement('div');
		el.className = 'marker';

		//attach that marker at the coordinate position
		new mapboxgl.Marker(el)
			.setLngLat(marker.geometry.coordinates)
			.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
			.setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
			.addTo(map);
	});

</script>
@endsection