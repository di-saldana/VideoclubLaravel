<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Movie;

class CatalogController extends BaseController {
    public function getIndex() {
        return view('catalog.index', ['arrayPeliculas' => Movie::all()]);
    }

    public function getShow($id) {
        return view('catalog.show', ['pelicula' => Movie::findOrFail($id)]);
    }

    public function getCreate() {
        return view('catalog.create');
    }

    public function getEdit($id) {
        return view('catalog.edit', ['id' => Movie::findOrFail($id)]);
    }
}
