<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Movie;
use Bpocallaghan\Alert\Facades\Alert;

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

    public function postCreate(Request $request) {
        $pelicula = new Movie();

        $pelicula->title = $request->input('title');
        $pelicula->year = $request->input('year');
        $pelicula->director = $request->input('director');

        // TODO: CHECK
        if ($request->hasFile('poster') && $request->file('poster')->isValid()) {
            $posterPath = $request->file('poster')->store('');
            $pelicula->poster = $posterPath;

            // $request->file('photo')->store($destinationPath);  
            // $request->file('photo')->storeAs($destinationPath, $fileName);
        }
        
        $pelicula->rented = $request->input('rented', false); 
        $pelicula->synopsis = $request->input('synopsis');

        $pelicula->save();

        Alert::success('Película Guardada', 'La película se ha guardado correctamente.');

        return redirect('/catalog');
    }

    public function getEdit($id) {
        return view('catalog.edit', ['pelicula' => Movie::findOrFail($id)]);
    }

    public function putEdit(Request $request, $id) {
        $pelicula = Movie::findOrFail($id);

        $pelicula->title = $request->input('title');
        $pelicula->year = $request->input('year');
        $pelicula->director = $request->input('director');

        // TODO: CHECK
        if ($request->hasFile('poster') && $request->file('poster')->isValid()) {
            $posterPath = $request->file('poster')->store('');
            $pelicula->poster = $posterPath;

            // $request->file('photo')->store($destinationPath);  
            // $request->file('photo')->storeAs($destinationPath, $fileName);
        }

        $pelicula->synopsis = $request->input('synopsis');

        $pelicula->save();

        Alert::success('Película Modificada', 'La película se ha modificado correctamente.');

        return redirect('/catalog/show/'.$id);
    }

    public function putRent($id) {
        $pelicula = Movie::findOrFail($id);
        $pelicula->rented = true;
        $pelicula->save();

        Alert::success('Película Rentada', 'La película se ha rentado correctamente.');

        return redirect('/catalog/show/'.$id);
    }

    public function putReturn($id) {
        $pelicula = Movie::findOrFail($id);
        $pelicula->rented = false;
        $pelicula->save();

        Alert::success('Película Devuelta', 'La película se ha devuelto correctamente.');

        return redirect('/catalog/show/'.$id);
    }

    public function deleteMovie($id) {
        /*En el método deleteMovie también obtendremos el registro 
        de la película pero tendremos que llamar al método delete() 
        de la misma, una vez hecho esto añadiremos la notificación 
        y realizaremos una redirección al listado general de películas.*/

        $pelicula = Movie::findOrFail($id);

        $pelicula->delete();

        Alert::success('Película Eliminada', 'La película se ha eliminado correctamente.');

        return redirect('/catalog');
    }
}