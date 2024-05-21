<?php

namespace App\Policies;

use App\Models\Invoise;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoisePolicy
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
     * @param  \App\Models\Invoise  $invoise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Invoise $invoise)
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
     * @param  \App\Models\Invoise  $invoise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Invoise $invoise)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invoise  $invoise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Invoise $invoise)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invoise  $invoise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Invoise $invoise)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Invoise  $invoise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Invoise $invoise)
    {
        //
    }
}
