<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Responses\AuthResponse;
use Kiralyta\TeyaPhp\TeyaClient;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends FrameworkTestCase
{
    protected string $clientId;
    protected string $clientSecret;

    protected string $deviceCode = '14dbdd85-c7a6-4106-bd50-3aad48cf4be3';
    protected string $accessToken = '_0XBPWQQ_13d6e9b9-2b5a-4b0e-88dc-cb18ab9d464c';
    protected string $refreshToken = '_1XBPWQQ_58b34701-437b-4bc9-a68d-a72cf51d3b14';
    protected string $storeId = '990815ca-44a8-46c2-a2ab-b1026236f99c';
    protected string $terminalId = '83bbd27d';
    protected string $paymentRequestId = '7c1a50f9-2476-4031-8e20-8228c09af90f';

    protected function auth(): AuthResponse
    {
        return (new TeyaClient(testing: true))
            ->auth(
                $this->clientId = trim(file_get_contents(__DIR__.'/client_id.test')),
                $this->clientSecret = trim(file_get_contents(__DIR__.'/client_secret.test'))
            );
    }
}
