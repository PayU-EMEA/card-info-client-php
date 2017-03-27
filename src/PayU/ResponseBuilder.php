<?php

namespace PayU;

use PayU\Exceptions\InvalidResponseException;
use PayU\Exceptions\UnauthorizedAccessException;
use PayU\Exceptions\UnexpectedResponseException;

/**
 * Class ResponseBuilder
 * @package PayU
 */
class ResponseBuilder
{

    /**
     * ResponseBuilder constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * @param string $responseBody
     * @return Response
     * @throws InvalidResponseException
     * @throws UnauthorizedAccessException
     * @throws UnexpectedResponseException
     */
    public function build($responseBody)
    {

        $formatted = json_decode($responseBody, true);
        if (is_null($formatted)) {
            throw new InvalidResponseException("Can't decode response");
        }

        if (!isset($formatted['meta'])) {
            throw new InvalidResponseException("Incomplete response");
        }

        if ($formatted['meta']['code'] == 401) {
            throw new UnauthorizedAccessException($formatted['meta']['message']);
        }

        if ($formatted['meta']['code'] != 200) {
            throw new UnexpectedResponseException($formatted['meta']['message']);
        }

        $response = new Response();
        $response->setRawBody($responseBody);
        $response->setMeta($formatted['meta']);
        $response->setInfo($formatted['cardInfo']);

        return $response;
    }
}