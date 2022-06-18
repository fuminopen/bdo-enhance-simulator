<?php

namespace Tests\Unit;

use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\Equipment;
use PHPUnit\Framework\TestCase;

/**
 * 1. equipment is level 0 at default
 * 2. equipment can be enhanced
 * 3. enhancement succeeds or fails
 * 4. level ups when succeed
 * 5. level downs when failed
 */
class EquipmentTest extends TestCase
{
    /**
     * TODO : 1
     */
    public function test_level_of_equipment_is_0_at_default()
    {
        $equipment = new Equipment();

        $this->assertSame(
            (new EnhancementLevel())->level,
            $equipment->currentLevel->level
        );
    }

    /**
     * TODO : 4
     *
     * @return void
     */
    public function test_an_equipment_levels_up_when_enhancement_succeed()
    {
        $equipment = new Equipment();

        $currentLevel = $equipment->currentLevel;

        $equipment->enhancementSucceed();

        $this->assertSame(
            $currentLevel->levelUp()->leve,
            $equipment->currentLevel->level
        );
    }

    /**
     * TODO : 5
     *
     * @return void
     */
    public function test_an_equipment_levels_down_when_enhancement_failed()
    {
        $equipment = new Equipment(new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL));

        $currentLevel = $equipment->currentLevel;

        $equipment->enhancementFailed();

        $this->assertSame(
            $currentLevel->levelDown()->level,
            $equipment->currentLevel->level
        );
    }
}
