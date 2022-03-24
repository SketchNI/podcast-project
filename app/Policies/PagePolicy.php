<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PagePolicy
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
     * @param Page $page
     * @return bool
     */
    public function view(User $user, Page $page): bool
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
        if($user->can('podcast.all.create')) {
            return true;
        }
        return $this->deny('You are unable to perform this action.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response|bool
     */
    public function update(User $user, Page $page): Response|bool
    {
        if($user->can('podcast.all.update')) {
            return true;
        }
        return $this->deny('You are unable to perform this action.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response|bool
     */
    public function delete(User $user, Page $page): Response|bool
    {
        if($user->can('podcast.all.delete')) {
            return true;
        }
        return $this->deny('You are unable to perform this action.');
    }
}
