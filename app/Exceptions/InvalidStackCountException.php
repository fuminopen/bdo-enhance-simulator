<?php

namespace App\Exceptions;

use Exception;

final class InvalidStackCountException extends Exception
{
    public function __construct()
    {
        parent::__construct('Fail stack must be natural integer including zero.');
    }
}
