<?php

namespace Tests\Unit;

use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\Equipment;
use App\ValueObjects\FailStack;
use App\ValueObjects\SuccessfulRate;
use App\ValueObjects\SuccessfulRateMapper;
use PHPUnit\Framework\TestCase;

/**
 * 1. successful rate is 100% until equipment's level hits certain level
 * 2. successful rate increases along with stack increases
 * 3. at some point, increase rate of successful rate significantly drops
 */
class SuccessfulRateMapperTest extends TestCase
{
    /**
     * TODO 1
     *
     * @return void
     */
    public function test_successful_rate_is_at_maximum_until_threshold()
    {
        // instantiate an equipment with minimum level
        $levelZeroEquipment = new Equipment(new EnhancementLevel());

        $mapper = new SuccessfulRateMapper($levelZeroEquipment, new FailStack());

        $this->assertSame(SuccessfulRate::MAXIMUM, $mapper->getRate());
    }

    /**
     * TODO 3
     *
     * @return void
     */
    public function test_successful_rate_starts_dropping_after_threshold()
    {
        // instantiate an equipment with level which successful rate starts dropping
        $equipmentBeyondThreshold = new Equipment(new EnhancementLevel(Equipment::THRESHOLD));

        $mapper = new SuccessfulRateMapper($equipmentBeyondThreshold, new FailStack());

        $this->assertTrue(SuccessfulRate::MAXIMUM > $mapper->getRate());
    }

    /**
     * TODO 2
     *
     * @return void
     */
    public function test_successful_rate_increases_along_with_fail_stack()
    {
        // instantiate an equipment with level which successful rate is not 100%
        $equipmentBeyondThreshold = new Equipment(new EnhancementLevel(Equipment::THRESHOLD));

        $mapperWithNoStack = new SuccessfulRateMapper($equipmentBeyondThreshold, new FailStack());

        $mapperWithFS1 = new SuccessfulRateMapper($equipmentBeyondThreshold, new FailStack(1));

        $this->assertTrue($mapperWithNoStack->getRate() < $mapperWithFS1->getRate());
    }
}
