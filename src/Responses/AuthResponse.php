<?php

namespace Kiralyta\TeyaPhp\Responses;

class AuthResponse
{
    public function __construct(
        public readonly string $userCode,
        public readonly string $deviceCode,
        public readonly string $qrCode,
        public readonly string $verificationUrlComplete
    ) {}
}
