<?php

namespace Musti\ForgeApi\Exceptions;

use Exception;

class InvalidAPIKeyException extends Exception
{
    public function __construct($message = 'The API key provided is invalid.', $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

