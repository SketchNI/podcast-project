<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $episodes = [];
        return Inertia::render('Episodes', ['episodes' => $episodes]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $uuid
     * @return Response
     */
    public function show(string $uuid): Response
    {
        //
    }
}
