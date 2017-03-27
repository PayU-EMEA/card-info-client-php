<?php

namespace PayU;

use PayU\Exceptions\ConnectionException;
use PayU\Exceptions\InvalidResponseException;
use PayU\Exceptions\UnauthorizedAccessException;
use PayU\Exceptions\UnexpectedResponseException;

/**
 * Class CardInfoClient
 * @package PayU
 */
class CardInfoClient
{

    /** @var HTTPClient */
    private $httpClient;

    /** @var ParametersSignatureCalculator */
    private $signatureCalculator;

    /** @var Request */
    private $request;

    /** @var DateTimeProvider */
    private $dateTimeProvider;

    /** @var Response */
    private $responseBuilder;

    /**
     * CardInfoClient constructor.
     * @param HTTPClient $httpClient
     * @param ParametersSignatureCalculator $signatureCalculator
     * @param Request $request
     * @param DateTimeProvider $dateTimeProvider
     * @param ResponseBuilder $responseBuilder
     */
    public function __construct(HTTPClient $httpClient, ParametersSignatureCalculator $signatureCalculator, Request $request, DateTimeProvider $dateTimeProvider, ResponseBuilder $responseBuilder)
    {
        $this->httpClient = $httpClient;
        $this->signatureCalculator = $signatureCalculator;
        $this->request = $request;
        $this->dateTimeProvider = $dateTimeProvider;
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * @param Merchant $merchant
     * @param Card $card
     * @param string $url
     * @param string $extraInfo
     * @return Response
     * @throws ConnectionException
     * @throws InvalidResponseException
     * @throws UnauthorizedAccessException
     * @throws UnexpectedResponseException
     */
    public function getInfoByCard(Merchant $merchant, Card $card, $url, $extraInfo = '')
    {

        $this->request->setMerchant($merchant);
        $this->request->setCard($card);
        $this->request->setExtraInfo($extraInfo);
        $this->request->setDatetime($this->dateTimeProvider->getDatetime());

        $orderHash = $this->signatureCalculator->calculateSignature(
            ParametersSignatureCalculator::HASHING_ALGORITHM_SHA256,
            $merchant->getSecretKey(),
            $this->request->getRequestParams()
        );
        $this->request->setOrderHash($orderHash);

        return $this->getResponse($url, $this->request->getRequestParams());
    }

    /**
     * @param Merchant $merchant
     * @param CardToken $card
     * @param $url
     * @return Response
     * @throws ConnectionException
     * @throws InvalidResponseException
     * @throws UnauthorizedAccessException
     * @throws UnexpectedResponseException
     */
    public function getInfoByToken(Merchant $merchant, CardToken $token, $url, $extraInfo = '')
    {
        $this->request->setCardToken($token);
        $this->request->setExtraInfo($extraInfo);

        $this->prepareRequest($merchant);

        return $this->getResponse($url, $this->request->getRequestParams());
    }

    /**
     * @param Merchant $merchant
     */
    private function prepareRequest(Merchant $merchant) {

        $this->request->setMerchant($merchant);

        $this->request->setDatetime($this->dateTimeProvider->getDatetime());

        $orderHash = $this->signatureCalculator->calculateSignature(
            ParametersSignatureCalculator::HASHING_ALGORITHM_SHA256,
            $merchant->getSecretKey(),
            $this->request->getRequestParams()
        );

        $this->request->setOrderHash($orderHash);
    }

    /**
     * @param $url
     * @param $postParams
     * @return Response
     * @throws ConnectionException
     * @throws InvalidResponseException
     * @throws UnauthorizedAccessException
     * @throws UnexpectedResponseException
     */
    private function getResponse($url, $postParams)
    {
        try {
            $this->httpClient->skipSSLVerifyPeer();
            $response = $this->httpClient->post($url, $postParams);
        } catch (ConnectionException $exception) {
            throw $exception;
        }

        return $this->responseBuilder->build($response);
    }
}