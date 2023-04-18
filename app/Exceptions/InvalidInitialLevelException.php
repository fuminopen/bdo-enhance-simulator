<?php

namespace App\Exceptions;

use Exception;

final class InvalidInitialLevelException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid enhancement level is given.');
    }
}
