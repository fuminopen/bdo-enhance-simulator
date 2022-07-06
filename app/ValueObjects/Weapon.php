<?php

namespace App\ValueObjects;

final class Weapon extends Equipment
{
    /**
     * enhancement level which successful rate starting to drop
     */
    private const THRESHOLD = 7;

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
