<?php

namespace App\ValueObjects;

use App\Exceptions\InvalidRateException;

final class Rate
{
    public const MINIMUM_PERCENT = 0.00;

    public const MAXIMUM_PERCENT = 100.00;

    public const MINIMUM_RATE = 0.0000;

    public const MAXIMUM_RATE = 1.0000;

    /**
     * @var float
     */
    private readonly float $percent;

    /**
     * @var float
     */
    private readonly float $rate;

    /**
     * __construct
     *
     * @param  float $percent Specify successful rate between 0.00 to 100.00
     * @return void
     */
    public function __construct(float $percent)
    {
        if ($this->assertInvalidRate($percent)) {
            throw new InvalidRateException();
        }

        $this->percent = $this->formatPercent($percent);
        $this->rate = $this->formatRate($percent);
    }

    /**
     * @return float
     */
    public function getInRate(): float
    {
        return $this->rate;
    }

    /**
     * @return float
     */
    public function getInPercent(): float
    {
        return $this->percent;
    }

    /**
     * addition
     *
     * @param  self $added
     * @return self
     */
    public function add(Rate $addend): self
    {
        // percent is 100.00 at maximum
        if ($this->percent + $addend->getInPercent() > self::MAXIMUM_PERCENT) {
            return new self(self::MAXIMUM_PERCENT);
        }

        return new self(
            $this->percent + $addend->getInPercent()
        );
    }

    /**
     * addition
     *
     * @param  FailStack
     * @return self
     */
    public function times(FailStack $failStack): self
    {
        // percent is 100.00 at maximum
        if ($this->percent * $failStack->getValue() > self::MAXIMUM_PERCENT) {
            return new self(self::MAXIMUM_PERCENT);
        }

        return new self(
            $this->percent * $failStack->getValue()
        );
    }

    /**************************
     *
     * private methods
     *
     **************************/

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
    private function formatRate(float $percent): float
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
        return ($percent > self::MAXIMUM_PERCENT) || ($percent < self::MINIMUM_PERCENT);
    }
}
