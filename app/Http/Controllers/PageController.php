<?php

namespace App\Http\Controllers;

use App\Exceptions\PageNotFoundException;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PageController extends Controller
{
    public function __invoke(Page $page): Response
    {
        try {
            if ($page->count() === 0) {
                throw new PageNotFoundException(
                    'The requested page could not be found',
                );
            }
            return Inertia::render('Page', compact('page'));
        } catch(PageNotFoundException $e) {
            return Inertia::render('Error/404', ['message' => $e->getMessage()]);
        }
    }
}
