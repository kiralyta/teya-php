<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Responses\AuthResponse;
use Kiralyta\TeyaPhp\Responses\TokenResponse;
use Kiralyta\TeyaPhp\TeyaClient;

class AuthTest extends TestCase
{
    public function test_authentication(): void
    {
        $response = $this->auth();

        $this->assertInstanceOf(AuthResponse::class, $response);

        dump($response);
    }

    public function test_token(): void
    {
        $this->auth();

        $token = (new TeyaClient())
            ->token(
                clientId:     $this->clientId,
                clientSecret: $this->clientSecret,
                deviceCode:   $_ENV['DEVICE_CODE']
            );

        $this->assertInstanceOf(TokenResponse::class, $token);

        dump($token);
    }
}
