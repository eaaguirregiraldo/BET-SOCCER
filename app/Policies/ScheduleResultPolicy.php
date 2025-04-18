<?php

namespace App\Policies;

use App\Models\ScheduleResult;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScheduleResultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any schedule results.
     */
    public function viewAny(User $user)
    {
        return true; // Cualquier usuario puede ver los resultados de los partidos
    }

    /**
     * Determine whether the user can view the schedule result.
     */
    public function view(User $user, ScheduleResult $scheduleResult)
    {
        return true; // Cualquier usuario puede ver un resultado específico
    }

    /**
     * Determine whether the user can create schedule results.
     */
    public function create(User $user)
    {
        return $user->role === 'Admin'; // Solo el Admin puede crear resultados de partidos
    }

    /**
     * Determine whether the user can update the schedule result.
     */
    public function update(User $user, ScheduleResult $scheduleResult)
    {
        return $user->role === 'Admin'; // Solo el Admin puede actualizar resultados de partidos
    }

    /**
     * Determine whether the user can delete the schedule result.
     */
    public function delete(User $user, ScheduleResult $scheduleResult)
    {
        return $user->role === 'Admin'; // Solo el Admin puede eliminar resultados de partidos
    }
}