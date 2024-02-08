<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Exceptions\TeyaClientException;
use Kiralyta\TeyaPhp\Teya;
use Kiralyta\TeyaPhp\TeyaClient;

class StoreTest extends TestCase
{
    public function test_list_store(): void
    {
        // $this->expectException(TeyaClientException::class);

        $stores = Teya::message(
            new TeyaClient(testing: true),
            $this->accessToken
        )->stores();

        $this->assertIsArray($stores);

        dump($stores);
    }
}
