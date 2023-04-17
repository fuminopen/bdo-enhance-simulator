<?php

namespace App\ValueObjects\Traits;

trait GetIntValueTrait
{
    /**
     * get property of type int
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
