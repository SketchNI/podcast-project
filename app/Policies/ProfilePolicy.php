<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        if ($user->can('admin.view') && $user->can('user.all.update')) {
            return true;
        }

        if ($user->can('user.self.bio.update')) {
            return true;
        }

        return $this->deny('You do not have permission to perform this action.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Profile $profile
     * @return Response|bool
     */
    public function view(User $user, Profile $profile): Response|bool
    {
        if ($user->can('admin.view') && $user->can('user.all.update')) {
            return true;
        }

        if ($user->can('user.self.bio.read') && $user->getId() === $profile->getUserId()) {
            return true;
        }

        return $this->deny('You do not have permission to perform this action.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        if ($user->can('admin.view') && $user->can('user.all.update')) {
            return true;
        }

        if ($user->can('user.self.bio.create')) {
            return true;
        }

        return $this->deny('You do not have permission to perform this action.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Profile $profile
     * @return Response|bool
     */
    public function update(User $user, Profile $profile): Response|bool
    {
        if ($user->can('admin.view') && $user->can('user.all.update')) {
            return true;
        }

        if ($user->can('user.self.bio.update') && $user->getId() === $profile->getUserId()) {
            return true;
        }

        return $this->deny('You do not have permission to perform this action.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Profile $profile
     * @return Response|bool
     */
    public function delete(User $user, Profile $profile): Response|bool
    {
        if ($user->can('admin.view') && $user->can('user.all.update')) {
            return true;
        }

        if ($user->can('user.self.bio.delete') && $user->getId() === $profile->getUserId()) {
            return true;
        }

        return $this->deny('You do not have permission to perform this action.');
    }
}
