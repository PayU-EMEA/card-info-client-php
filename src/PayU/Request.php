<?php

namespace PayU;

/**
 * Class Request
 * @package PayU
 */
class Request
{
    /** @var Card */
    private $card = null;

    /** @var CardToken */
    private $cardToken = null;

    /** @var Merchant */
    private $merchant = null;

    /** @var array */
    private $internalArray = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param Merchant $merchant
     */
    public function setMerchant(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * @param Card $card
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
        $this->cardToken = null; // invalidate token data
    }

    /**
     * @param CardToken $cardToken
     */
    public function setCardToken(CardToken $cardToken)
    {
        $this->cardToken = $cardToken;
        $this->card = null; // invalidate card data
    }

    /**
     * @return array
     */
    public function getRequestParams()
    {
        if (!is_null($this->card)) {
            $this->internalArray['cc_cvv'] = $this->card->getCVV();
            $this->internalArray['cc_number'] = $this->card->getCardNumber();
            $this->internalArray['cc_owner'] = $this->card->getOwnerName();
            $this->internalArray['exp_month'] = $this->card->getExpirationMonth();
            $this->internalArray['exp_year'] = $this->card->getExpirationYear();
        }
        if (is_null($this->card) && !is_null($this->cardToken)) {
            $this->internalArray['token'] = $this->cardToken->getToken();
        }
        if (!is_null($this->merchant)) {
            $this->internalArray['merchant'] = $this->merchant->getMerchantCode();
        }

        ksort($this->internalArray);

        return $this->internalArray;
    }

    /**
     * @param string $hash
     */
    public function setOrderHash($hash)
    {
        $this->internalArray['signature'] = $hash;
    }

    /**
     * @param string $datetime
     */
    public function setDatetime($datetime)
    {
        $this->internalArray['dateTime'] = $datetime;
    }

    /**
     * @param string $extrainfo
     */
    public function setExtraInfo($extrainfo)
    {
        if(!empty($extrainfo)) {
            $this->internalArray['extraInfo'] = $extrainfo;
        }
    }
}