<?php

namespace Tests\Unit;

use App\Domains\EnhancementLevel;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EnhancementLevelTest extends TestCase
{
    /**
     * test_initial_enhancement_level_must_be_0_to_20
     *
     * @return void
     */
    public function test_initial_enhancement_level_cannot_be_negative()
    {
        $this->expectException(InvalidArgumentException::class);

        new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL - 1);
    }

    /**
     * test_initial_enhancement_level_must_be_0_to_20
     *
     * @return void
     */
    public function test_minimum_initial_enhancement_level_is_0()
    {
        $level = new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL);

        $this->assertTrue(true);
    }

    /**
     * test_maximum_initial_enhancement_level_must_be_20
     *
     * @return void
     */
    public function test_initial_enhancement_level_cannot_be_more_than_20()
    {
        $this->expectException(InvalidArgumentException::class);

        new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL + 1);
    }

    /**
     * test_initial_enhancement_level_must_be_0_to_20
     *
     * @return void
     */
    public function test_maximum_initial_enhancement_level_is_20()
    {
        $level = new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL);

        $this->assertTrue(true);
    }

    /**
     * test_enhancement_level_class_can_output_its_level
     *
     * @return void
     */
    public function test_enhancement_level_class_can_output_its_level()
    {
        $level = new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL);

        $this->assertSame(EnhancementLevel::MAXIMUM_LEVEL, $level->getLevel());
    }

    /**
     * test_enhancement_level_class_knows_if_itself_is_at_maximum_level
     *
     * @return void
     */
    public function test_enhancement_level_class_knows_if_itself_is_at_maximum_level()
    {
        $level = new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL);

        $this->assertTrue($level->atMaximumLevel());
    }

    /**
     * test_enhancement_level_class_knows_if_itself_is_at_minimum_level
     *
     * @return void
     */
    public function test_enhancement_level_class_knows_if_itself_is_at_minimum_level()
    {
        $level = new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL);

        $this->assertTrue($level->atMinimumLevel());
    }
}
