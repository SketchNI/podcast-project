<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ForbiddenException;
use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function index(Request $request): Response
    {
        try {
            if ($request->user()->can('admin.view')) {
                $users = User::count();
                $pages = Page::count();
                $episodes = Episode::count();
                $listens = 0;
                return Inertia::render('Admin/Index',
                    compact('users', 'pages', 'episodes', 'listens')
                );
            }
            throw new ForbiddenException("You do not have permission to perform this action.");
        } catch (ForbiddenException $e) {
            return Inertia::render('Error/403', ['message' => $e->getMessage()]);
        }
    }
}
