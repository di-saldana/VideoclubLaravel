<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    @include('partials.navbar')
    <div class="container" style="padding:15px">
        @yield('content')
        @extends('layouts.master')

        <!-- @section('content') -->
        <div class="row">
          <div class="col-sm-3">
              <img src="{{$pelicula->poster}}" style="height:400px"/>
          </div>

          <div class="col-sm-8">
              <h2 style="min-height:45px;margin:5px 0 10px 0">
                  {{$pelicula->title}}
              </h2>
              <paragraph><b>Año:</b> {{$pelicula->year}}<br></paragraph>
              <paragraph><b>Director:</b> {{$pelicula->director}}<br><br></paragraph>
              <paragraph><b>Resumen:</b> {{$pelicula->synopsis}}<br><br></paragraph>

              @if($pelicula->rented)
                <paragraph><b>Estado:</b> Película actualmente alquilada<br><br></paragraph>
                <form action="{{action([App\Http\Controllers\CatalogController::class, 'putReturn'], ['id' => $pelicula->id])}}" 
                  method="POST" style="display:inline">
                  @method('PUT')
                  @csrf
                  <button type="submit" class="btn btn-danger" style="display:inline">
                      Devolver película
                  </button>
                </form>
              
              @else
                <paragraph><b>Estado:</b> Película disponible<br><br></paragraph>
                <form action="{{action([App\Http\Controllers\CatalogController::class, 'putRent'], ['id' => $pelicula->id])}}" 
                  method="POST" style="display:inline">
                  @method('PUT')
                  @csrf
                  <button type="submit" class="btn btn-primary" style="display:inline">
                    Alquilar película
                  </button>
                </form>

              @endif
              <a href="{{ url('/catalog/edit/' . $pelicula->id ) }}" type="button" class="btn btn-warning">
                <i class="bi bi-pencil"></i>Editar película
              </a>
              <form action="{{action([App\Http\Controllers\CatalogController::class, 'deleteMovie'], ['id' => $pelicula->id])}}" 
                  method="POST" style="display:inline">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-dark" style="display:inline">
                    <i class="bi bi-trash"></i>Eliminar película
                  </button>
                </form>

              <a href="{{ url('/catalog') }}" type="button" class="btn btn-light">
                <i class="fas fa-arrow-left"></i>Volver al listado
              </a>
          </div>
        </div>
        @endsection
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>