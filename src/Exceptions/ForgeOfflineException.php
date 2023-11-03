<?php

namespace Musti\ForgeApi\Exceptions;

use Exception;

class ForgeOfflineException extends Exception
{
    public function __construct($message = 'Forge is offline for maintenance.', $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

