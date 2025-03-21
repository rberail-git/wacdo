<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * En tant que Admin je peux Editer mon compte et les comptes dont le role est 'user'
     * En tant que SuperAdmin je peux Editer tous les comptes
     */
    public function edit(User $user, User $model): bool
    {
        return $user->role == 'superadmin' | $user->id == $model->id | $model->role == 'user';
    }

    /**
     * Determine whether the user can delete the model.
     *  En tant que Admin je peux Supprimer mon compte et les comptes dont le role est 'user'
     *  En tant que SuperAdmin je peux Supprimer tous les comptes
     */
    public function delete(User $user, User $model): bool
    {
        return $user->role == 'superadmin' | $user->id == $model->id | $model->role == 'user';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->role == 'superadmin' | $user->id == $model->id | $model->role == 'user';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->role == 'superadmin' | $user->id == $model->id | $model->role == 'user';
    }
}
