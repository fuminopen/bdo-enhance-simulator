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
 * 6. level downs only if current level is threshold + 1 or higher
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

        $newEquipment = $equipment->enhancementSucceed();

        $this->assertSame(
            $currentLevel->levelUp()->level,
            $newEquipment->currentLevel->level
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

        $newEquipment = $equipment->enhancementFailed();

        $this->assertSame(
            $currentLevel->levelDown()->level,
            $newEquipment->currentLevel->level
        );
    }

    /**
     * TODO 6
     */
    public function test_level_down_occurs_only_beyond_threshold()
    {
        $equipment = new Equipment(new EnhancementLevel(Equipment::THRESHOLD));

        $currentLevel = $equipment->currentLevel;

        $newEquipment = $equipment->enhancementFailed();

        $this->assertSame(
            $currentLevel->level,
            $newEquipment->currentLevel->level
        );

        $equipment = new Equipment(new EnhancementLevel(Equipment::THRESHOLD + 1));

        $currentLevel = $equipment->currentLevel;

        $newEquipment = $equipment->enhancementFailed();

        $this->assertSame(
            $currentLevel->levelDown()->level,
            $newEquipment->currentLevel->level
        );
    }
}
