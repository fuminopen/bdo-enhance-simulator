<?php

namespace Tests\Unit;

use App\Domains\EnhancementDomain;
use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\Equipment;
use PHPUnit\Framework\TestCase;

/**
 * 1. stack can be set
 * 2. stack can be removed
 * 3. equipment can be set
 * 4. equipment can be removed
 * 5. can display if enhancement is ready
 */
class EnhancementDomainTest extends TestCase
{
    /**
     * TODO 1
     */
    public function test_stack_can_be_set()
    {
        $domain = new EnhancementDomain();

        $stack = 10;

        $domain->setFailStack($stack);

        $this->assertSame($stack, $domain->currentStack());
    }

    /**
     * TODO 2
     */
    public function test_stack_can_be_unset()
    {
        $domain = new EnhancementDomain();

        $stack = 10;

        $domain->setFailStack($stack);

        $this->assertSame($stack, $domain->currentStack());

        $domain->unsetFailStack();

        $this->assertSame(0, $domain->currentStack());
    }

    /**
     * TODO 3
     */
    public function test_equipment_can_be_set()
    {
        $level = 7;

        $domain = new EnhancementDomain();

        $equipment = new Equipment(new EnhancementLevel($level));

        $domain->setEquipment($equipment);

        $this->assertSame($level, $domain->currentEquipment()?->currentLevel->level);
    }

    /**
     * TODO 4
     */
    public function test_equipment_can_be_unset()
    {
        $domain = new EnhancementDomain();

        $domain->setEquipment(new Equipment());

        $this->assertNotNull($domain->currentEquipment());

        $domain->unsetEquipment();

        $this->assertNull($domain->currentEquipment());
    }

    /**
     * TODO 5
     */
    public function test_ready_to_enhance_working()
    {
        $domain = new EnhancementDomain();

        $this->assertFalse($domain->readyToEnhance());

        $domain->setEquipment(new Equipment());

        $this->assertTrue($domain->readyToEnhance());

        $domain->unsetEquipment();

        $this->assertFalse($domain->readyToEnhance());
    }
}
