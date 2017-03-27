<?php

namespace PayU;

use PHPUnit_Framework_TestCase;

require_once __DIR__ . '/../../vendor/autoload.php';


class MerchantTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function testSuccess()
    {
        $merchant = new Merchant('code', 'secret');

        $this->assertEquals('code', $merchant->getMerchantCode());
        $this->assertEquals('secret', $merchant->getSecretKey());
    }
}