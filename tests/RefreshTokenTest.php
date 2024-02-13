<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Responses\TokenResponse;
use Kiralyta\TeyaPhp\TeyaClient;

class RefreshTokenTest extends TestCase
{
    public function test_refresh_token(): void
    {
        $this->auth();

        $token = (new TeyaClient())
            ->token(
                clientId:     $_ENV['CLIENT_ID'],
                clientSecret: $_ENV['CLIENT_SECRET'],
                deviceCode:   $_ENV['DEVICE_CODE'],
                refreshToken: $_ENV['REFRESH_TOKEN']
            );

        $this->assertInstanceOf(TokenResponse::class, $token);

        dump($token);
    }
}
