<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/testData/TestData.php';

use PayU\Card;
use PayU\CardInfoClient;
use PayU\DateTimeProvider;
use PayU\HTTPClient;
use PayU\Merchant;
use PayU\ParametersSignatureCalculator;
use PayU\Request;
use PayU\ResponseBuilder;

// instantiate CardToken
$card = new Card(TestData::CARD_NUMBER, TestData::CARD_EXP_MONTH, TestData::CARD_EXP_YEAR, TestData::CARD_CVV, TestData::CARD_OWNER_NAME);

// instantiate Merchant
$merchant = new Merchant(TestData::MERCHANT_CODE, TestData::MERCHANT_SECRET_KEY);

// instantiate CardInfoClient
$cardInfoClient = new CardInfoClient(
    new HTTPClient(),
    new ParametersSignatureCalculator(),
    new Request(),
    new DateTimeProvider(),
    new ResponseBuilder()
);

try {
    $response = $cardInfoClient->getInfoByCard($merchant, $card, TestData::CARD_INFO_API_URL, 'true');

    echo "<b>Card info (success)</b>: <br/>";
    echo "======================================================= <br/>";
    var_dump($response->getInfo());

    echo "<b>Response meta</b>: <br/>";
    echo "======================================================= <br/>";
    var_dump($response->getMeta());

    echo "<b>Response raw body</b>: <br/>";
    echo "======================================================= <br/>";
    echo $response->getRawBody();

} catch(Exception $e) {
    /**
     * ConnectionException
     * InvalidResponseException
     * UnauthorizedAccessException
     * UnexpectedResponseException
     */
    echo "<b>There was an exception while getting card info</b>: <br/>";
    echo "======================================================= <br/>";
    echo $e->getMessage();
}

