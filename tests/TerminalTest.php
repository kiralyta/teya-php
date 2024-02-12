<?php

namespace Kiralyta\TeyaPhp\Tests;

use Kiralyta\TeyaPhp\Exceptions\TeyaClientException;
use Kiralyta\TeyaPhp\Teya;
use Kiralyta\TeyaPhp\TeyaClient;

class TerminalTest extends TestCase
{
    public function test_list_terminal(): void
    {
        // $this->expectException(TeyaClientException::class);

        $terminals = Teya::message(
            new TeyaClient(testing: true),
            $_ENV['ACCESS_TOKEN']
        )->terminals(
            $_ENV['STORE_ID']
        );

        $this->assertIsArray($terminals);

        dump($terminals);
    }
}
