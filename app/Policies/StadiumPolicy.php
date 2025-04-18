<?php

namespace App\Policies;

use App\Models\Stadium;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StadiumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any stadiums.
     */
    public function viewAny(User $user)
    {
        return $user->role === 'Admin';
    }

    /**
     * Determine whether the user can view the stadium.
     */
    public function view(User $user, Stadium $stadium)
    {
        return $user->role === 'Admin';
    }

    /**
     * Determine whether the user can create stadiums.
     */
    public function create(User $user)
    {
        return $user->role === 'Admin';
    }

    /**
     * Determine whether the user can update the stadium.
     */
    public function update(User $user, Stadium $stadium)
    {
        return $user->role === 'Admin';
    }

    /**
     * Determine whether the user can delete the stadium.
     */
    public function delete(User $user, Stadium $stadium)
    {
        return $user->role === 'Admin';
    }
}