<?php

namespace App\Policies;

use App\Models\User;
use App\Models\theme;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThemePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\theme  $theme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, theme $theme)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\theme  $theme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, theme $theme)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\theme  $theme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, theme $theme)
    {
        return $user->isAdmin();
    }
}
