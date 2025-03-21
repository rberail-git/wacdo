<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Affectations;

use App\Models\Fonctions;
use App\Models\Restaurants;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function user( Request $request): View
    {
        if(empty($request->mode)){
            $mode = 'off';
        }else{
            $mode = $request->mode;
        }

        $users = User::with(
            ['affectations'=> function($query){
            $query->orderBy('affectations.date_debut', 'asc');
            $query->limit(1);
            }])
            ->where('role','!=','superadmin')
            ->filters(
                sortBy:$request->sortBy,
                direction:$request->direction,
            )
            ->get();

        $users->load(['userFonctions'=> function($query){
            $query->orderBy('affectations.created_at', 'desc');
            $query->limit(1);
        }]);

        $users->load(['userRestaurants'=> function($query){

            $query->whereNull('affectations.date_fin');
            $query->orWhere('affectations.date_fin', '>=', Carbon::now());
        }]);
        $infos = array();

        $infos['mode'] = $mode;


        return view('collaborateurs',[ 'users' => $users, 'infos' => $infos]);
    }
    public function showByFilter(FilterRequest $request)
    {
        if(empty($request->mode)){
            $mode = 'off';
        }else{
            $mode = $request->mode;
        }


        $users = User::with(
            ['affectations'=> function($query){
                $query->orderBy('affectations.date_debut', 'asc');
                $query->limit(1);
            }])
            ->where('role','!=','superadmin')
            ->filters(
                sortBy:$request->sortBy,
                direction:$request->direction,
            )
            ->where('name','like','%'.$request->name.'%')
            ->where('firstname','like','%'.$request->firstname.'%')
            ->where('email','like','%'.$request->email.'%')
            ->get();

        $users->load(['userFonctions'=> function($query){
            $query->orderBy('affectations.created_at', 'desc');
            $query->limit(1);
        }]);

        $users->load(['userRestaurants'=> function($query){

            $query->whereNull('affectations.date_fin');
            $query->orWhere('affectations.date_fin', '>=', Carbon::now());
        }]);

        $infos = array();

        $infos['mode'] = $mode;

        return view('collaborateurs', [
            'users' => $users,
            'input'=>$request->validated(),
            'infos' => $infos
        ]);
    }
    public function editUser( User $user)
    {
        Gate::authorize('edit', $user);
        $valuePoste = array([$user->role]);



      return view('editCollaborateur', ['user' => $user, 'valuePoste' => $valuePoste] );
    }

    public function updateUser( User $user, UserUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if($data['role']=='user'){
            $user->update([
                'name' => $data['name'],
                'firstname' => $data['firstname'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => null,

            ]);
        }else{
            if($data['password'] == null){
                $user->update([
                    'name' => $data['name'],
                    'firstname' => $data['firstname'],
                    'email' => $data['email'],
                    'role' => $data['role'],

                ]);
            }else{
                $user->update($data);
            }

        }





        return redirect('/collaborateurs')->with('success','Le collaborateur à bien été modifié');
    }
    public function deleteUser( User $user)
    {

        Gate::authorize('delete', $user);
        $user->delete();

        return redirect('/collaborateurs')->with('success','Le collaborateur à bien été supprimé');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if($data['role']=='user') {
            $user = User::create([
                'name' => $data['name'],
                'firstname' => $data['firstname'],
                'email' => $data['email'],
                'role' => $data['role'],

            ]);
        }else{
            $user = User::create([
                'name' => $data['name'],
                'firstname' => $data['firstname'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => Hash::make($data['password']),
            ]);
        }



        return redirect('/collaborateurs')->with('success','Le collaborateur à bien été ajouté');
    }

    public function showDetail(User $user, Request $request)
    {
        if(empty($request->mode)){
            $mode = 'off';
        }else{
            $mode = $request->mode;
        }

        $affectations = Affectations::with(['user', 'restaurant', 'fonction'])
            ->where('user_id', $user->id)
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

        $infos = array();

        $infos['mode'] = $mode;
        $restaurants = Restaurants::all();
        $fonctions = Fonctions::all();
        //dd($userDetail);
        return view('detailCollaborateur', ['user' => $user,'affectations'=>$affectationsWithActive,'restaurants'=>$restaurants,'fonctions'=>$fonctions, 'infos' => $infos]);
    }

    public function showDetailFilter(User $user, FilterRequest $request)
    {
        $input = $request->validated();
        //dd($input);

        if(empty($request->mode)){
            $mode = 'off';
        }else{
            $mode = $request->mode;
        }


        $affectations = Affectations::with(['user', 'restaurant', 'fonction'])
            ->where('user_id', $user->id)
            ->whereRaw('fonctions_id IN (select id from fonctions where name like ? )',['%'.$request->fonction.'%'])
            ->when($request->date_debut, function ($query) use ($request) {
                $query->where('date_debut',$request->date_debut);
            })

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

        $infos = array();

        $infos['mode'] = $mode;
        $restaurants = Restaurants::all();
        $fonctions = Fonctions::all();
        //dd($userDetail);
        return view('detailCollaborateur', ['user' => $user,'input'=>$input,'affectations'=>$affectationsWithActive,'restaurants'=>$restaurants,'fonctions'=>$fonctions, 'infos' => $infos]);
    }



}
