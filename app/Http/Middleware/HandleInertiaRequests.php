<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        if (auth()->check()) {
            $name = sprintf('%s_permissions', auth()->id());
            if(!cache($name)) {
                $permissions = [
                    'user.self.create' => Auth::user()->hasPermissionTo('user.self.create'),
                    'user.self.read' => Auth::user()->hasPermissionTo('user.self.read'),
                    'user.self.update' => Auth::user()->hasPermissionTo('user.self.update'),
                    'user.self.delete' => Auth::user()->hasPermissionTo('user.self.delete'),
                    'user.self.links' => Auth::user()->hasPermissionTo('user.self.links'),

                    'user.all.create' => Auth::user()->hasPermissionTo('user.all.create'),
                    'user.all.read' => Auth::user()->hasPermissionTo('user.all.read'),
                    'user.all.update' => Auth::user()->hasPermissionTo('user.all.update'),
                    'user.all.delete' => Auth::user()->hasPermissionTo('user.all.delete'),
                    'user.all.links' => Auth::user()->hasPermissionTo('user.all.links'),

                    'user.self.bio.create' => Auth::user()->hasPermissionTo('user.self.bio.create'),
                    'user.self.bio.read' => Auth::user()->hasPermissionTo('user.self.bio.read'),
                    'user.self.bio.update' => Auth::user()->hasPermissionTo('user.self.bio.update'),
                    'user.self.bio.delete' => Auth::user()->hasPermissionTo('user.self.bio.delete'),

                    'user.all.bio.create' => Auth::user()->hasPermissionTo('user.all.bio.create'),
                    'user.all.bio.read' => Auth::user()->hasPermissionTo('user.all.bio.read'),
                    'user.all.bio.update' => Auth::user()->hasPermissionTo('user.all.bio.update'),
                    'user.all.bio.delete' => Auth::user()->hasPermissionTo('user.all.bio.delete'),

                    'podcast.self.create' => Auth::user()->hasPermissionTo('podcast.self.create'),
                    'podcast.self.read' => Auth::user()->hasPermissionTo('podcast.self.read'),
                    'podcast.self.update' => Auth::user()->hasPermissionTo('podcast.self.update'),
                    'podcast.self.delete' => Auth::user()->hasPermissionTo('podcast.self.delete'),

                    'podcast.all.create' => Auth::user()->hasPermissionTo('podcast.all.create'),
                    'podcast.all.read' => Auth::user()->hasPermissionTo('podcast.all.read'),
                    'podcast.all.update' => Auth::user()->hasPermissionTo('podcast.all.update'),
                    'podcast.all.delete' => Auth::user()->hasPermissionTo('podcast.all.delete'),

                    'admin.settings' => Auth::user()->hasPermissionTo('admin.settings'),
                    'admin.view' => Auth::user()->hasPermissionTo('admin.view'),
                    'admin.update' => Auth::user()->hasPermissionTo('admin.update'),
                    'admin.sensitive' => Auth::user()->hasPermissionTo('admin.sensitive'),
                    'admin.horizon' => Auth::user()->hasPermissionTo('admin.horizon'),
                    'admin.logs' => Auth::user()->hasPermissionTo('admin.logs'),
                ];
                cache()->put($name, json_encode($permissions), Carbon::now()->addMinutes(5));
            }
        }
        return array_merge(parent::share($request), [
            'appName' => config('app.name'),
            'currentUrl' => request()->fullUrl(),
            'permissions' => cache()->has(sprintf('%s_permissions', auth()->id()))
                ? json_decode(cache(sprintf('%s_permissions', auth()->id())))
                : null,

        ]);
    }
}
