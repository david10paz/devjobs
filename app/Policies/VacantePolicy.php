<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacantePolicy
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
        //Le decimos que solo vea el modelo de Vacantes quien tenga de rol el numero 2 (Recruiters) que son los que
        //pueden crear, editar, borrar... las vacantes
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vacante $vacante)
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
        //Le decimos que solo puede crear el modelo de Vacantes quien tenga de rol el numero 2 (Recruiters) que son los que
        //pueden crear, editar, borrar... las vacantes
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vacante $vacante)
    {
        //Le dejamos ver la pagina de editar si el usuario registrado es el mismo que esta registrado como creador de la vacante
        return $user->id === $vacante->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vacante $vacante)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vacante $vacante)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vacante $vacante)
    {
        //
    }
}
