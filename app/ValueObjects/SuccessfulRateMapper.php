<?php

namespace App\ValueObjects;

final class SuccessfulRateMapper
{
    /**
     * TODO : generate programmatically.
     *
     */
    public const MAP = [
        9 => [
            'base' => 0.2041,
            'interval' => 0.0204,
            'dropped_interval' => 0.0040,
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
        if ($this->level->level < Equipment::THRESHOLD) {
            return SuccessfulRate::MAXIMUM;
        }

        $base = self::MAP[$this->level->level]['base'];
        $interval = self::MAP[$this->level->level]['interval'];
        $droppedInterval = self::MAP[$this->level->level]['dropped_interval'];

        // stack starts from 1 because no rate needs to be added for stack 0
        for ($stack = 1; $stack <= $this->stack->stack; $stack++) {
            // if base surpasses the soft cap, dropped interval is applied
            $base += ($base > 0.70) ? $droppedInterval : $interval;
        }

        return $base;
    }
}
