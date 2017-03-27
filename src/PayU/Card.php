<?php

namespace PayU;

class Card
{


    /** @var string */
    private $cardNumber;

    /** @var int */
    private $cardExpirationMonth;

    /** @var int */
    private $cardExpirationYear;

    /** @var int */
    private $cardCVV;

    /** @var string */
    private $cardOwnerName;

    /**
     * Card constructor.
     * @param string $cardNumber
     * @param int $cardExpirationMonth
     * @param int $cardExpirationYear
     * @param int $cardCVV
     * @param string $cardOwnerName
     */
    public function __construct($cardNumber, $cardExpirationMonth, $cardExpirationYear, $cardCVV, $cardOwnerName)
    {
        $this->cardNumber = $cardNumber;
        $this->cardExpirationMonth = $cardExpirationMonth;
        $this->cardExpirationYear = $cardExpirationYear;
        $this->cardCVV = $cardCVV;
        $this->cardOwnerName = $cardOwnerName;
    }

    /**
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @return int
     */
    public function getExpirationMonth()
    {
        return $this->cardExpirationMonth;
    }

    /**
     * @return int
     */
    public function getExpirationYear()
    {
        return $this->cardExpirationYear;
    }

    /**
     * @return int
     */
    public function getCVV()
    {
        return $this->cardCVV;
    }

    /**
     * @return string
     */
    public function getOwnerName()
    {
        return $this->cardOwnerName;
    }
}