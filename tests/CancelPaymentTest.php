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
            $this->accessToken
        )->cancelPayment(
            paymentRequestId: $this->paymentRequestId,
        );

        $this->assertIsArray($payment);
    }
}
