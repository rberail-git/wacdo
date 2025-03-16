<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'firstname',
        'email',
        'role',
        'password',
        'datePremiereEmbauche',
        'actif',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation avec le modèle Affectations
     */
    public function affectations(): HasMany
    {
        return $this->hasMany(Affectations::class);
    }
    public function userFonctions(): BelongsToMany
    {
        return $this->belongsToMany(Fonctions::class,'affectations','user_id','fonctions_id');
    }
    public function userRestaurants(): BelongsToMany
    {
        return $this->belongsToMany(Restaurants::class,'affectations','user_id','restaurants_id');
    }

    public function scopeFilters( Builder $query, ?string $sortBy, ?string $direction ): void
    {


        $query->when(
            value: $sortBy,
            callback: static function ($query,$sortBy) use ($direction): void {



                match ($sortBy) {
                    'nom' => $query->orderBy('name', $direction),

                };
            }
        );
    }

}
