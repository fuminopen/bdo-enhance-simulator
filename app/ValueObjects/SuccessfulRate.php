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
    public readonly float $rate;

    /**
     * __construct
     *
     * @param  float $rate
     * @return void
     */
    public function __construct(float $rate)
    {
        if ($this->assertInvalidRate($rate)) {
            throw new InvalidArgumentException('Given rate is invalid.');
        }

        $this->rate = $this->formatRate($rate);
    }

    /**
     * formatRate
     *
     * @param  float $rate
     * @return float
     */
    private function formatRate(float $rate): float
    {
        return round($rate, 2);
    }

    /**
     * assertInvalidRate
     *
     * @param  float $rate
     * @return bool
     */
    private function assertInvalidRate(float $rate): bool
    {
        return ($rate > self::MAXIMUM) || ($rate < self::MINIMUM);
    }
}