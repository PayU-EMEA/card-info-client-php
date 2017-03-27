<?php

namespace PayU;

/**
 * Class Token
 * @package PayU
 */
class CardToken
{
    /** @var string */
    private $token;

    /**
     * Token constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}