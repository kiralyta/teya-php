<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Exceptions\TeyaClientException;
use Kiralyta\TeyaPhp\Responses\AuthResponse;
use Kiralyta\TeyaPhp\TeyaClient;

class AuthTest extends TestCase
{
    public function test_authentication(): void
    {
        $this->assertInstanceOf(AuthResponse::class, $this->auth());
    }

    public function test_token(): void
    {
        $authResponse = $this->auth();

        $this->expectException(TeyaClientException::class);

        (new TeyaClient())
            ->token(
                clientId:     $this->clientId,
                clientSecret: $this->clientSecret,
                deviceCode:   $authResponse->deviceCode
            );
    }
}
