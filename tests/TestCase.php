<?php

namespace Kiralyta\TeyaPhp\Tests;

use Dotenv\Dotenv;
use Kiralyta\TeyaPhp\Responses\AuthResponse;
use Kiralyta\TeyaPhp\TeyaClient;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends FrameworkTestCase
{
    protected string $clientId;
    protected string $clientSecret;

    public function setUp(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        parent::setUp();
    }

    protected function auth(): AuthResponse
    {
        return (new TeyaClient(testing: true))
            ->auth(
                $this->clientId = $_ENV['CLIENT_ID'],
                $this->clientSecret = $_ENV['CLIENT_SECRET']
            );
    }
}
