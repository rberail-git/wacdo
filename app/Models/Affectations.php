<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Affectations extends Model
{


    protected $fillable = [
        'user_id',
        'restaurants_id',
        'fonctions_id',
        'date_debut',
        'date_fin',
    ];

    protected $appends = [
        'active',

    ];


    /**
     * Relation avec le modèle User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec le modèle Restaurants
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurants::class, 'restaurants_id');
    }

    /**
     * Relation avec le modèle Fonctions
     */
    public function fonction()
    {
        return $this->belongsTo(Fonctions::class, 'fonctions_id');
    }

    public function scopeFilters( Builder $query, ?string $sortBy, ?string $direction ): void
    {


        $query->when(
            value: $sortBy,
            callback: static function ($query,$sortBy) use ($direction): void {



                match ($sortBy) {
                    'salarie' => $query->orderBy('user_id', $direction),
                    'restaurant' => $query->orderBy('restaurants_id', $direction),
                    'fonction' => $query->orderBy('fonctions_id', $direction),
                    'debut' => $query->orderBy('date_debut', $direction),
                    'fin' => $query->orderBy('date_fin', $direction),
                };
            }
        );
    }

    public function scopeHisto( Builder $query, ?string $mode ): void
    {
        $query->when(
            value: $mode,
            callback: static function ($query,$mode) : void {
                match ($mode) {
                    'off' => $query
                        ->whereNull('date_fin')
                        ->orWhere('date_fin', '>=', Carbon::now()),
                    'on' => $query,


                };
            }
        );
    }


}
