<?php

namespace App\Actions\Auth;

use Lorisleiva\Actions\Concerns\AsAction;
use Request;

class Logout
{
    use AsAction;

    public function handle($token)
    {
        $tokenRepository = app('Laravel\Passport\TokenRepository');
        $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');
        $tokenRepository->revokeAccessToken($token->id);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);
        return response([
            'message' => 'Se cerro la sesión',
        ], 201);
    }

    public function asController(Request $request)
    {
        return $this->handle($request->user()->token());
    }
}
