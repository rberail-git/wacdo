<?php

namespace Database\Seeders;

use App\Models\Affectations;
use App\Models\Fonctions;
use App\Models\Restaurants;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Table User/Collaborateur
        $user = new User();
        $user->name="SUPER";
        $user->firstname="admin";
        $user->email="super@admin.com";
        $user->role="superadmin";
        $user->password=Hash::make("admin");
        $user->save();

        $user = new User();
        $user->name="DOE";
        $user->firstname="John";
        $user->email="john@doe.com";
        $user->role="admin";
        $user->password=Hash::make("admin");
        $user->save();

        $user = new User();
        $user->name="DUPOND";
        $user->firstname="Jean";
        $user->email="jean@dupond.com";
        $user->role="user";
        $user->save();

        $user = new User();
        $user->name="DURAND";
        $user->firstname="Daniel";
        $user->email="daniel@durand.com";
        $user->role="user";
        $user->save();

        $user = new User();
        $user->name="LEGRAND";
        $user->firstname="Charles";
        $user->email="charles@legrand.com";
        $user->role="user";
        $user->save();

        // Table Restaurant
        $restaurant = new Restaurants();
        $restaurant->name="Wacdo Perpignan Sud";
        $restaurant->adresse="235 route d'Espagne";
        $restaurant->code_postal="66000";
        $restaurant->ville="Perpignan";
        $restaurant->save();

        $restaurant = new Restaurants();
        $restaurant->name="Wacdo Carcassonne";
        $restaurant->adresse="12 rue de la Gare";
        $restaurant->code_postal="11000";
        $restaurant->ville="Carcassonne";
        $restaurant->save();

        $restaurant = new Restaurants();
        $restaurant->name="Wacdo Narbonne Sud";
        $restaurant->adresse="250 route des plages";
        $restaurant->code_postal="11300";
        $restaurant->ville="Narbonne";
        $restaurant->save();

        $restaurant = new Restaurants();
        $restaurant->name="Wacdo Narbonne Nord";
        $restaurant->adresse="Z.I. de la Gravette, Rue Arago";
        $restaurant->code_postal="11300";
        $restaurant->ville="Narbonne";
        $restaurant->save();

        // Table Fonction
        $fonction = new Fonctions();
        $fonction->name="Manager";
        $fonction->save();

        $fonction = new Fonctions();
        $fonction->name="Assistant Manager";
        $fonction->save();

        $fonction = new Fonctions();
        $fonction->name="Chef d'équipe";
        $fonction->save();

        $fonction = new Fonctions();
        $fonction->name="Magasinier";
        $fonction->save();

        $fonction = new Fonctions();
        $fonction->name="Cuisinier";
        $fonction->save();

        $fonction = new Fonctions();
        $fonction->name="Responsable logistique";
        $fonction->save();


    }
}
