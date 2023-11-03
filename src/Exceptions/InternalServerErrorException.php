<?php

namespace Musti\ForgeApi\Exceptions;

use Exception;

class InternalServerErrorException extends Exception
{
    public function __construct($message = 'Internal server error.', $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

