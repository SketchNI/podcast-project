<?php

namespace App\Http\Controllers;

use App\Exceptions\ModelUpdateException;
use App\Models\Profile;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\Profile\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Update a users profile.
     *
     * @param UpdateRequest $request
     * @return RedirectResponse|Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $this->authorize('update', auth()->user());

            $profile = Profile::whereUserId(auth()->id())->first();
            $profile->setBio($request->get('bio'))
                ->setTwitter($request->get('twitter'))
                ->setDiscord($request->get('discord'))
                ->setGoodreads($request->get('goodreads'));
            if ($profile->save()) {
                return Redirect::back();
            }
            throw new ModelUpdateException('An error occurred trying to update your profile');
        } catch(AuthorizationException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        } catch(ModelUpdateException $e) {
            return Inertia::render('Error/500', ['message' => $e->getMessage()]);
        }
    }
}
