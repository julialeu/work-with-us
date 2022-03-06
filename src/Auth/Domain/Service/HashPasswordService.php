<?php

namespace WorkWithUs\Auth\Domain\Service;

use Illuminate\Support\Facades\Hash;

class HashPasswordService
{
    public function hash(string $rawPassword): string
    {
        return Hash::make($rawPassword);
    }
}
