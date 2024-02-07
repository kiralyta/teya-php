<?php

namespace Kiralyta\TeyaPhp\Responses;

class TokenResponse
{
    public function __construct(
        public readonly string $accessToken,
        public readonly string $refreshToken,
        public readonly int    $expiresIn
    ) {}
}
