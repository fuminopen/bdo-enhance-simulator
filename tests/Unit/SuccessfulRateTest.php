<?php

namespace Tests\Unit;

use App\ValueObjects\SuccessfulRate;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * 1. successful rate has percent property between 0.01% to 100.00% with second decimal place
 * 2. successful rate has percent property between 0.01% to 100.00% with second decimal place
 * 3. minimum is 0.01
 * 4. maximum is 100.00
 */
class SuccessfulRateTest extends TestCase
{
    /**
     * TODO : 1
     */
    public function test_percent_is_float_with_second_decimal_place()
    {
        // ceil
        $rate = new SuccessfulRate(55.555);

        $this->assertSame(55.56, $rate->percent);

        // floor
        $rate = new SuccessfulRate(54.444);

        $this->assertSame(54.44, $rate->percent);

        // minimum
        $rate = new SuccessfulRate(0.011);

        $this->assertSame(SuccessfulRate::MINIMUM_PERCENT, $rate->percent);

        // maximum
        $rate = new SuccessfulRate(99.999);

        $this->assertSame(SuccessfulRate::MAXIMUM_PERCENT, $rate->percent);
    }

    /**
     * TODO : 2
     */
    public function test_rate_is_float_with_fourth_decimal_place()
    {
        // ceil
        $rate = new SuccessfulRate(55.555);

        $this->assertSame(0.5556, $rate->rate);

        // floor
        $rate = new SuccessfulRate(54.444);

        $this->assertSame(0.5444, $rate->rate);

        // minimum
        $rate = new SuccessfulRate(0.011);

        $this->assertSame(SuccessfulRate::MINIMUM_RATE, $rate->rate);

        // maximum
        $rate = new SuccessfulRate(99.999);

        $this->assertSame(SuccessfulRate::MAXIMUM_RATE, $rate->rate);
    }

    /**
     * TODO : 2
     *
     * @return void
     */
    public function test_rate_cannot_be_lower_than_minimum()
    {
        $this->expectException(InvalidArgumentException::class);

        new SuccessfulRate(SuccessfulRate::MINIMUM_PERCENT - 0.01);
    }

    /**
     * TODO : 2
     *
     * @return void
     */
    public function test_rate_can_be_instantiated_with_minimum()
    {
        new SuccessfulRate(SuccessfulRate::MINIMUM_PERCENT);

        $this->assertTrue(true);
    }

    /**
     * TODO : 3
     *
     * @return void
     */
    public function test_rate_cannot_exceeds_maximum()
    {
        $this->expectException(InvalidArgumentException::class);

        new SuccessfulRate(SuccessfulRate::MAXIMUM_PERCENT + 0.01);
    }

    /**
     * TODO : 3
     *
     * @return void
     */
    public function test_rate_can_be_instantiated_with_maximum()
    {
        new SuccessfulRate(SuccessfulRate::MAXIMUM_PERCENT);

        $this->assertTrue(true);
    }
}
