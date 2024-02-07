<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Responses\AuthResponse;
use Kiralyta\TeyaPhp\TeyaClient;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends FrameworkTestCase
{
    protected string $clientId;
    protected string $clientSecret;

    protected function auth(): AuthResponse
    {
        return (new TeyaClient(testing: true))
            ->auth(
                $this->clientId = trim(file_get_contents(__DIR__.'/client_id.test')),
                $this->clientSecret = trim(file_get_contents(__DIR__.'/client_secret.test'))
            );
    }
}
