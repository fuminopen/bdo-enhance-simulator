<?php

namespace Tests\Unit;

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
        $this->expectException(InvalidArgumentException::class);

        new SuccessfulRate(SuccessfulRate::MINIMUM);
    }

    /**
     * TODO : 2
     *
     * @return void
     */
    public function test_rate_cannot_exceeds_maximum()
    {
        $this->expectException(InvalidArgumentException::class);

        new SuccessfulRate(1.01);
    }

    /**
     * TODO : 2
     *
     * @return void
     */
    public function test_rate_can_be_instantiated_with_maximum()
    {
        $this->expectException(InvalidArgumentException::class);

        new SuccessfulRate(SuccessfulRate::MAXIMUM);
    }
}
