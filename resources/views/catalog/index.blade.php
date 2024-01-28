<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    @include('partials.navbar')
    <div class="container" style="padding:15px">
        @yield('content')
        @extends('layouts.master')

        <!-- @section('content') -->
        <div class="row">
          @foreach( $arrayPeliculas as $key => $pelicula )
          <div class="col-xs-6 col-sm-4 col-md-3 text-center">

              <a href="{{ url('/catalog/show/' . $key ) }}">
                  <img src="{{$pelicula['poster']}}" style="height:200px"/>
                  <h4 style="min-height:45px;margin:5px 0 10px 0">
                      {{$pelicula['title']}}
                  </h4>
              </a>
          </div>
          @endforeach
        </div>

        @endsection
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>