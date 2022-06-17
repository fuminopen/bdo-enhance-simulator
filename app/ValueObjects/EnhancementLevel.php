<?php

namespace App\ValueObjects;

use InvalidArgumentException;

final class EnhancementLevel
{
    public const MINIMUM_LEVEL = 0;

    public const MAXIMUM_LEVEL = 20;

    /**
     * @var int
     */
    private int $level;

    /**
     * __construct
     *
     * @param  int $level
     * @return void
     */
    public function __construct(int $level = self::MINIMUM_LEVEL)
    {
        if (! $this->validInitialLevel($level)) {
            throw new InvalidArgumentException('Initial enhancement level is invalid.');
        }

        $this->level = $level;
    }

    /**
     * getLevel
     *
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * atMaximumLevel
     *
     * @return bool
     */
    public function atMaximumLevel(): bool
    {
        return $this->level === self::MAXIMUM_LEVEL;
    }

    /**
     * atMaximumLevel
     *
     * @return bool
     */
    public function atMinimumLevel(): bool
    {
        return $this->level === self::MINIMUM_LEVEL;
    }

    /**
     * levelUp
     *
     * @return EnhancementLevel
     */
    public function levelUp(): EnhancementLevel
    {
        return new self($this->nextLevel());
    }

    /**
     * levelDown
     *
     * @return EnhancementLevel
     */
    public function levelDown(): EnhancementLevel
    {
        return new self($this->previousLevel());
    }

    /**
     * nextLevel
     *
     * @return int
     */
    private function nextLevel(): int
    {
        if ($this->level === self::MAXIMUM_LEVEL) {
            return self::MAXIMUM_LEVEL;
        }

        return $this->level + 1;
    }

    /**
     * previousLevel
     *
     * @return int
     */
    private function previousLevel(): int
    {
        if ($this->level === self::MINIMUM_LEVEL) {
            return self::MINIMUM_LEVEL;
        }

        return $this->level -1;
    }

    /**
     * validate if initial enhancement level assigned is valid.
     *
     * @param  int $level
     * @return bool
     */
    private function validInitialLevel(int $level): bool
    {
        return ($level >= self::MINIMUM_LEVEL) && ($level <= self::MAXIMUM_LEVEL);
    }
}
