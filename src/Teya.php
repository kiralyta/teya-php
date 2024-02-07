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
}
