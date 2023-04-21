<?php

namespace App\Exceptions;

use Exception;

final class InvalidRateException extends Exception
{
    public function __construct()
    {
        parent::__construct('Given rate is invalid. Specify successful rate between 0.01 to 100.00.');
    }
}
