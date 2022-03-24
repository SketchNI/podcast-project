<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Episode\CreateRequest;
use App\Http\Requests\Admin\Episode\UpdateRequest;
use App\Models\Episode;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class EpisodeController extends Controller
{
    /**
     * List all episodes from latest to oldest.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $this->authorize('viewAny', auth()->user());

            $episodes = Episode::orderByDesc('id')->paginate(15);
            return Inertia::render('Admin/Episode/Index', compact('episodes'));
        } catch (AuthorizationException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Display a selected episode.
     *
     * @param Episode $episode
     * @return Response
     */
    public function show(Episode $episode)
    {
        try {
            $this->authorize('view', auth()->user());

            $episode = Episode::find($episode->id);
            return Inertia::render('Admin/Episode/Show', compact('episode'));
        } catch (AuthorizationException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Create a new episode.
     *
     * @param CreateRequest $request
     * @return RedirectResponse|Response
     */
    public function store(CreateRequest $request)
    {
        try {
            $this->authorize('create', auth()->user());

            $episode = new Episode;
            $episode
                ->setUuid()
                ->setTitle($request->get('title'))
                ->setDescription($request->get('description'))
                ->setStatus($request->get('status'));
            if ($request->get('status') === 'Published') {
                $episode->setPublishedAt(Carbon::now());
            }
            return redirect()->back();
        } catch (AuthorizationException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Update an episode.
     *
     * @param UpdateRequest $request
     * @param Episode $episode
     * @return RedirectResponse|Response
     */
    public function update(UpdateRequest $request, Episode $episode): RedirectResponse|Response
    {
        try {
            $this->authorize('update', auth()->user());

            $episode = Episode::find($episode->id);
            $episode
                ->setTitle($request->get('title'))
                ->setDescription($request->get('description'))
                ->setStatus($request->get('status'));
            if ($request->get('status') === 'Published') {
                $episode->setPublishedAt(Carbon::now());
            }
            return redirect()->back();
        } catch (AuthorizationException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove an episode.
     *
     * @param Episode $episode
     * @return RedirectResponse|Response
     */
    public function destroy(Episode $episode): RedirectResponse|Response
    {
        try {
            $this->authorize('delete', auth()->user());

            Episode::find($episode->id)->delete();
            return redirect()->route('admin.episodes.index');
        } catch (AuthorizationException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        }
    }
}
