<?php

namespace PayU;

use PayU\Exceptions\InvalidResponseException;
use PayU\Exceptions\UnauthorizedAccessException;
use PayU\Exceptions\UnexpectedResponseException;
use PHPUnit_Framework_TestCase;

require_once __DIR__ . '/../../vendor/autoload.php';


class ResponseBuilderTest extends PHPUnit_Framework_TestCase
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

        $this->assertEquals($response, (new ResponseBuilder())->build($rawBody));
    }

    public function testInvalidJson()
    {
        $rawBody = '';

        $this->setExpectedException(InvalidResponseException::class);

        (new ResponseBuilder())->build($rawBody);
    }

    public function testMissingMeta()
    {
        $rawBody = '{}';

        $this->setExpectedException(InvalidResponseException::class);

        (new ResponseBuilder())->build($rawBody);
    }

    public function testUnauthorized()
    {
        $rawBody = '{"meta":{"code":401,"message":"success"},"cardInfo":{}}';

        $this->setExpectedException(UnauthorizedAccessException::class);

        (new ResponseBuilder())->build($rawBody);
    }

    public function testUnexpectedResponse()
    {
        $rawBody = '{"meta":{"code":500,"message":"success"},"cardInfo":{}}';

        $this->setExpectedException(UnexpectedResponseException::class);

        (new ResponseBuilder())->build($rawBody);
    }
}