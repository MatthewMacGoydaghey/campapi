<?php

namespace App\Policies;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function before(User $user, string $ability): bool|null
{
    if (User::getRole($user) == "ADMIN") {
        return true;
    }
 
    return null;
}

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (User::getRole($user) == "CONSEULOR") return true;
        return false;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        if ($user->id == $model->id) return true;
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if ($user->id == $model->id) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        if ($user->id == $model->id) return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return true;
    }
}
