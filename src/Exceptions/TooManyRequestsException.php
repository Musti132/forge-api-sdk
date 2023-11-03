<?php

namespace Musti\ForgeApi\Exceptions;

use Exception;

class TooManyRequestsException extends Exception
{
    public function __construct($message = 'Too many requests.', $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

