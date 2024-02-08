<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Exceptions\TeyaClientException;
use Kiralyta\TeyaPhp\Teya;
use Kiralyta\TeyaPhp\TeyaClient;

class PaymentTest extends TestCase
{
    public function test_payment(): void
    {
        // $this->expectException(TeyaClientException::class);

        $payment = Teya::message(
            new TeyaClient(testing: true),
            $this->accessToken
        )->payment(
            storeId:    $this->storeId,
            terminalId: $this->terminalId,
            amount:     420,
        );

        $this->assertIsArray($payment);

        dump($payment);
    }
}
