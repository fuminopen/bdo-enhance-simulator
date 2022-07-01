<?php

namespace Tests\Unit;

use App\Domains\EnhancementDomain;
use App\ValueObjects\Equipment;
use PHPUnit\Framework\TestCase;

/**
 * 1. stack can be set
 * 2. stack can be removed
 * 3.
 */
class EnhancementDomainTest extends TestCase
{
    public function test_stack_can_be_set()
    {
        $domain = new EnhancementDomain(new Equipment());

        $stack = 10;

        $domain->setFailStack($stack);

        $this->assertSame($stack, $domain->currentStack());
    }

    public function test_stack_can_be_removed()
    {
        $domain = new EnhancementDomain(new Equipment());

        $stack = 10;

        $domain->setFailStack($stack);

        $this->assertSame($stack, $domain->currentStack());

        $domain->removeFailStack();

        $this->assertSame(0, $domain->currentStack());
    }
}
