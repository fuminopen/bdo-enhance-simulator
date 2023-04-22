<?php

namespace App\ValueObjects;

final class SuccessfulRatePattern
{
    private readonly EnhancementLevel $targetLevel;

    private readonly Rate $baseRate;

    private readonly Rate $interval;

    private readonly Rate $softCap;

    private readonly Rate $afterSoftCap;

    /**
     * @param  Rate $rate
     */
    public function __construct(
        EnhancementLevel $targetLevel,
        Rate $baseRate,
        Rate $interval,
        Rate $softCap,
        Rate $afterSoftCap,
    ) {
        $this->targetLevel = $targetLevel;
        $this->baseRate = $baseRate;
        $this->interval = $interval;
        $this->softCap = $softCap;
        $this->afterSoftCap = $afterSoftCap;
    }

    /**
     * getRate
     *
     * @return Rate
     */
    public function getRate(FailStack $failStack): Rate
    {
        $stackThreshold = new FailStack(
            (int) (
                ($this->softCap->getInPercent() - $this->baseRate->getInPercent())
                / $this->interval->getInPercent()
            )
        );

        // if simply adding interval * fail stack to base rate
        // doesn't go beyond threshold, then returns it
        if ($stackThreshold->gt($failStack)) {
            return $this->baseRate->add(
                $this->interval->times($failStack)
            );
        }

        $afterSoftCapStack = $failStack->sub($stackThreshold);

        $rate = $this->baseRate->add(
            $this->interval->times($stackThreshold)
        );

        return $rate->add(
            $this->afterSoftCap->times($afterSoftCapStack)
        );
    }
}
