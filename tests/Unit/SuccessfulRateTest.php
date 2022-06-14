<?php

namespace Tests\Unit;

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
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
}
