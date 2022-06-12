<?php

namespace Tests\Unit;

use App\Domains\Equipment;
use InvalidArgumentException;
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

    /**
     * test_minimum_enhancement_level_is_zero
     *
     * @return void
     */
    public function test_minimum_enhancement_level_is_zero()
    {
        $equipment = new Equipment(0);

        $currentLevel = $equipment->getCurrentLevel();

        $equipment->enhanceFailed();

        $this->assertSame($currentLevel, $equipment->getCurrentLevel());
    }

    /**
     * test_maximum_enhancement_level_is_twenty
     *
     * @return void
     */
    public function test_maximum_enhancement_level_is_twenty()
    {
        $equipment = new Equipment(20);

        $currentLevel = $equipment->getCurrentLevel();

        $equipment->enhance();

        $this->assertSame($currentLevel, $equipment->getCurrentLevel());
    }

    /**
     * test_initial_enhancement_level_must_be_0_to_20
     *
     * @return void
     */
    public function test_minimum_initial_enhancement_level_must_be_0()
    {
        $this->expectException(InvalidArgumentException::class);

        $equipment = new Equipment(-1);
    }

    public function test_maximum_initial_enhancement_level_must_be_20()
    {
        $this->expectException(InvalidArgumentException::class);

        $equipment = new Equipment(21);
    }
}
