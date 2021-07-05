<?php

namespace App\Actions;

use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use Lorisleiva\Actions\Concerns\AsAction;
use Nyholm\Psr7\Factory\Psr17Factory;
use Illuminate\Http\Request;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class GenerateSession
{
    use AsAction;

    public $server, $repository;

    public function __construct(ResourceServer $server, TokenRepository $repository)
    {
        $this->server = $server;
        $this->repository = $repository;
    }

    public function asController(Request $request, $token): RedirectResponse
    {
        $request->headers->set('Authorization', $token);
        $psr = (new PsrHttpFactory(
            new Psr17Factory,
            new Psr17Factory,
            new Psr17Factory,
            new Psr17Factory
        ))->createRequest($request);
        try {
            $server = $this->server->validateAuthenticatedRequest($psr);
        } catch (OAuthServerException $e) {
            abort(401);
        }
        $userId = $server->getAttribute('oauth_user_id');
        $user = User::whereId($userId)->firstOrFail();
        if(!$user->hasRole(['root','admin'])){
            abort(401);
        }
        Auth::loginUsingId($userId);
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }
}
