<?php

namespace Tests\Unit;

use App\Exceptions\InvalidStackCountException;
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

        $this->expectException(InvalidStackCountException::class);

        new FailStack(-1);
    }

    public function test_fail_stack_is_integer()
    {
        $stack = new FailStack(1);

        $this->assertInstanceOf(FailStack::class, $stack);

        $this->expectException(InvalidStackCountException::class);

        new FailStack(1.01);
    }

    public function test_subtraction()
    {
        $base = new FailStack(4);

        $this->assertSame(
            2,
            $base->sub(new FailStack(2))->getValue()
        );
    }

    public function test_greater_than()
    {
        $base = new FailStack(4);

        $this->assertTrue(
            $base->gt(new FailStack(3))
        );

        $this->assertFalse(
            $base->gt(new FailStack(4))
        );
    }
}
