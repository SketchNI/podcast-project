<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ModelUpdateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * List all users.
     *
     * @return Response
     */
    public function index(): Response
    {
        try {
            $this->authorize('viewAny', auth()->user());

            $users = User::paginate(15);
            return Inertia::render('Admin/User/Index', compact('users'));
        } catch (AuthorizationException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Show a users profile.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        try {
            $this->authorize('view', auth()->user());

            $user = User::find($user->id);
            $roles = DB::table('roles')->select('id', 'name')->get(['id', 'name']);
            return Inertia::render('Admin/User/Show', compact('user', 'roles'));
        } catch (AuthorizationException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Update a users profile.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return Response|RedirectResponse
     */
    public function update(UpdateRequest $request, User $user): Response|RedirectResponse
    {
        try {
            $this->authorize('update', auth()->user());

            $user = User::find($user->id);
            $user
                ->setName($request->get('name'))
                ->setDisplayName($request->get('display_name'))
                ->setEmail($request->get('email'))
                ->setEmailVerifiedAt(Carbon::now())
                ->syncRoles($request->get('role'))
                ->profile
                ->setBio($request->get('bio'))
                ->setTwitter($request->get('twitter'))
                ->setDiscord($request->get('discord'))
                ->setGoodreads($request->get('goodreads'));
            if ($user->save() && $user->profile->save()) {
                return redirect()->back();
            }

            throw new ModelUpdateException('An error occurred performing your request.');
        } catch (AuthorizationException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        } catch
        (ModelUpdateException $e) {
            return Inertia::render('Error/500', ['message' => $e->getMessage()]);
        }
    }
}
