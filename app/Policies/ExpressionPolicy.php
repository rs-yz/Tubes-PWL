<?php

namespace App\Policies;

use App\Models\User;
use App\Models\expression;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpressionPolicy
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
     * @param  \App\Models\expression  $expression
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, expression $expression)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\expression  $expression
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, expression $expression)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\expression  $expression
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, expression $expression)
    {
        return $user->isAdmin();
    }
}
