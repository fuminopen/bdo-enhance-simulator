<?php

namespace Tests\Unit;

use App\Exceptions\NoLongerEnhanceableException;
use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\Equipment;
use App\ValueObjects\SuccessfulRatePattern;
use PHPUnit\Framework\TestCase;

final class EquipmentTest extends TestCase
{
    /**
     * @dataProvider levelProvider
     */
    public function test_current_level_is_obtainable(int $level)
    {
        $equipment = new Equipment(
            new EnhancementLevel($level),
            new EnhancementLevel(0),
            $this->createMock(SuccessfulRatePattern::class)
        );

        $this->assertSame(
            $level,
            $equipment->getCurrentLevel()->getValue()
        );
    }

    /**
     * @dataProvider levelProvider
     */
    public function test_threshold_is_obtainable(int $level)
    {
        $equipment = new Equipment(
            new EnhancementLevel(0),
            new EnhancementLevel($level),
            $this->createMock(SuccessfulRatePattern::class)
        );

        $this->assertSame(
            $level,
            $equipment->getThreshold()->getValue()
        );
    }

    public function test_one_level_higher_equipment_returned()
    {
        $equipment = new Equipment(
            new EnhancementLevel(8),
            new EnhancementLevel(0),
            $this->createMock(SuccessfulRatePattern::class)
        );

        $up = $equipment->enhancementSucceed();

        $this->assertSame(
            9,
            $up->getCurrentLevel()->getValue()
        );
    }

    public function test_max_level_instance_cannot_succeed_on_enhancement()
    {
        $maxLevel = new EnhancementLevel(20);

        $this->assertTrue($maxLevel->atMaximumLevel());

        $equipment = new Equipment(
            $maxLevel,
            new EnhancementLevel(0),
            $this->createMock(SuccessfulRatePattern::class)
        );

        $this->expectException(NoLongerEnhanceableException::class);

        $equipment->enhancementSucceed();
    }

    public function test_max_level_instance_cannot_fails_on_enhancement()
    {
        $maxLevel = new EnhancementLevel(20);

        $this->assertTrue($maxLevel->atMaximumLevel());

        $equipment = new Equipment(
            $maxLevel,
            new EnhancementLevel(0),
            $this->createMock(SuccessfulRatePattern::class)
        );

        $this->expectException(NoLongerEnhanceableException::class);

        $equipment->enhancementFailed();
    }

    /**
     * @dataProvider failingLevelsProvider
     */
    public function test_lower_level_instance_returned(
        int $level,
        int $threshold
    ) {
        $equipment = new Equipment(
            new EnhancementLevel($level),
            new EnhancementLevel($threshold),
            $this->createMock(SuccessfulRatePattern::class)
        );

        $this->assertSame(
            $level - 1,
            $equipment->enhancementFailed()->getCurrentLevel()->getValue()
        );
    }

    /**
     * @dataProvider notFailingLevelsProvider
     */
    public function test_level_not_fails_if_currently_same_or_below_threshold(
        int $level,
        int $threshold
    ) {
        $equipment = new Equipment(
            new EnhancementLevel($level),
            new EnhancementLevel($threshold),
            $this->createMock(SuccessfulRatePattern::class)
        );

        $this->assertSame(
            $level,
            $equipment->enhancementFailed()->getCurrentLevel()->getValue()
        );
    }

    /**************************************************************
    *
    * providers
    *
    **************************************************************/

    public function levelProvider(): array
    {
        return [
            [0,],
            [1,],
            [3,],
            [8,],
            [10,],
            [15,],
            [20,],
        ];
    }

    public function failingLevelsProvider(): array
    {
        return [
            [3, 2,],
            [15, 14],
            [1, 0,],
            [19, 18],
            [10, 9],
            [10, 0],
        ];
    }

    public function notFailingLevelsProvider(): array
    {
        return [
            [1, 1,],
            [3, 8],
            [7, 7,],
            [7, 8],
            [10, 20],
            [0, 3],
            [0, 0],
        ];
    }
}
