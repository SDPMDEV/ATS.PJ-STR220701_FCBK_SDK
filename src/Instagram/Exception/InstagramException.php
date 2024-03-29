<?php

namespace Meta\InstagramSDK\Exception;

use Exception;
use Throwable;

class InstagramException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getJsonException()
    {
        return json_decode($this->getMessage());
    }
}