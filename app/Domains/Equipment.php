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
    public function enhance(): int
    {
        if ($this->currentLevel->getLevel() < EnhancementLevel::MAXIMUM_LEVEL) {
            $this->currentLevel = new EnhancementLevel($this->currentLevel->getLevel() + 1);
        }

        return $this->currentLevel->getLevel();
    }

    /**
     * enhanceFailed
     *
     * @return int
     */
    public function enhanceFailed(): int
    {
        if ($this->currentLevel->getLevel() > EnhancementLevel::MINIMUM_LEVEL) {
            $this->currentLevel = new EnhancementLevel($this->currentLevel->getLevel() - 1);
        }

        return $this->currentLevel->getLevel();
    }
}