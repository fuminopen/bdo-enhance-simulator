<?php

namespace App\Domains;

use InvalidArgumentException;

final class Equipment
{
    /**
     * @var int
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
        return $this->currentLevel;
    }

    /**
     * enhance
     *
     * @return int
     */
    public function enhance(): int
    {
        if ($this->currentLevel < 20) {
            $this->currentLevel++;
        }

        return $this->currentLevel;
    }

    /**
     * enhanceFailed
     *
     * @return int
     */
    public function enhanceFailed(): int
    {
        if ($this->currentLevel > 0){
            $this->currentLevel--;
        }

        return $this->currentLevel;
    }
}