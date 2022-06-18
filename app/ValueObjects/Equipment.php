<?php

namespace App\ValueObjects;

final class Equipment
{
    /**
     * @var EnhancementLevel
     */
    public readonly EnhancementLevel $currentLevel;

    /**
     * __construct
     *
     * @param  EnhancementLevel $currentLevel
     * @return void
     */
    public function __construct(
        EnhancementLevel $level =
            new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL)
    ) {
        $this->currentLevel = $level;
    }

    /**
     * enhance
     *
     * @return int
     */
    public function enhancementSucceed(): int
    {
        if (! $this->currentLevel->atMaximumLevel()) {
            $this->currentLevel = new EnhancementLevel($this->currentLevel->level + 1);
        }

        return $this->currentLevel->level;
    }

    /**
     * enhanceFailed
     *
     * @return int
     */
    public function enhancementFailed(): int
    {
        if (! $this->currentLevel->atMinimumLevel()) {
            $this->currentLevel = new EnhancementLevel($this->currentLevel->level - 1);
        }

        return $this->currentLevel->level;
    }
}
