<?php

namespace PayU;

class DateTimeProvider
{

    /**
     * @return false|string
     */
    public function getDatetime()
    {
        return date("c", time());
    }
}