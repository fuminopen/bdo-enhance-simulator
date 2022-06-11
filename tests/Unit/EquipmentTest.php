<?php

namespace Tests\Unit;

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

        $equipment->enhance();

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

        $equipment->enhanceFailed();

        $this->assertSame($currentLevel - 1, $equipment->getCurrentLevel());
    }
}
