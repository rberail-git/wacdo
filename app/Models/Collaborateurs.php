<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborateurs extends Model
{
    protected $fillable = [
        'name',
        'firstname',
        'fonction_name',
        'affectations_name',
        'date_premiere_embauche',

    ];
}
