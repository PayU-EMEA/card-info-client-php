<?php

namespace PayU;

use PHPUnit_Framework_TestCase;

require_once __DIR__ . '/../../vendor/autoload.php';


class CardTokenTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function testCardSuccess()
    {
        $cardToken = new CardToken('TEST_TOKEN');

        $this->assertEquals('TEST_TOKEN', $cardToken->getToken());
    }
}