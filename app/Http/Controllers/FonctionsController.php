<?php

namespace App\Http\Controllers;

use App\Http\Requests\FonctionUpdateRequest;
use App\Models\Fonctions;
use Illuminate\Http\Request;

class FonctionsController extends Controller
{
    public function show( Request $request ){
        $fonctions = Fonctions::query()

            ->filters(
                sortBy:$request->sortBy,
                direction:$request->direction,
            )->get();
        return view('fonctions',['fonctions'=>$fonctions]);
    }


    public function store( FonctionUpdateRequest $request){
        $data = $request->validated();
        Fonctions::create($data);

        return redirect('/fonctions')->with('success','La fonction à bien été ajoutée');

    }
    public function edit( Fonctions $oldFonction){
        $fonctions = Fonctions::all();


        return view('editFonction', ['oldFonction' => $oldFonction], ['fonctions'=>$fonctions]);

    }
    public function update( Fonctions $oldFonction, FonctionUpdateRequest $request){
        $data = $request->validated();

        $oldFonction->update($data);

        return redirect('/fonctions')->with('success','La fonction à bien été modifiée');

    }
    public function delete(Fonctions $oldFonction){
        $oldFonction->delete();
        return redirect('/fonctions')->with('success','La fonction a bien été supprimée');

    }
}
