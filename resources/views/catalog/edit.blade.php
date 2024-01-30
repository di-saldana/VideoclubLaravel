<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    @include('partials.navbar')
    <div class="container" style="padding:15px">
        @yield('content')
        @extends('layouts.master')

        <!-- @section('content') -->
        <div class="row" style="margin-top:40px">
          <div class="offset-md-3 col-md-6">
              <div class="card">
                <div class="card-header text-center">
                Modificar película
                </div>
                <div class="card-body" style="padding:30px">
                  <form method="POST" action="{{ action([App\Http\Controllers\CatalogController::class, 'putEdit'], ['id' => $pelicula->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                      <label for="title">Título</label>
                      <input type="text" name="title" id="title" class="form-control" value="{{$pelicula->title}}">
                    </div>

                    <div class="form-group">
                      <label for="year">Año</label>
                      <input type="text" name="year" id="year" class="form-control" value="{{$pelicula->year}}">
                    </div>

                    <div class="form-group">
                      <label for="director">Director</label>
                      <input type="text" name="director" id="director" class="form-control" value="{{$pelicula->director}}">
                    </div>

                    <div class="form-group">
                      <label for="poster">Poster</label>
                      <input type="file" name="poster" id="poster" class="form-control" value="{{$pelicula->poster}}" accept="image/png, image/jpeg">
                    </div>

                    <div class="form-group">
                      <label for="synopsis">Resumen</label>
                      <textarea type="textarea" name="synopsis" id="synopsis" class="form-control" rows="3" value="{{$pelicula->synopsis}}"></textarea>
                    </div>

                    <div class="form-group text-center">
                      <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                          Modificar película
                      </button>
                    </div>

                  </form>
                </div>
              </div>
          </div>
        </div>
        @endsection
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>