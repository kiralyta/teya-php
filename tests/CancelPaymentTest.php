<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Exceptions\TeyaClientException;
use Kiralyta\TeyaPhp\Teya;
use Kiralyta\TeyaPhp\TeyaClient;

class CancelPaymentTest extends TestCase
{
    public function test_cancel_payment(): void
    {
        // $this->expectException(TeyaClientException::class);

        $payment = Teya::message(
            new TeyaClient(testing: true),
            $_ENV['ACCESS_TOKEN']
        )->cancelPayment(
            paymentRequestId: $_ENV['PAYMENT_REQUEST_ID'],
        );

        $this->assertIsArray($payment);

        dump($payment);
    }
}
