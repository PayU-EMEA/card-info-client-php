<?php

namespace PayU;

use PHPUnit_Framework_TestCase;

require_once __DIR__ . '/../../vendor/autoload.php';


class CardInfoClientTest extends PHPUnit_Framework_TestCase
{

    /** @var Request */
    private $requestMock;

    /** @var ParametersSignatureCalculator */
    private $signatureCalculatorMock;

    /** @var HTTPClient */
    private $httpClientMock;

    /** @var DateTimeProvider */
    private $datetimeProviderMock;

    /** @var CardInfoClient */
    private $cardInfoClient;

    /** @var ResponseBuilder */
    private $responseBuilderMock;

    private $successResponseBody = '{"meta":{"code":200,"message":"success"},"cardInfo":{"cardMask":"4111111111111111","binNumber":"411111","cardBrand":"VISA","issuerBank":"BRD Groupe Societe Generale","issuerCountry":"Romania","cardType":"DEBIT","cardProgram":"","installmentOptions":[],"loyaltyPoints":[]}}';

    public function setUp()
    {

        $this->signatureCalculatorMock = $this->getMock(ParametersSignatureCalculator::class);
        $this->signatureCalculatorMock->method('calculateSignature')->willReturn('CALCULATED_SIGNATURE');

        $this->datetimeProviderMock = $this->getMock(DateTimeProvider::class);
        $this->datetimeProviderMock->method('getDatetime')->willReturn('999999');

        $this->responseBuilderMock = $this->getMock(ResponseBuilder::class);
        $this->responseBuilderMock->method('build')->willReturn($this->getResponseObject());

        $this->requestMock = $this->getMock(Request::class);
        $this->requestMock->method('getRequestParams')->willReturn([]);

        $this->httpClientMock = $this->getMock(HTTPClient::class);
        $this->httpClientMock->method('post')->willReturn($this->successResponseBody);

        $this->cardInfoClient = new CardInfoClient(
            $this->httpClientMock,
            $this->signatureCalculatorMock,
            $this->requestMock,
            $this->datetimeProviderMock,
            $this->responseBuilderMock
        );
    }

    public function testGetInfoByCard() {

        $response = $this->cardInfoClient->getInfoByCard(
            new Merchant('DUMMY_MERC_CODE', 'DUMMY_SECRET_KEY'),
            new Card('4111111111111111', '12', '2019', '123', 'Owner'),
            'http://TEST_URL'
        );

        $this->assertEquals($response, $this->getResponseObject());
    }

    public function testGetInfoByToken() {

        $response = $this->cardInfoClient->getInfoByToken(
            new Merchant('DUMMY_MERC_CODE', 'DUMMY_SECRET_KEY'),
            new CardToken('DUMMY_TOKEN'),
            'http://TEST_URL'
        );

        $this->assertEquals($response, $this->getResponseObject());
    }

    /**
     * @return Response
     */
    private function getResponseObject() {
        return (new ResponseBuilder())->build($this->successResponseBody);
    }
}