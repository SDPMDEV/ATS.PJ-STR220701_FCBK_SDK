<?php

namespace Meta\FacebookSDK\Exception;

use Exception;
use Throwable;

class FacebookException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
<<<<<<< HEAD
=======

    public function getJsonException()
    {
        return json_decode($this->getMessage());
    }
>>>>>>> e1cb8eb577f7b7c7a369c49014d22310c1f17071
}