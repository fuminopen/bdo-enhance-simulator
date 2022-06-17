<?php

namespace App\ValueObjects;

final class Equipment
{
    /**
     * @var EnhancementLevel
     */
    private EnhancementLevel $currentLevel;

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
     * getCurrentLevel
     *
     * @return EnhancementLevel
     */
    public function getCurrentLevel(): EnhancementLevel
    {
        return $this->currentLevel;
    }

    /**
     * enhance
     *
     * @return int
     */
    public function enhancementSucceed(): int
    {
        if (! $this->currentLevel->atMaximumLevel()) {
            $this->currentLevel = new EnhancementLevel($this->currentLevel->getLevel() + 1);
        }

        return $this->currentLevel->getLevel();
    }

    /**
     * enhanceFailed
     *
     * @return int
     */
    public function enhancementFailed(): int
    {
        if (! $this->currentLevel->atMinimumLevel()) {
            $this->currentLevel = new EnhancementLevel($this->currentLevel->getLevel() - 1);
        }

        return $this->currentLevel->getLevel();
    }
}
