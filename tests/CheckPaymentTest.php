<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Teya;
use Kiralyta\TeyaPhp\TeyaClient;

class CheckPaymentTest extends TestCase
{
    public function test_check_payment(): void
    {
        // $this->expectException(TeyaClientException::class);

        $payment = Teya::message(
            new TeyaClient(testing: true),
            $_ENV['ACCESS_TOKEN']
        )->checkPayment(
            paymentRequestId: $_ENV['PAYMENT_REQUEST_ID'],
        );

        $this->assertIsArray($payment);

        dump($payment);
    }
}
