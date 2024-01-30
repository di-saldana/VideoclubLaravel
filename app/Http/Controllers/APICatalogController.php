<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;


class APICatalogController extends Controller
{
    public function index(){
        return response()->json(Movie::all());
    }

    public function show($id){
        return response()->json(Movie::findOrFail($id));
    }

    public function store(Request $request){
        $pelicula = new Movie;
        $pelicula->title = $request->input('title');
        $pelicula->year = $request->input('year');
        $pelicula->director = $request->input('director');

        if ($request->hasFile('poster') && $request->file('poster')->isValid()) {
            $posterPath = $request->file('poster')->store('');
            $pelicula->poster = $posterPath;
        }

        $pelicula->rented = false;
        $pelicula->synopsis = $request->input('synopsis');
        $pelicula->save();

        return response()->json(['error' => false,
        'msg' => 'La película se ha guardado correctamente.']);
    }
   
    public function update(Request $request, $id){
        $pelicula = Movie::findOrFail($id);

        if ($request->input('title')) {
            $pelicula->title = $request->input('title');
        }
            
        if ($request->input('year')) {
            $pelicula->year = $request->input('year');
        }
            
        if ($request->input('director')) {
            $pelicula->director = $request->input('director');
        }
            
        if ($request->input('poster')) {
            $pelicula->poster = $request->input('poster', '');
        }
            
        if ($request->input('synopsis')) {
            $pelicula->synopsis = $request->input('synopsis');
        }
            
        $pelicula->save();
        
        return response()->json(['error' => false,
        'msg' => 'La película se ha modificado correctamente.']);
    }
    
    public function destroy($id){
        $pelicula = Movie::findOrFail($id);
        $pelicula->delete();

        return response()->json(['error' => false,
        'msg' => 'La película se ha eliminado correctamente.']);
    }

    public function putRent($id){
        $pelicula = Movie::findOrFail($id);
        $pelicula->rented = true;
        $pelicula->save();

        return response()->json(['error' => false,
        'msg' => 'La película se ha marcado como alquilada']);
    }

    public function putReturn($id){
        $pelicula = Movie::findOrFail($id);
        $pelicula->rented = false;
        $pelicula->save();

        return response()->json(['error' => false,
        'msg' => 'La película se ha devuelto correctamente.']);
    }
}

