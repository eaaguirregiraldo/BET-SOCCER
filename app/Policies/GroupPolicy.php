<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any groups.
     */
    public function viewAny(User $user)
    {
        return true; // Cualquier usuario puede ver los grupos
    }

    /**
     * Determine whether the user can view the group.
     */
    public function view(User $user, Group $group)
    {
        return true; // Cualquier usuario puede ver un grupo específico
    }

    /**
     * Determine whether the user can create groups.
     */
    public function create(User $user)
    {
        return $user->role === 'Admin'; // Solo el Admin puede crear grupos
    }

    /**
     * Determine whether the user can update the group.
     */
    public function update(User $user, Group $group)
    {
        return $user->role === 'Admin'; // Solo el Admin puede actualizar grupos
    }

    /**
     * Determine whether the user can delete the group.
     */
    public function delete(User $user, Group $group)
    {
        return $user->role === 'Admin'; // Solo el Admin puede eliminar grupos
    }
}