<?php

namespace App\Http\Controllers;

use App\Http\Requests\AffectationUpdateRequest;
use App\Http\Requests\FilterRequest;
use App\Models\Affectations;
use App\Models\Filtres;
use App\Models\Fonctions;
use App\Models\Restaurants;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder;

class AffectationsController extends Controller
{
    public function show( Request $request ){
        if(empty($request->mode)){
            $mode = 'off';
        }else{
            $mode = $request->mode;
        }

        $affectations = Affectations::with(['user', 'restaurant', 'fonction'])
            ->filters(
                sortBy:$request->sortBy,
                direction:$request->direction,
            )
            ->get();
        $affectationsWithActive = $affectations->map(function ($affectation) {


            $affectation->active = true;

            if($affectation->date_debut > Carbon::now())
            {
                $affectation->active = false;

            }
            if($affectation->date_fin < Carbon::now())
            {
                $affectation->active = false;

            }
            if($affectation->date_debut < Carbon::now() && is_null($affectation->date_fin) )
            {
                $affectation->active = true;

            }


            return $affectation;


        });

        $users = User::all();
        $restaurants = Restaurants::all();
        $fonctions = Fonctions::all();

        $restaurantsDistinctVille = Restaurants::query()->distinct()->pluck('ville');

        $infos = array();

        $infos['mode'] = $mode;

        return view('affectations',[
            'affectations'=>$affectationsWithActive,
            'infos' => $infos,
            'restaurants'=>$restaurants,
            'restaurantsDistinctVille'=>$restaurantsDistinctVille,
            'fonctions'=>$fonctions,
            'users'=>$users
        ]);
    }
    public function showByFilter( FilterRequest $request ){

        if(empty($request->mode)){
            $mode = 'off';
        }else{
            $mode = $request->mode;
        }
//dd($request);
        $users = User::all();
        $restaurants = Restaurants::all();
        $restaurantsDistinctVille = Restaurants::query()->distinct()->pluck('ville');
        $fonctions = Fonctions::all();


        if($request->date_debut == null){
            $date_debut = '1900-01-01';

        }else{
            $date_debut = $request->date_debut;

        }
        if($request->date_fin == null){
            $date_fin = '2900-01-01';

        }else{
             $date_fin = $request->date_fin;
        }

        if($request->fonctions_id == null){
            $tableFonctions = Fonctions::all();

        }else{
            $tableFonctions = Fonctions::where('id',$request->fonctions_id)->get();

        }
        //dd($request->fonctions_id);

        if($request->ville == null){
            $restaurantsByVille = Restaurants::all();

        }else{
            $restaurantsByVille = Restaurants::where('ville',$request->ville)->get();

        }

        //dd($restaurantsByVille);

        //UNIQUEMENT CDD
        if($request->cdd == 'on' AND !isset($request->cdi)){

            $affectations = Affectations::with(['user', 'restaurant', 'fonction'])
                ->whereIn('restaurants_id',$restaurantsByVille->pluck('id'))
                ->whereIn('fonctions_id',$tableFonctions->pluck('id'))
                ->whereNotNull('date_fin')
                ->whereBetween('date_debut',[$date_debut,$date_fin])
                ->whereBetween('date_fin',[$date_debut,$date_fin])
                ->get();

        }
        //UNIQUEMENT CDI
        if($request->cdi == 'on' AND !isset($request->cdd)){

            $affectations = Affectations::with(['user', 'restaurant', 'fonction'])
                ->whereIn('restaurants_id',$restaurantsByVille->pluck('id'))
                ->whereIn('fonctions_id',$tableFonctions->pluck('id'))
                ->whereBetween('date_debut',[$date_debut,$date_fin])
                ->whereNull('date_fin')
                ->get();
        }

        //CDD ET CDI
        if($request->cdi == 'on' AND $request->cdd == 'on'){

            $affectations = Affectations::with(['user', 'restaurant', 'fonction'])
                ->whereIn('restaurants_id',$restaurantsByVille->pluck('id'))
                ->whereIn('fonctions_id',$tableFonctions->pluck('id'))
                ->whereBetween('date_debut',[$date_debut,$date_fin])
                //->whereBetween('date_fin',[$date_debut,$date_fin])
                ->get();
        }

        $affectationsWithActive = $affectations->map(function ($affectation) {


            $affectation->active = true;

            if($affectation->date_debut > Carbon::now())
            {
                $affectation->active = false;

            }
            if($affectation->date_fin < Carbon::now())
            {
                $affectation->active = false;

            }
            if($affectation->date_debut < Carbon::now() && is_null($affectation->date_fin) )
            {
                $affectation->active = true;

            }


            return $affectation;


        });

        $infos = array();

        $infos['mode'] = $mode;

        //dd($request->validated());

        return view('affectations',[
            'input'=>$request->validated(),
            'infos'=>$infos,
            'affectations'=>$affectationsWithActive,
            'restaurants'=>$restaurants,
            'restaurantsDistinctVille'=>$restaurantsDistinctVille,
            'fonctions'=>$fonctions,
            'users'=>$users
        ]);
    }

    public function create()
    {
        $users = User::where('role','!=','superadmin')->get();
        $restaurants = Restaurants::all();
        $fonctions = Fonctions::all();
        return view('newAffectation',[
            'restaurants'=>$restaurants,
            'fonctions'=>$fonctions,
            'users'=>$users
        ]);

    }
    public function store( AffectationUpdateRequest $request){
        $data = $request->validated();

        $tableRestaurant = $data['restaurants_id_multi'];
        //dd( $data);
        foreach ($tableRestaurant as $key => $idRestaurant)
        {

            Affectations::create([
                'user_id' => $data['user_id'],
                'restaurants_id' => $idRestaurant,
                'fonctions_id' => $data['fonctions_id'],
                'date_debut' => $data['date_debut'],
                'date_fin' => $data['date_fin'],
            ]);
        }


        return redirect(url()->previous())->with('success','L\'affectation à bien été ajoutée');

    }

    public function edit( Affectations $affectation)
    {
        $users = User::all();
        $restaurants = Restaurants::all();
        $fonctions = Fonctions::all();
        return view('editAffectation',[
            'affectation'=>$affectation,
            'restaurants'=>$restaurants,
            'fonctions'=>$fonctions,
            'users'=>$users
        ]);
    }
    public function update(AffectationUpdateRequest $request, Affectations $affectation)
    {
        $data = $request->validated();
        $affectation->update($data);

        return redirect(url()->previous())->with('success','L\'affectation à bien été modifié');
    }

    public function delete( Affectations $affectation)
    {


        $affectation->delete();

        return redirect('/affectations')->with('success','L\'affectation à bien été supprimé');
    }
}
