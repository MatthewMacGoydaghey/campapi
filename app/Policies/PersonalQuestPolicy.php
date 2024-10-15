<?php

namespace App\Policies;

use App\Http\Requests\UpdateUserRequest;
use App\Models\PersonalQuest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PersonalQuestPolicy
{

    public function before(User $user, string $ability): bool|null
{
    if ($user->getRole($user) == "ADMIN") {
        return true;
    }
 
    return null;
}
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->getRole($user) == "CONSEULOR") return true;
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PersonalQuest $personalQuest): bool
    {
        if ($user->getRole($user) == "CONSEULOR" && $user->id == $personalQuest->sent_by) return true;
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (User::getRole($user) == "CONSEULOR") return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PersonalQuest $personalQuest): bool
    {
        if (User::getRole($user) == "CONSEULOR" && $user->id == $personalQuest->sent_by) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PersonalQuest $personalQuest): bool
    {
        if (User::getRole($user) == "CONSEULOR" && $user->id == $personalQuest->sent_by) return true;
        return false;
    }
}
