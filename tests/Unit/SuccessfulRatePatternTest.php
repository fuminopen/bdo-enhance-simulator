<?php

namespace Tests\Unit;

use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\Equipment;
use App\ValueObjects\FailStack;
use App\ValueObjects\Rate;
use App\ValueObjects\SuccessfulRate;
use App\ValueObjects\SuccessfulRateMapper;
use App\ValueObjects\SuccessfulRatePattern;
use App\ValueObjects\Weapon;
use PHPUnit\Framework\TestCase;

/**
 * 2. successful rate increases along with stack increases
 * 3. at some point, increase rate of successful rate significantly drops
 */
final class SuccessfulRatePatternTest extends TestCase
{
    public function test_rate_increases_along_with_stack()
    {
        $pattern = new SuccessfulRatePattern(
            $this->createMock(EnhancementLevel::class),
            new Rate(10.00),
            new Rate(1.00),
            new Rate(50.00),
            new Rate(1.00),
        );

        $this->assertSame(
            0.1,
            $pattern->getRate(new FailStack(0))->getInRate()
        );
    }

    public function test_increase_interval_drops_after_soft_cap()
    {
        $pattern = new SuccessfulRatePattern(
            $this->createMock(EnhancementLevel::class),
            new Rate(20.00),
            new Rate(10.00),
            new Rate(50.00),
            new Rate(1.00),
        );

        // no fail stack
        $this->assertSame(
            20.0,
            $pattern->getRate(new FailStack(0))->getInPercent()
        );

        // one fail stack = 20 + 10 = 30
        $this->assertSame(
            30.0,
            $pattern->getRate(new FailStack(1))->getInPercent()
        );

        // two fail stack = 20 + 20 = 40
        $this->assertSame(
            40.0,
            $pattern->getRate(new FailStack(2))->getInPercent()
        );

        // three fail stack = 20 + 30 = 50
        $this->assertSame(
            50.0,
            $pattern->getRate(new FailStack(3))->getInPercent()
        );

        // four fail stack = 20 + 30 = 50 soft cap
        // 50 + 1 = 51
        $this->assertSame(
            51.0,
            $pattern->getRate(new FailStack(4))->getInPercent()
        );

        // five fail stack = 20 + 30 = 50 soft cap
        // 50 + (1 * 2) = 52
        $this->assertSame(
            52.0,
            $pattern->getRate(new FailStack(5))->getInPercent()
        );
    }
}
