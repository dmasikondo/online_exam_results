<?php

namespace App\Policies;

use App\Models\Result;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResultPolicy
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
     * Determine if user can view his / her examination results
     * if own results and is cleared by accounts
     * if user is manager, ITU or exams
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Result $result)
    {
        return ($user->id == $result->users_id && $user->fees[0]->is_cleared) || $user->hasRole('superadmin') || $user->hasRole('exams') || $user->hasRole('superadmin') || $user->hasRole('manager');
    }

    /**
     * Determine whether the user can upload proof of payment
     * Must be the logged in user and results clearance being shown is own and is pending
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function sendProof(User $user, Result $result)
    {
        return ($user->id  == $result->users_id && $user->id == $user->fees->user_id && !$user->fees->is_cleared);
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
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Result $result)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Result $result)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Result $result)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Result $result)
    {
        //
    }
}
