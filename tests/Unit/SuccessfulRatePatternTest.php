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
}
