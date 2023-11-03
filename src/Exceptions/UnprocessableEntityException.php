<?php

namespace Musti\ForgeApi\Exceptions;

use Exception;

class UnprocessableEntityException extends Exception
{
    public function __construct($message = 'Missing or invalid parameters.', $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

