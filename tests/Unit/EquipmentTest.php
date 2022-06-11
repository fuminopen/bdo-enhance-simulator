<?php

namespace Tests\Unit;

use App\Domains\Equipment;
use PHPUnit\Framework\TestCase;

class EquipmentTest extends TestCase
{
    /**
     * A basic unit test example.
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
}
