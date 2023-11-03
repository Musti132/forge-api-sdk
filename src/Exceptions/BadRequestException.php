<?php

namespace Musti\ForgeApi\Exceptions;

use Exception;

class BadRequestException extends Exception
{
    public function __construct($message = 'Bad Request', $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

