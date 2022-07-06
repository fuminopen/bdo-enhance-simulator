<?php

namespace Tests\Unit;

use App\ValueObjects\Weapon;
use PHPUnit\Framework\TestCase;

/**
 * 1. base level is 0.
 * 2. threshold is 7.
 */
class WeaponTest extends TestCase
{
    /**
     * 1. base level is 0.
     */
    public function test_base_level_is_0()
    {
        $this->assertSame(0, (new Weapon())->currentLevel->level);
    }

    /**
     * 2. threshold is 7.
     */
    public function test_threshold_is_7()
    {
        $this->assertSame(
            7,
            (new Weapon())->getThreshold()->level
        );
    }
}
