<!DOCTYPE html>
<html>
  <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Styles -->
<script src="{{asset('js/maps.js')}}" defer></script>
<link href="{{asset('css/maps.css')}}" rel="stylesheet">
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.0/mapbox-gl.css' rel='stylesheet' />
  </head>
  <body>
    <div>
        @yield('content')
    </div>
  </body>
<style>
      .mapboxgl-popup {
        max-width: 200px;
      }
      .mapboxgl-popup-content {
        text-align: center;
        font-family: 'Open Sans', sans-serif;
      }
</style>
@yield('script')
</html>