<?php

namespace Tests\Unit;

use App\ValueObjects\SuccessfulRate;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * 1. successful rate is float with second decimal place
 * 2. minimum is 0.01
 * 3. maximum is 1.00
 * 4. successful rate increases along with stack increases
 * 5. at some point, increase rate of successful rate significantly drops
 */
class SuccessfulRateTest extends TestCase
{
    /**
     * TODO : 1
     */
    public function test_rate_is_float_with_second_decimal_place()
    {
        $rate = new SuccessfulRate(0.5555);

        $this->assertSame(0.56, $rate->rate);

        $rate = new SuccessfulRate(0.54444);

        $this->assertSame(0.54, $rate->rate);

        $rate = new SuccessfulRate(0.011111);

        $this->assertSame(SuccessfulRate::MINIMUM, $rate->rate);

        $rate = new SuccessfulRate(0.999999999);

        $this->assertSame(SuccessfulRate::MAXIMUM, $rate->rate);
    }

    /**
     * TODO : 2
     *
     * @return void
     */
    public function test_rate_cannot_be_lower_than_minimum()
    {
        $this->expectException(InvalidArgumentException::class);

        new SuccessfulRate(0);
    }

    /**
     * TODO : 2
     *
     * @return void
     */
    public function test_rate_can_be_instantiated_with_minimum()
    {
        new SuccessfulRate(SuccessfulRate::MINIMUM);

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

        new SuccessfulRate(1.01);
    }

    /**
     * TODO : 3
     *
     * @return void
     */
    public function test_rate_can_be_instantiated_with_maximum()
    {
        new SuccessfulRate(SuccessfulRate::MAXIMUM);

        $this->assertTrue(true);
    }
}
