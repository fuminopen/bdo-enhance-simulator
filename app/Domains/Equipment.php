<?php

namespace App\Domains;

final class Equipment
{
    /**
     * @var EnhancementLevel
     */
    private EnhancementLevel $currentLevel;

    /**
     * __construct
     *
     * @param  int $currentLevel
     * @return void
     */
    public function __construct(int $currentLevel = 0)
    {
        $this->currentLevel = new EnhancementLevel($currentLevel);
    }

    /**
     * getCurrentLevel
     *
     * @return int
     */
    public function getCurrentLevel(): int
    {
        return $this->currentLevel->getLevel();
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