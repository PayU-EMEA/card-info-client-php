<?php

namespace PayU;

use PHPUnit_Framework_TestCase;

require_once __DIR__ . '/../../vendor/autoload.php';


class ResponseTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function testSuccess()
    {
        $rawBody = '{"meta":{"code":200,"message":"success"},"cardInfo":{"cardMask":"4111111111111111","binNumber":"411111","cardBrand":"VISA","issuerBank":"BRD Groupe Societe Generale","issuerCountry":"Romania","cardType":"DEBIT","cardProgram":"","installmentOptions":[],"loyaltyPoints":[]}}';
        $json = json_decode($rawBody, true);
        $response = new Response();
        $response->setRawBody($rawBody);
        $response->setMeta($json['meta']);
        $response->setInfo($json['cardInfo']);

        $this->assertEquals($rawBody, $response->getRawBody());
        $this->assertEquals($json['meta'], $response->getMeta());
        $this->assertEquals($json['cardInfo'], $response->getInfo());
    }
}