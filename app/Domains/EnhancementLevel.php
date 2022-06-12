<?php

namespace App\Domains;

use InvalidArgumentException;

final class EnhancementLevel
{
    private const MINIMUM_LEVEL = 0;

    private const MAXIMUM_LEVEL = 20;

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
    public function __construct(int $level = 0)
    {
        if (! $this->validInitialLevel($level)) {
            throw new InvalidArgumentException('Initial enhancement level is invalid.');
        }

        $this->level = $level;
    }

    /**
     * validate if initial enhancement level assigned is valid.
     *
     * @param  int $level
     * @return bool
     */
    private function validInitialLevel(int $level): bool
    {
        return ($level > self::MINIMUM_LEVEL) && ($level < self::MAXIMUM_LEVEL);
    }
}