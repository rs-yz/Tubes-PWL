<?php

namespace App\Policies;

use App\Models\User;
use App\Models\invitationTheme;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationThemePolicy
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
     * @param  \App\Models\invitationTheme  $invitationTheme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, invitationTheme $invitationTheme)
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
     * @param  \App\Models\invitationTheme  $invitationTheme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, invitationTheme $invitationTheme)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\invitationTheme  $invitationTheme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, invitationTheme $invitationTheme)
    {
        return $user->isAdmin();
    }
}
