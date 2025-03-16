<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RestaurantsController;
use App\Http\Controllers\FonctionsController;
use App\Http\Controllers\AffectationsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('accueil');
})->name('accueil');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//ROUTE COLLABORATEURS/USERS
Route::middleware('auth')->group(function () {
    Route::get('/collaborateurs', [RegisteredUserController::class,'user'])->name('collaborateurs');
    Route::post('/collaborateurs', [RegisteredUserController::class,'showByFilter']);

    Route::get('/collaborateurs/new', [RegisteredUserController::class,'create'])->name('newCollaborateur');
    Route::post('/collaborateurs/new', [RegisteredUserController::class,'store']);

    Route::get('/collaborateurs/{user}/edit', [RegisteredUserController::class,'editUser'])->name('editCollaborateur');
    Route::post('/collaborateurs/{user}/edit', [RegisteredUserController::class,'updateUser']);

    Route::get('/collaborateurs/{user}/delete', [RegisteredUserController::class,'deleteUser'])->name('deleteCollaborateur');

    Route::get('/collaborateurs/{user}/detail', [RegisteredUserController::class,'showDetail'])->name('detailCollaborateur');
    Route::post('/collaborateurs/{user}/detail', [RegisteredUserController::class,'showDetailFilter']);
});

//ROUTE RESTAURANTS
Route::middleware('auth')->group(function () {
    Route::get('/restaurants', [RestaurantsController::class,'show'])->name('restaurants');
    Route::post('/restaurants', [RestaurantsController::class,'showByFilter']);

    Route::get('/restaurants/new', [RestaurantsController::class,'create'])->name('newRestaurant');
    Route::post('/restaurants/new', [RestaurantsController::class,'store']);

    Route::get('/restaurants/{restaurant}/edit', [RestaurantsController::class,'edit'])->name('editRestaurant');
    Route::post('/restaurants/{restaurant}/edit', [RestaurantsController::class,'update']);

    Route::get('/restaurants/{restaurant}/delete', [RestaurantsController::class,'delete'])->name('deleteRestaurant');

    Route::get('/restaurants/{restaurant}/detail', [RestaurantsController::class,'showDetail'])->name('detailRestaurant');
    Route::post('/restaurants/{restaurant}/detail', [RestaurantsController::class,'showDetailFilter']);


});

//ROUTE FONCTIONS
Route::middleware('auth')->group(function () {
    Route::get('/fonctions', [FonctionsController::class,'show'])->name('fonctions');


    Route::post('/fonctions', [FonctionsController::class,'store']);

    Route::get('/fonctions/{oldFonction}/edit', [FonctionsController::class,'edit'])->name('editFonction');
    Route::post('/fonctions/{oldFonction}/edit', [FonctionsController::class,'update']);

    Route::get('/fonctions/{oldFonction}/delete', [FonctionsController::class,'delete'])->name('deleteFonction');

});
//ROUTE AFFECTATIONS
Route::middleware('auth')->group(function () {
    Route::get('/affectations', [AffectationsController::class,'show'])->name('affectations');
    Route::post('/affectations', [AffectationsController::class,'showByFilter']);

    Route::get('/affectations/new', [AffectationsController::class,'create'])->name('newAffectation');
    Route::post('/affectations/new', [AffectationsController::class,'store']);

    Route::get('/affectations/{affectation}/edit', [AffectationsController::class,'edit'])->name('editAffectation');
    Route::post('/affectations/{affectation}/edit', [AffectationsController::class,'update']);

    Route::get('/affectations/{affectation}/delete', [AffectationsController::class,'delete'])->name('deleteAffectation');

});

require __DIR__.'/auth.php';
