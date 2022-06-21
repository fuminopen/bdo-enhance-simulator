<?php

namespace Tests\Unit;

use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\Equipment;
use App\ValueObjects\SuccessfulRate;
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
    public function test_successful_rate_is_at_maximum_until_certain_level()
    {
        // instantiate an equipment with minimum level
        $levelZeroEquipment = new Equipment(new EnhancementLevel());

        $mapper = new SuccessfulRateMapper($equipment);

        $this->assertSame(SuccessfulRate::MAXIMUM, $mapper->getRate());
    }
}
