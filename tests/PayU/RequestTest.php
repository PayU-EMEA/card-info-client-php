<?php

namespace PayU;

use PHPUnit_Framework_TestCase;

require_once __DIR__ . '/../../vendor/autoload.php';


class RequestTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function testNothingSet()
    {
        $request = new Request();

        $this->assertEmpty($request->getRequestParams());
    }

    public function testMerchant()
    {
        $merchant = new Merchant('MERCHANT_CODE', 'SECRET');

        $request = new Request();
        $request->setMerchant($merchant);

        $requestParams = $request->getRequestParams();

        $this->assertEquals('MERCHANT_CODE', $requestParams['merchant']);
    }

    public function testCardToken()
    {
        $token = new CardToken('token');

        $request = new Request();
        $request->setCardToken($token);

        $requestParams = $request->getRequestParams();

        $this->assertEquals('token', $requestParams['token']);
    }

    public function testCard()
    {
        $card = new Card('number', 'month', 'year', 'cvv', 'name');

        $request = new Request();
        $request->setCard($card);

        $requestParams = $request->getRequestParams();

        $this->assertEquals('cvv', $requestParams['cc_cvv']);
        $this->assertEquals('number', $requestParams['cc_number']);
        $this->assertEquals('name', $requestParams['cc_owner']);
        $this->assertEquals('month', $requestParams['exp_month']);
        $this->assertEquals('year', $requestParams['exp_year']);
    }

    public function testHashAndDatetime()
    {
        $request = new Request();
        $request->setDatetime("date");
        $request->setOrderHash("hash");

        $requestParams = $request->getRequestParams();

        $this->assertEquals('hash', $requestParams['signature']);
        $this->assertEquals('date', $requestParams['dateTime']);
    }
}