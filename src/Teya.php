<?php

namespace Kiralyta\TeyaPhp;

class Teya
{
    public function __construct(
        protected TeyaClient $client,
        protected string     $accessToken
    ) {
    }

    public static function message(TeyaClient $client, string $accessToken): Teya
    {
        return new static(
            client:      $client,
            accessToken: $accessToken
        );
    }

    public function stores(): array
    {
        return $this->client->message(
            json:        [],
            uri:         '/poslink/v1/stores',
            accessToken: $this->accessToken,
            method:      'get'
        );
    }

    public function terminals(string $storeId): array
    {
        return $this->client->message(
            json:        [],
            uri:         "/poslink/v2/stores/{$storeId}/terminals",
            accessToken: $this->accessToken,
            method:      'get'
        );
    }

    public function payment(
        string $storeId,
        string $terminalId,
        int    $amount,
        int    $tip = 0,
        string $currency = 'HUF'
    ): array {
        $json = [
            'requested_amount' => [
                'amount'   => $amount,
                'currency' => $currency,
                'tip'      => $tip,
            ],
            'store_id'         => $storeId,
            'terminal_id'      => $terminalId,
            'transaction_type' => 'SALE',
        ];

        return $this->client->message(
            json:        $json,
            uri:         "/poslink/v1/payment-requests",
            accessToken: $this->accessToken,
            method:      'post'
        );
    }

    public function checkPayment(string $paymentRequestId): array
    {
        return $this->client->message(
            json:        [],
            uri:         "/poslink/v1/payment-requests/{$paymentRequestId}",
            accessToken: $this->accessToken,
            method:      'get'
        );
    }

    public function cancelPayment(string $paymentRequestId): array
    {
        return $this->client->message(
            json:        ['status' => 'CANCELLING'],
            uri:         "/poslink/v2/payment-requests/{$paymentRequestId}",
            accessToken: $this->accessToken,
            method:      'patch'
        );
    }

    /**
     * Refunds a successful payment, without the card being needed on the terminal.
     *
     * The payment is identified by the gateway_payment_id of its payment request (tr_...), and the amount can not be
     * more than what the payment took. V2 endpoint (v1 was removed): the gateway_payment_id goes in `transaction_id`.
     */
    public function refund(string $gatewayPaymentId, int $amount): array
    {
        $json = [
            'amount'         => $amount,
            'transaction_id' => $gatewayPaymentId,
        ];

        return $this->client->message(
            json:        $json,
            uri:         '/poslink/v2/refunds',
            accessToken: $this->accessToken,
            method:      'post'
        );
    }
}
