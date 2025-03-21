<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonctions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',


    ];

    public function scopeFilters( Builder $query, ?string $sortBy, ?string $direction ): void
    {


        $query->when(
            value: $sortBy,
            callback: static function ($query,$sortBy) use ($direction): void {



                match ($sortBy) {
                    'name' => $query->orderBy('name', $direction),

                };
            }
        );
    }
}
