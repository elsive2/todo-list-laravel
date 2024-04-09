<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Response\AuthTokenResponse;

final class AuthService
{
    /**
     * @throws InvalidCredentialsException
     */
    public function login(string $email, string $password): AuthTokenResponse
    {
        $credentials = compact(['email', 'password']);

        /** @var string $token */
        if (! $token = auth()->attempt($credentials)) {
            throw new InvalidCredentialsException();
        }

        return $this->respondWithToken($token);
    }

    public function refresh(): AuthTokenResponse
    {
        $token = auth()->refresh();

        return $this->respondWithToken($token);
    }

    private function respondWithToken(string $token): AuthTokenResponse
    {
        return (new AuthTokenResponse())
            ->setAccessToken($token)
            ->setTokenType('bearer')
            ->setExpiresIn(auth()->factory()->getTTL());
    }
}
