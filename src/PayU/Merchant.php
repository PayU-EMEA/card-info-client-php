<?php

namespace PayU;

class Merchant
{
    /** @var string */
    private $merchantCode;

    /** @var string */
    private $secretKey;

    /**
     * Merchant constructor.
     * @param $merchantCode
     * @param $secretKey
     */
    public function __construct($merchantCode, $secretKey)
    {
        $this->merchantCode = $merchantCode;
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getMerchantCode()
    {
        return $this->merchantCode;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }
}