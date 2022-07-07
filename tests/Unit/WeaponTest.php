<?php

namespace Tests\Unit;

use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\Equipment;
use App\ValueObjects\Weapon;
use PHPUnit\Framework\TestCase;

/**
 * 1. equipment is level 0 at default
 * 2. equipment can be enhanced
 * 3. enhancement succeeds or fails
 * 4. level ups when succeed
 * 5. level downs when failed
 * 6. level downs only if current level is threshold + 1 or higher
 *
 * 1. base level is 0.
 * 2. threshold is 7.
 */
class WeaponTest extends TestCase
{
    /**
     * TODO : 1
     */
    public function test_level_of_equipment_is_0_at_default()
    {
        $weapon = new Weapon();

        $this->assertSame(
            (new EnhancementLevel())->level,
            $weapon->getCurrentLevel()->level
        );
    }

    /**
     * TODO : 4
     *
     * @return void
     */
    public function test_an_equipment_levels_up_when_enhancement_succeed()
    {
        $weapon = new Weapon();

        $currentLevel = $weapon->getCurrentLevel();

        $newWeapon = $weapon->enhancementSucceed();

        $this->assertSame(
            $currentLevel->levelUp()->level,
            $newWeapon->getCurrentLevel()->level
        );
    }

    /**
     * TODO : 5
     *
     * @return void
     */
    public function test_an_equipment_levels_down_when_enhancement_failed()
    {
        $weapon = new Weapon(new EnhancementLevel(Weapon::THRESHOLD + 1));

        $currentLevel = $weapon->getCurrentLevel();

        $newWeapon = $weapon->enhancementFailed();

        $this->assertSame(
            $currentLevel->levelDown()->level,
            $newWeapon->getCurrentLevel()->level
        );
    }

    /**
     * TODO 6
     */
    public function test_level_down_occurs_only_beyond_threshold()
    {
        $equipment = new Weapon(new EnhancementLevel(Weapon::THRESHOLD));

        $currentLevel = $equipment->currentLevel;

        $newEquipment = $equipment->enhancementFailed();

        $this->assertSame(
            $currentLevel->level,
            $newEquipment->currentLevel->level
        );

        $equipment = new Weapon(new EnhancementLevel(Equipment::THRESHOLD + 1));

        $currentLevel = $equipment->currentLevel;

        $newEquipment = $equipment->enhancementFailed();

        $this->assertSame(
            $currentLevel->levelDown()->level,
            $newEquipment->currentLevel->level
        );
    }

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
