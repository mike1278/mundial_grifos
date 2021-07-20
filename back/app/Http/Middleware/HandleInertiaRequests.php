<?php

namespace App\Http\Middleware;

use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Models\Currency;
use Illuminate\Http\Request;
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
    public function version(Request $request)
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
        return array_merge(parent::share($request), [
            'appName' => config('app.name'),
            'url' => [
                'basic' => config('app.url').'/storage/',
                'small' => config('app.url').'/image/square-small/',
                'medium' => config('app.url').'/image/square-medium/',
                'large' => config('app.url').'/image/square-large/',
            ],
            'auth.user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,
            'permissions' => function() use ($request) {
                return $request->user()
                    ? PermissionResource::collection($request->user()->allPermissions())
                    : [];
            },
            'roles' => function() use ($request) {
                return $request->user()
                    ? RoleResource::collection($request->user()->roles()->get())
                    : [];
            },
            'bs' => function() use ($request) {
                $currency = Currency::where('symbol','BS')->with('rate')->first();
                return $currency->rate->rate;
            },
        ]);
    }
}
