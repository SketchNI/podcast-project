<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', ['auth' => auth()->check()]);
    }

    public function redirect(): RedirectResponse
    {
        return redirect()->route('home');
    }
}
