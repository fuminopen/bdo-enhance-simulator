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
 */
class EnhancementDomainTest extends TestCase
{
    /**
     * TODO 1
     */
    public function test_stack_can_be_set()
    {
        $domain = new EnhancementDomain(new Equipment());

        $stack = 10;

        $domain->setFailStack($stack);

        $this->assertSame($stack, $domain->currentStack());
    }

    /**
     * TODO 2
     */
    public function test_stack_can_be_removed()
    {
        $domain = new EnhancementDomain(new Equipment());

        $stack = 10;

        $domain->setFailStack($stack);

        $this->assertSame($stack, $domain->currentStack());

        $domain->removeFailStack();

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

        $this->assertSame($level, $domain->equipmentLevel());
    }
}
