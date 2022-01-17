<?php

namespace App\Policies;

use App\Models\Result;
use App\Models\User;
use App\Models\ClearedStudent;
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
     * if own results and is cleared by accounts online / offline (via excel sheet of cleared student sent to IT Unit)
     * and is a student
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Result $result)
    {
        $cleared_national_id = ClearedStudent::where('national_id_name','LIKE',$user->national_id.'%')
            ->where('intake_id','<=',$result->intake_id)
            ->get();
        return $user->whereHas('results')
                    ->whereHas('fees', function ($query) use($result, $user) {
                            $query->where('is_cleared',1)
                                    ->where('user_id',$user->id)
                                    ->where('intake_id',$result->intake_id);
                        })->exists() || $cleared_national_id->count()>0;
                                        
      /*  return (($user->id == $result->users_id && $user->fees[0]->is_cleared && $result->intake_id == $user->fees[0]->intake_id) || $cleared_national_id->count()>0);*/
        //|| $user->hasRole('superadmin') || $user->hasRole('exams') || $user->hasRole('superadmin') || $user->hasRole('manager') 

    }

    /**
     * Determine whether the user can upload proof of payment
     * Must be the logged in user and results clearance being shown is own and is not cleared
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function sendProof(User $user, Result $result)
    {
         $cleared_national_id = ClearedStudent::where('national_id_name','LIKE',$user->national_id.'%')->get();
        return ($user->id  == $result->users_id && $user->id == $user->fees->user_id && !$user->fees->is_cleared && $cleared_national_id->count()<1);
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
