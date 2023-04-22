<?php

namespace Tests\Unit;

use App\Exceptions\InvalidRateException;
use App\ValueObjects\FailStack;
use App\ValueObjects\Rate;
use PHPUnit\Framework\TestCase;

/**
 * 1. successful rate has percent property between 0.01% to 100.00% with second decimal place
 * 2. successful rate has rate property between 0.0001 to 1.0000 with fourth decimal place
 * 3. minimum is 0.01
 * 4. maximum is 100.00
 */
class RateTest extends TestCase
{
    /**
     * TODO : 1
     */
    public function test_percent_is_float_with_second_decimal_place()
    {
        // ceil
        $rate = new Rate(55.555);

        $this->assertSame(55.56, $rate->getInPercent());

        // floor
        $rate = new Rate(54.444);

        $this->assertSame(54.44, $rate->getInPercent());

        // minimum
        $rate = new Rate(0.011);

        $this->assertSame(Rate::MINIMUM_PERCENT, $rate->getInPercent());

        // maximum
        $rate = new Rate(99.999);

        $this->assertSame(Rate::MAXIMUM_PERCENT, $rate->getInPercent());
    }

    /**
     * TODO : 2
     */
    public function test_rate_is_float_with_fourth_decimal_place()
    {
        // ceil
        $rate = new Rate(55.555);

        $this->assertSame(0.5556, $rate->getInRate());

        // floor
        $rate = new Rate(54.444);

        $this->assertSame(0.5444, $rate->getInRate());

        // minimum
        $rate = new Rate(0.011);

        $this->assertSame(Rate::MINIMUM_RATE, $rate->getInRate());

        // maximum
        $rate = new Rate(99.999);

        $this->assertSame(Rate::MAXIMUM_RATE, $rate->getInRate());
    }

    /**
     * TODO : 3
     *
     * @return void
     */
    public function test_rate_cannot_be_lower_than_minimum()
    {
        $this->expectException(InvalidRateException::class);

        new Rate(Rate::MINIMUM_PERCENT - 0.01);
    }

    /**
     * TODO : 3
     *
     * @return void
     */
    public function test_rate_can_be_instantiated_with_minimum()
    {
        new Rate(Rate::MINIMUM_PERCENT);

        $this->assertTrue(true);
    }

    /**
     * TODO : 4
     *
     * @return void
     */
    public function test_rate_cannot_exceeds_maximum()
    {
        $this->expectException(InvalidRateException::class);

        new Rate(Rate::MAXIMUM_PERCENT + 0.01);
    }

    /**
     * TODO : 4
     *
     * @return void
     */
    public function test_rate_can_be_instantiated_with_maximum()
    {
        new Rate(Rate::MAXIMUM_PERCENT);

        $this->assertTrue(true);
    }

    public function test_addition()
    {
        $base = new Rate(1.00);

        $four = $base->add(
            new Rate(3.00)
        );

        $this->assertSame(
            4.00,
            $four->getInPercent()
        );
    }

    public function test_multiplication()
    {
        $interval = new Rate(3.00);

        $stack = $this->createMock(FailStack::class);
        $stack->method('getValue')
            ->willReturn(4);

        $twelve = $interval->times($stack);

        $this->assertSame(
            12.00,
            $twelve->getInPercent()
        );
    }
}
