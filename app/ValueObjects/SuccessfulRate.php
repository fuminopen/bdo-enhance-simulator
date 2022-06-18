<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class SuccessfulRate
{
    public const MINIMUM = 0.01;

    public const MAXIMUM = 1.00;

    /**
     * @var float
     */
    private float $rate;

    /**
     * __construct
     *
     * @param  mixed $rate
     * @return void
     */
    public function __construct(float $rate)
    {
        if ($this->assertInvalidRate($rate)) {
            throw new InvalidArgumentException('Given rate is invalid.');
        }

        $this->rate = $rate;
    }

    /**
     * assertInvalidRate
     *
     * @param  mixed $rate
     * @return bool
     */
    private function assertInvalidRate(float $rate): bool
    {
        return ($rate > self::MAXIMUM) || ($rate < self::MINIMUM);
    }
}