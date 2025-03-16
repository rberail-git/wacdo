<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurants extends Model
{
    public function scopeFilters( Builder $query, ?string $sortBy, ?string $direction ): void
    {
        $query->when(
            value: $sortBy,
            callback: static function ($query,$sortBy) use ($direction): void {
                match ($sortBy) {
                    'name' => $query->orderBy('name', $direction),
                    'adresse' => $query->orderBy('adresse', $direction),
                    'code_postal' => $query->orderBy('code_postal', $direction),
                    'ville' => $query->orderBy('ville', $direction),
                };
            }
        );
    }



    protected $fillable = [
        'name',
        'adresse',
        'code_postal',
        'ville',

    ];
    public function affectations(): HasMany
    {
        return $this->hasMany(Affectations::class);
    }


}
