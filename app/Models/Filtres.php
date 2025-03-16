<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filtres extends Model
{
    protected $fillable = [
        'date_debut',
        'date_fin',
        'fonction',
        'ville',
        'contrat',
    ];
}
