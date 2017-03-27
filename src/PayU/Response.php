<?php

namespace PayU;

/**
 * Class Response
 * @package PayU
 */
class Response
{

    /** @var array[string]string */
    private $meta;

    /** @var array[string]string */
    private $info;

    /** @var string */
    private $rawBody;

    /**
     * Response constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param array $meta
     */
    public function setMeta(array $meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return array[string]string
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param array $info
     */
    public function setInfo(array $info)
    {
        $this->info = $info;
    }

    /**
     * @return array[string]string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return string
     */
    public function getRawBody()
    {
        return $this->rawBody;
    }

    /**
     * @param $body
     */
    public function setRawBody($body)
    {
        $this->rawBody = $body;
    }
}