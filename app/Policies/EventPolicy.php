<?php

namespace App\Policies;

use App\Models\User;
use App\Models\event;
use App\Models\invitation;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;


    public function before(User $user, $ability)
    {
        if($user->isAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\event  $event
     * @param  \App\Models\invitation  $invitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, event $event)
    {
        return $user->id === $event->invitation()->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, invitation  $invitation)
    {
        return $user->id === $invitation->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, event $event)
    {
        return $user->id === $event->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, event $event)
    {
        return $user->id === $event->id;
    }
}
