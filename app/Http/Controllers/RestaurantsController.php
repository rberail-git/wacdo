<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Http\Requests\RestaurantUpdateRequest;
use App\Models\Affectations;
use App\Models\Filtres;
use App\Models\Fonctions;
use App\Models\Restaurants;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    public function show( Request $request )
    {
        $restaurants = Restaurants::query()

            ->filters(
            sortBy:$request->sortBy,
            direction:$request->direction,
        )->get();
        return view('restaurants', compact('restaurants'));
    }


    public function showByFilter(FilterRequest $request)
    {



            $restaurants = Restaurants::query()
                ->where('name','like','%'.$request->name.'%')
                ->where('code_postal','like','%'.$request->code_postal.'%')
                ->where('ville','like','%'.$request->ville.'%')

                ->get();



        return view('restaurants', [
            'restaurants'=>$restaurants,
            'input'=>$request->validated()
        ]);
    }

    public function create()
    {
        return view('newRestaurant');
    }
    public function store(RestaurantUpdateRequest $request)
    {

            $restaurant = Restaurants::create($request->validated());

        return redirect('/restaurants')->with('success','Le restaurant à bien été ajouté');
    }

    public function edit( Restaurants $restaurant)
    {
        return view('editRestaurant', ['restaurant' => $restaurant]);
    }

    public function update( Restaurants $restaurant, RestaurantUpdateRequest $request)
    {
        $data = $request->validated();

        $restaurant->update($data);

        return redirect('/restaurants')->with('success','Le restaurant à bien été modifié');
    }

    public function delete( Restaurants $restaurant)
    {


        $restaurant->delete();

        return redirect('/restaurants')->with('success','Le restaurant à bien été supprimé');
    }

    public function showDetail( Restaurants $restaurant, Request $request)
    {
        //dd($request->mode);
        if(empty($request->mode)){
            $mode = 'off';
        }else{
            $mode = $request->mode;
        }
        $affectations = Affectations::with(['user', 'restaurant', 'fonction'])
            ->where('restaurants_id', $restaurant->id)

            //->histo( mode:$mode, )
            ->orderBy('date_fin', 'asc')  // Trie en fonction de `date_fin`, en premier lieu les affectations avec date_fin null
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
        /// Nombre de salarié actif
        $nbActif = $affectationsWithActive->where('active',true)->count();

        /// Nombre de CDD
        $nbCDD = $affectationsWithActive->where('active',true)->where('date_fin','>',Carbon::now())->count();

        /// Nombre de CDI
        $nbCDI = $affectationsWithActive->where('active',true)->whereNull('date_fin')->count();

        /// Nombre de Fin de contrat
        $today = Carbon::today();
        $endWeek = Carbon::today()->addDays(3);
        $nbFinContrat = $affectationsWithActive->where('active',true)->whereBetween('date_fin',[$today,$endWeek])->count();

        /// Nom et prénom du manager | 'Aucun manager' si null
        $manager = $affectationsWithActive

            ->where('active',true)
            ->where('fonction.name','==', 'Manager')
            ->first();

        if(empty($manager)){
            $manager = 'Aucun manager';
        }else{
            $manager = $manager?->user->name.' '.$manager?->user->firstname;
        }

        /// Tableau recap des infos pour la vue
        $infos = array();
        $infos['manager'] = $manager;
        $infos['nbActif'] = $nbActif;
        $infos['nbCDD'] = $nbCDD;
        $infos['nbCDI'] = $nbCDI;
        $infos['nbFinContrat'] = $nbFinContrat;
        $infos['mode'] = $mode;

        $users = User::all();
        $fonctions = Fonctions::all();

        //dd($infos['nbActif']);
        return view('detailRestaurant', ['restaurant' => $restaurant,'affectations' => $affectationsWithActive,'infos'=>$infos,'users'=>$users,'fonctions'=>$fonctions]);
    }

    public function showDetailFilter( Restaurants $restaurant, FilterRequest $request)
    {
        $input = $request->validated();

        if(empty($request->mode)){
            $mode = 'off';
        }else{
            $mode = $request->mode;
        }

        $affectations = Affectations::with(['user', 'restaurant', 'fonction'])
            ->where('restaurants_id', $restaurant->id)


            ->whereRaw('user_id IN (select id from users where name like ? )',['%'.$request->name.'%'])
            ->whereRaw('fonctions_id IN (select id from fonctions where name like ? )',['%'.$request->fonction.'%'])
            ->when($request->date_debut, function ($query) use ($request) {
                    $query->where('date_debut',$request->date_debut);
            })
            ->orderBy('date_fin', 'asc')  // Trie en fonction de `date_fin`, en premier lieu les affectations avec date_fin null
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
        /// Nombre de salarié actif
        $nbActif = $affectationsWithActive->where('active',true)->count();

        /// Nombre de CDD
        $nbCDD = $affectationsWithActive->where('active',true)->where('date_fin','>',Carbon::now())->count();

        /// Nombre de CDI
        $nbCDI = $affectationsWithActive->where('active',true)->whereNull('date_fin')->count();

        /// Nombre de Fin de contrat
        $today = Carbon::today();
        $endWeek = Carbon::today()->addDays(3);
        $nbFinContrat = $affectationsWithActive->where('active',true)->whereBetween('date_fin',[$today,$endWeek])->count();

        /// Nom et prénom du manager | 'Aucun manager' si null
        $manager = $affectationsWithActive

            ->where('active',true)
            ->where('fonction.name','==', 'Manager')
            ->first();

        if(empty($manager)){
            $manager = 'Aucun manager';
        }else{
            $manager = $manager?->user->name.' '.$manager?->user->firstname;
        }

        /// Tableau recap des infos pour la vue
        $infos = array();
        $infos['manager'] = $manager;
        $infos['nbActif'] = $nbActif;
        $infos['nbCDD'] = $nbCDD;
        $infos['nbCDI'] = $nbCDI;
        $infos['nbFinContrat'] = $nbFinContrat;
        $infos['mode'] = $mode;

        $users = User::all();
        $fonctions = Fonctions::all();

        //dd($infos['nbActif']);
        return view('detailRestaurant', ['restaurant' => $restaurant,'input'=>$input,'affectations' => $affectationsWithActive,'infos'=>$infos,'users'=>$users,'fonctions'=>$fonctions]);
    }

}
