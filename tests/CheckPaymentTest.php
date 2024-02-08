<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Exceptions\TeyaClientException;
use Kiralyta\TeyaPhp\Teya;
use Kiralyta\TeyaPhp\TeyaClient;

class CheckPaymentTest extends TestCase
{
    public function test_check_payment(): void
    {
        // $this->expectException(TeyaClientException::class);

        $payment = Teya::message(
            new TeyaClient(testing: true),
            $this->accessToken
        )->checkPayment(
            paymentRequestId: $this->paymentRequestId,
        );

        $this->assertIsArray($payment);

        dump($payment);
    }
}
