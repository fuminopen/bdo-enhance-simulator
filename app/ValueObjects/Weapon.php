<?php

namespace App\ValueObjects;

final class Weapon implements Enhanceable
{
    /**
     * enhancement level which successful rate starting to drop
     */
    public const THRESHOLD = 7;

    /**
     * @var EnhancementLevel
     */
    private readonly EnhancementLevel $level;

    /**
     * @param  EnhancementLevel $level
     * @return void
     */
    public function __construct(EnhancementLevel $level = new EnhancementLevel())
    {
        $this->level = $level;
        $this->equipment = new Equipment($this->level);
    }

    /**
     * enhancementSucceed
     *
     * @return Weapon
     */
    public function enhancementSucceed(): Weapon
    {
        return $this->equipment->enhancementSucceed($this);
    }

    /**
     * enhancementFailed
     *
     * @return Weapon
     */
    public function enhancementFailed(): Weapon
    {
        return $this->equipment->enhancementFailed($this);
    }

    /**
     * getCurrentLevel
     *
     * @return EnhancementLevel
     */
    public function getCurrentLevel(): EnhancementLevel
    {
        return $this->level;
    }

    /**
     * getThreshold
     *
     * @return EnhancementLevel
     */
    public function getThreshold(): EnhancementLevel
    {
        return new EnhancementLevel(self::THRESHOLD);
    }
}
