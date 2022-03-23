<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\Profile\UpdateRequest;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function update(UpdateRequest $request)
    {
        $profile = Profile::whereUserId(auth()->id())->first();
        $profile->bio = $request->get('bio');
        $profile->twitter = $request->get('twitter');
        $profile->goodreads = $request->get('goodreads');
        $profile->discord = $request->get('discord');

        if($profile->save()) {
            return Redirect::back();
        }
    }
}
