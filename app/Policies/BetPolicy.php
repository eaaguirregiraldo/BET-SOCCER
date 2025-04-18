<?php

namespace App\Policies;

use App\Models\Bet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any bets.
     */
    public function viewAny(User $user)
    {
        return true; // Cualquier usuario puede ver las apuestas
    }

    /**
     * Determine whether the user can view the bet.
     */
    public function view(User $user, Bet $bet)
    {
        return true; // Cualquier usuario puede ver una apuesta específica
    }

    /**
     * Determine whether the user can create bets.
     */
    public function create(User $user)
    {
        return $user->role === 'Bet_User'; // Solo el Bet_User puede crear apuestas
    }

    /**
     * Determine whether the user can update the bet.
     */
    public function update(User $user, Bet $bet)
    {
        return $user->role === 'Bet_User'; // Solo el Bet_User puede actualizar apuestas
    }

    /**
     * Determine whether the user can delete the bet.
     */
    public function delete(User $user, Bet $bet)
    {
        return false; // Ningún usuario puede eliminar apuestas
    }
}