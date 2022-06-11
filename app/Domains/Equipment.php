<?php

namespace App\Domains;

final class Equipment
{
    /**
     * @var int
     */
    private int $currentLevel;

    /**
     * __construct
     *
     * @param  int $currentLevel
     * @return void
     */
    public function __construct(int $currentLevel = 0)
    {
        $this->currentLevel = $currentLevel;
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
        $this->currentLevel++;

        return $this->currentLevel;
    }

    /**
     * enhanceFailed
     *
     * @return int
     */
    public function enhanceFailed(): int
    {
        $this->currentLevel--;

        return $this->currentLevel;
    }
}