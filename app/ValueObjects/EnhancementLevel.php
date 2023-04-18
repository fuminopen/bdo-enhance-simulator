<?php

namespace App\ValueObjects;

use App\Exceptions\InvalidInitialLevelException;
use App\ValueObjects\Traits\GetIntValueTrait;

final class EnhancementLevel
{
    use GetIntValueTrait;

    private const MINIMUM_LEVEL = 0;

    private const MAXIMUM_LEVEL = 20;

    /**
     * @var int
     */
    private readonly int $value;

    /**
     * __construct
     *
     * @param  int $level
     * @return void
     */
    public function __construct(int $level)
    {
        if (! $this->validInitialLevel($level)) {
            throw new InvalidInitialLevelException();
        }

        $this->value = $level;
    }

    /**
     * create minimum level instance
     *
     * @return self
     */
    public static function createMinimumLevel(): self
    {
        return new self(self::MINIMUM_LEVEL);
    }

    /**
     * atMaximumLevel
     *
     * @return bool
     */
    public function atMaximumLevel(): bool
    {
        return $this->value === self::MAXIMUM_LEVEL;
    }

    /**
     * atMaximumLevel
     *
     * @return bool
     */
    public function atMinimumLevel(): bool
    {
        return $this->value === self::MINIMUM_LEVEL;
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

    /**************************
     *
     * private methods
     *
     **************************/

    /**
     * nextLevel
     *
     * @return int
     */
    private function nextLevel(): int
    {
        if ($this->value === self::MAXIMUM_LEVEL) {
            return self::MAXIMUM_LEVEL;
        }

        return $this->value + 1;
    }

    /**
     * previousLevel
     *
     * @return int
     */
    private function previousLevel(): int
    {
        if ($this->value === self::MINIMUM_LEVEL) {
            return self::MINIMUM_LEVEL;
        }

        return $this->value - 1;
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
