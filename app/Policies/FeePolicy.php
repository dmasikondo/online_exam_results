<?php

namespace App\Policies;

use App\Models\Fee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeePolicy
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
     * Determine whether the user can send proof of payment
     * Must be the logged in user and results clearance being shown is own and is not cleared
     * Or is accounts or is ITU or management or exams 
     * 
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Fee $fee)
    {
        return ($user->id == $fee->user_id) || $user->hasRole('superadmin') || $user->hasRole('exams') || $user->hasRole('superadmin') || $user->hasRole('manager');;
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
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Fee $fee)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Fee $fee)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Fee $fee)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Fee $fee)
    {
        //
    }
}
