<?php

namespace Tests\Unit;

use App\Domains\EnhancementDomain;
use App\ValueObjects\Equipment;
use PHPUnit\Framework\TestCase;

class EnhancementDomainTest extends TestCase
{
    public function test_stack_can_be_set()
    {
        $domain = new EnhancementDomain(new Equipment());

        $stack = 10;

        $domain->setStack($stack);

        $this->assertSame($stack, $domain->currentStack());
    }
}
