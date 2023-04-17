<?php

namespace Tests\Unit;

use App\Services\EnhancementService;
use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\Equipment;
use App\ValueObjects\FailStack;
use App\ValueObjects\Weapon;
use PHPUnit\Framework\TestCase;

/**
 * 1. stack can be set
 * 2. stack can be removed
 * 3. equipment can be set
 * 4. equipment can be removed
 * 5. can display if enhancement is ready
 * 6. enhancement of equipments working
 */
class EnhancementServiceTest extends TestCase
{
    /**
     * TODO 1
     */
    public function test_stack_can_be_set()
    {
        $service = new EnhancementService();

        $stack = new FailStack(10);

        $service->setFailStack($stack);

        $this->assertSame($stack, $service->getCurrentStack());
    }

    /**
     * TODO 2
     */
    public function test_stack_can_be_unset()
    {
        $service = new EnhancementService();

        $stack = new FailStack(19);

        $service->setFailStack($stack);

        $this->assertSame($stack, $service->getCurrentStack());

        $service->unsetFailStack();

        $this->assertSame(
            0,
            $service->getCurrentStack()->getValue()
        );
    }

    /**
     * TODO 3
     */
    public function test_equipment_can_be_set()
    {
        $level = 7;

        $service = new EnhancementService();

        $equipment = new Equipment(new EnhancementLevel($level));

        $service->setEquipment($equipment);

        $this->assertSame($level, $service->currentEquipment()?->currentLevel->level);
    }

    /**
     * TODO 4
     */
    public function test_equipment_can_be_unset()
    {
        $service = new EnhancementService();

        $service->setEquipment(new Equipment());

        $this->assertNotNull($service->currentEquipment());

        $service->unsetEquipment();

        $this->assertNull($service->currentEquipment());
    }

    /**
     * TODO 5
     */
    public function test_ready_to_enhance_working()
    {
        $service = new EnhancementService();

        $this->assertFalse($service->readyToEnhance());

        $service->setEquipment(new Equipment());

        $this->assertTrue($service->readyToEnhance());

        $service->unsetEquipment();

        $this->assertFalse($service->readyToEnhance());
    }

    /**
     * TODO 6
     */
    public function test_enhancement_working()
    {
        $baseLevel = EnhancementLevel::MINIMUM_LEVEL + 1;

        $service = new EnhancementService();

        $service->setEquipment(new Equipment(new EnhancementLevel($baseLevel)));

        $this->assertSame($baseLevel, $service->currentEquipment()?->getCurrentLevel()->level);

        $succeed = $service->enhance();

        $level = ($succeed)
            ? $baseLevel + 1
            : $baseLevel - 1;

        $this->assertSame($level, $service->currentEquipment()->getCurrentLevel()->level);
    }
}
