<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Teya;
use Kiralyta\TeyaPhp\TeyaClient;

class RefundTest extends TestCase
{
    public function test_refund(): void
    {
        $refund = Teya::message(
            new TeyaClient(testing: true),
            $_ENV['ACCESS_TOKEN']
        )->refund(
            gatewayPaymentId: $_ENV['GATEWAY_PAYMENT_ID'],
            amount:           (int) $_ENV['REFUND_AMOUNT'],
        );

        $this->assertIsArray($refund);

        dump($refund);
    }
}
