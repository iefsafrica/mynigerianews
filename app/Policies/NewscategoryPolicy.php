<?php

namespace App\Policies;

use App\Models\Newscategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewscategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coursecategory  $coursecategory
     * @return mixed
     */
    public function view(User $user, Coursecategory $coursecategory)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coursecategory  $coursecategory
     * @return mixed
     */
    public function update(User $user, Newscategory $newscategory)
    {
        if ($user->roles->contains('slug','reporter')){
            return true ;
        }elseif ($user->permissions->contains('slug','edit')){
            return true ;
        }elseif ($newscategory->id){
            return true ;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coursecategory  $coursecategory
     * @return mixed
     */
    public function delete(User $user, Coursecategory $coursecategory)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coursecategory  $coursecategory
     * @return mixed
     */
    public function restore(User $user, Coursecategory $coursecategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Coursecategory  $coursecategory
     * @return mixed
     */
    public function forceDelete(User $user, Coursecategory $coursecategory)
    {
        //
    }
}
