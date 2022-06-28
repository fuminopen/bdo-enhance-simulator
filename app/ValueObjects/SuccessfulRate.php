<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class SuccessfulRate
{
    public const MINIMUM = 0.01;

    public const MAXIMUM = 100.00;

    /**
     * @var float
     */
    public readonly float $percent;

    /**
     * @var float
     */
    public readonly float $rate;

    /**
     * __construct
     *
     * @param  float $percent Specify successful rate between 0.01 to 100.00
     * @return void
     */
    public function __construct(float $percent)
    {
        if ($this->assertInvalidRate($percent)) {
            throw new InvalidArgumentException('Given rate is invalid. Specify successful rate between 0.01 to 100.00.');
        }

        $this->percent = $this->formatPercent($percent);
        $this->rate = $this->formatRate($percent);
    }

    /**
     * formatPercent
     *
     * @param  float $percent
     * @return float
     */
    private function formatPercent(float $percent): float
    {
        return round($percent, 2);
    }

    /**
     * formatRate
     *
     * @param  float $percent
     * @return float
     */
    private function formatRate(int $percent): float
    {
        return round(
            ($percent / 100),
            4
        );
    }

    /**
     * assertInvalidRate
     *
     * @param  float $percent
     * @return bool
     */
    private function assertInvalidRate(float $percent): bool
    {
        return ($percent > self::MAXIMUM) || ($percent < self::MINIMUM);
    }
}