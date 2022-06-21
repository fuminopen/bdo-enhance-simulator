<?php

namespace App\ValueObjects;

final class SuccessfulRateMapper
{
    /**
     * @var EnhancementLevel
     */
    public readonly EnhancementLevel $level;

    /**
     * __construct
     *
     * @param  Equipment $equipment
     * @return void
     */
    public function __construct(Equipment $equipment)
    {
        $this->level = $equipment->currentLevel;
    }

    /**
     * getRate
     *
     * @return float
     */
    public function getRate(): float
    {
        // TODO : should be vary along with level
        return SuccessfulRate::MAXIMUM;
    }
}
