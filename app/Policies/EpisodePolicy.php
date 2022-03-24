<?php

namespace App\Policies;

use App\Models\Episode;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EpisodePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Episode $episode
     * @return bool
     */
    public function view(User $user, Episode $episode): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        if($user->can('admin.view') && $user->can('podcast.all.create')) {
            return true;
        }

        return $this->deny('You do not have permission to access this episode');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Episode $episode
     * @return Response|bool
     */
    public function update(User $user, Episode $episode): Response|bool
    {
        if($user->can('admin.view') && $user->can('podcast.all.update')) {
            return true;
        }

        return $this->deny('You do not have permission to access this episode');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Episode $episode
     * @return Response|bool
     */
    public function delete(User $user, Episode $episode): Response|bool
    {
        if($user->can('admin.view') && $user->can('podcast.all.delete')) {
            return true;
        }

        return $this->deny('You do not have permission to access this episode');
    }
}
