<?php

namespace Tests\Unit;

use App\ValueObjects\FailStack;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * TODO
 * 1. natural number including zero
 * 2. integer
 */
class FailStackTest extends TestCase
{
    public function test_fail_stack_is_natural_number_including_zero()
    {
        $stack = new FailStack(0);

        $this->assertInstanceOf(FailStack::class, $stack);

        $stack = new FailStack(2);

        $this->assertInstanceOf(FailStack::class, $stack);

        $this->expectException(InvalidArgumentException::class);

        new FailStack(-1);
    }

    public function test_fail_stack_is_integer()
    {
        $stack = new FailStack(1);

        $this->assertInstanceOf(FailStack::class, $stack);

        $this->expectException(InvalidArgumentException::class);

        new FailStack(1.01);
    }
}
