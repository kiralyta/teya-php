<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Exceptions\TeyaClientException;
use Kiralyta\TeyaPhp\Responses\AuthResponse;
use Kiralyta\TeyaPhp\Responses\TokenResponse;
use Kiralyta\TeyaPhp\TeyaClient;

class RefreshTokenTest extends TestCase
{
    public function test_refresh_token(): void
    {
        $this->auth();

        $token = (new TeyaClient())
            ->token(
                clientId:     $this->clientId,
                clientSecret: $this->clientSecret,
                deviceCode:   $this->deviceCode,
                refreshToken: $this->refreshToken
            );

        $this->assertInstanceOf(TokenResponse::class, $token);

        dump($token);
    }
}
