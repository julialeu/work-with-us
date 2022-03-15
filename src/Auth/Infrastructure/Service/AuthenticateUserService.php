<?php

namespace WorkWithUs\Auth\Infrastructure\Service;

class AuthenticateUserService
{
    public function login(array $credentials): string
    {
        return auth()->attempt($credentials);
    }

    public function getTTl(): int
    {
        return auth()->factory()->getTTL();
    }
}
