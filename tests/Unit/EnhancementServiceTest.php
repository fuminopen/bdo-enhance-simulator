<?php

namespace Tests\Unit;

use App\Services\EnhancementService;
use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\Equipment;
use App\ValueObjects\FailStack;
use App\ValueObjects\Rate;
use App\ValueObjects\SuccessfulRatePattern;
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
        $service = new EnhancementService();

        $equipment = $this->createMock(Equipment::class);
        $equipment->method('getCurrentLevel')
            ->willReturn(new EnhancementLevel(7));

        $service->setEquipment($equipment);

        $this->assertSame(7, $service->currentEquipment()->getCurrentLevel()->getValue());
    }

    /**
     * TODO 4
     */
    public function test_equipment_can_be_unset()
    {
        $service = new EnhancementService();

        $service->setEquipment(
            $this->createMock(Equipment::class)
        );

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

        $service->setEquipment(
            $this->createMock(Equipment::class)
        );

        $this->assertTrue($service->readyToEnhance());

        $service->unsetEquipment();

        $this->assertFalse($service->readyToEnhance());
    }

    /**
     * TODO 6
     */
    public function test_enhancement_succeeds_with_equipment_level_up()
    {
        $service = new EnhancementService();

        $level = $this->createMock(EnhancementLevel::class);
        $level->method('getValue')->willReturn(3);

        $pattern = $this->createMock(SuccessfulRatePattern::class);
        // enhancement will succeed
        $pattern->method('getRate')->willReturn(new Rate(100.00));

        $equipment = $this->createMock(Equipment::class);
        $equipment->method('getCurrentLevel')->willReturn($level);
        $equipment->method('getSuccessfulRatePattern')->willReturn($pattern);

        $service->setEquipment($equipment);

        $this->assertSame(3, $service->currentEquipment()->getCurrentLevel()->getValue());

        $succeed = $service->enhance();

        $this->assertTrue($succeed);

        $this->assertSame(
            // 3 + 1 = 4
            4,
            $service->currentEquipment()->getCurrentLevel()->getValue()
        );
    }
}
