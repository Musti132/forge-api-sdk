<?php

namespace Musti\ForgeApi\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function __construct($message = 'The requested resource could not be found.', $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

