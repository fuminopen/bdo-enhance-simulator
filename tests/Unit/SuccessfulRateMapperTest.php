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
     * TODO 1
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

    public function test_increase_rate_slows_down_after_certain_fail_stack()
    {
        // instantiate an equipment with level which successful rate is not 100%
        $equipmentBeyondThreshold = new Equipment(new EnhancementLevel(8));

        $mapper23 = new SuccessfulRateMapper($equipmentBeyondThreshold, new FailStack(23));

        $mapper24 = new SuccessfulRateMapper($equipmentBeyondThreshold, new FailStack(24));

        $mapper25 = new SuccessfulRateMapper($equipmentBeyondThreshold, new FailStack(25));

        $mapper26 = new SuccessfulRateMapper($equipmentBeyondThreshold, new FailStack(26));

        $diff = $mapper24->getRate() - $mapper23->getRate();

        $this->assertTrue($diff === 2.04);

        $diff = $mapper25->getRate() - $mapper24->getRate();

        $this->assertTrue($diff === 2.04);

        $diff = $mapper26->getRate() - $mapper25->getRate();

        $this->assertTrue($diff === 0.40);
    }
}
