<?php

namespace App\ValueObjects;

final class SuccessfulRateMapper
{
    /**
     * TODO : generate programmatically.
     *
     */
    private const MAP = [
        7 => [
            0 => 0.70,
            1 => 0.73,
        ],
        8 => [
            0 => 0.60,
        ],
        9 => [
            0 => 0.50,
        ],
        10 => [

        ],
        11 => [

        ],
        12 => [

        ],
        13 => [

        ],
        14 => [

        ],
        15 => [

        ],
        16 => [

        ],
        17 => [

        ],
        18 => [

        ],
        19 => [

        ],
        20 => [

        ],
    ];

    /**
     * @var EnhancementLevel
     */
    public readonly EnhancementLevel $level;

    /**
     * @var FailStack
     */
    public readonly FailStack $stack;

    /**
     * __construct
     *
     * @param  Equipment $equipment
     * @return void
     */
    public function __construct(Equipment $equipment, FailStack $stack)
    {
        $this->level = $equipment->currentLevel;
        $this->stack = $stack;
    }

    /**
     * getRate
     *
     * @return float
     */
    public function getRate(): float
    {
        if ($this->level->level >= Equipment::THRESHOLD) {
            return self::MAP[$this->level->level][$this->stack->stack];
        }

        return SuccessfulRate::MAXIMUM;
    }
}
