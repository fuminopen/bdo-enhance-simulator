<?php

namespace App\Exceptions;

use Exception;

final class NoLongerEnhanceableException extends Exception
{
    public function __construct()
    {
        parent::__construct('Max level equipments cannot be enhanced.');
    }
}
