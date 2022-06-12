<?php

namespace Tests\Unit;

use App\Domains\EnhancementLevel;
use App\Domains\Equipment;
use PHPUnit\Framework\TestCase;

class EquipmentTest extends TestCase
{
    /**
     * test_an_equipment_can_be_enhanced
     *
     * @return void
     */
    public function test_an_equipment_can_be_enhanced()
    {
        $equipment = new Equipment();

        $currentLevel = $equipment->getCurrentLevel();

        $equipment->enhancementSucceed();

        $this->assertSame($currentLevel + 1, $equipment->getCurrentLevel());
    }

    /**
     * test_equipment_enhancement_can_be_failed
     *
     * @return void
     */
    public function test_equipment_enhancement_can_be_failed()
    {
        $equipment = new Equipment(1);

        $currentLevel = $equipment->getCurrentLevel();

        $equipment->enhancementFailed();

        $this->assertSame($currentLevel - 1, $equipment->getCurrentLevel());
    }

    /**
     * test_minimum_enhancement_level_is_zero
     *
     * @return void
     */
    public function test_minimum_enhancement_level_is_zero()
    {
        $equipment = new Equipment(EnhancementLevel::MINIMUM_LEVEL);

        $currentLevel = $equipment->getCurrentLevel();

        $equipment->enhancementFailed();

        $this->assertSame($currentLevel, $equipment->getCurrentLevel());
    }

    /**
     * test_maximum_enhancement_level_is_twenty
     *
     * @return void
     */
    public function test_enhancement_level_does_not_exceeds_its_maximum()
    {
        $equipment = new Equipment(EnhancementLevel::MAXIMUM_LEVEL);

        $currentLevel = $equipment->getCurrentLevel();

        $equipment->enhancementSucceed();

        $this->assertSame($currentLevel, $equipment->getCurrentLevel());
    }

}
