<?php

namespace App\ValueObjects;

class Equipment
{
    /**
     * enhancement level which successful rate starting to drop
     */
    public const THRESHOLD = 7;

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
     * @return Equipment
     */
    public function enhancementSucceed(): Equipment
    {
        if (!$this->currentLevel->atMaximumLevel()) {
            $newLevel = new EnhancementLevel($this->currentLevel->levelUp()->level);
            return new self($newLevel);
        }

        return $this;
    }

    /**
     * enhanceFailed
     *
     * @return Equipment
     */
    public function enhancementFailed(): Equipment
    {
        if ($this->currentLevel->level > self::THRESHOLD) {
            $newLevel = new EnhancementLevel($this->currentLevel->levelDown()->level);
            return new self($newLevel);
        }

        return $this;
    }
}
