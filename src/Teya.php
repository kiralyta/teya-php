<?php

namespace Kiralyta\TeyaPhp;

class Teya
{
    public function __construct(
        protected TeyaClient $client,
        protected string     $accessToken
    )  {}

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
            uri:         '/pos-link/v1/stores',
            accessToken: $this->accessToken,
            method:      'get'
        );
    }

    public function terminals(string $storeId): array
    {
        return $this->client->message(
            json:        [],
            uri:         "/pos-link/v1/stores/{$storeId}/terminals",
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
    ): array
    {
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
            uri:         "/pos-link/v1/payment-requests",
            accessToken: $this->accessToken,
            method:      'post'
        );
    }

    public function checkPayment(string $paymentRequestId): array
    {
        return $this->client->message(
            json:        [],
            uri:         "/pos-link/v1/payment-requests/{$paymentRequestId}",
            accessToken: $this->accessToken,
            method:      'get'
        );
    }

    public function cancelPayment(string $paymentRequestId): array
    {
        return $this->client->message(
            json:        ['status' => 'CANCELLED'],
            uri:         "/pos-link/v1/payment-requests/{$paymentRequestId}",
            accessToken: $this->accessToken,
            method:      'patch'
        );
    }
}
