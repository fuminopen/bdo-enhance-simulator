<?php

namespace Tests\Unit;

use App\Domains\EnhancementLevel;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * TODO
 * 1. enhancement level must be in a certain range
 * 2. enhancement level class can output its level
 * 3. enhancement level class knows if its at minimum or maximum level
 * 4. enhancement level class have methods returns itself with property one level higher or lower
 */
class EnhancementLevelTest extends TestCase
{
    /**
     * TODO : 1
     *
     * @return void
     */
    public function test_enhancement_level_cannot_be_lower_than_its_minimum_limit()
    {
        $this->expectException(InvalidArgumentException::class);

        new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL - 1);
    }

    /**
     * TODO : 1
     *
     * @return void
     */
    public function test_can_be_instantiated_with_minimum_level()
    {
        new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL);

        $this->assertTrue(true);
    }

    /**
     * TODO : 1
     *
     * @return void
     */
    public function test_enhancement_level_cannot_be_higher_than_its_maximum_limit()
    {
        $this->expectException(InvalidArgumentException::class);

        new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL + 1);
    }

    /**
     * TODO : 1
     *
     * @return void
     */
    public function test_can_be_instantiated_with_maximum_level()
    {
        new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL);

        $this->assertTrue(true);
    }

    /**
     * TODO : 2
     *
     * @return void
     */
    public function test_enhancement_level_class_can_output_its_level()
    {
        $minimumLevel = new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL);

        $this->assertSame(EnhancementLevel::MINIMUM_LEVEL, $minimumLevel->getLevel());

        $maximumLevel = new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL);

        $this->assertSame(EnhancementLevel::MAXIMUM_LEVEL, $maximumLevel->getLevel());
    }

    /**
     * TODO : 3
     *
     * @return void
     */
    public function test_it_knows_if_itself_is_at_maximum_level()
    {
        $maximumLevel = new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL);

        $this->assertTrue($maximumLevel->atMaximumLevel());

        $notMaximumLevel = new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL - 1);

        $this->assertFalse($notMaximumLevel->atMaximumLevel());
    }

    /**
     * TODO : 3
     *
     * @return void
     */
    public function test_it_knows_if_itself_is_at_minimum_level()
    {
        $minimumLevel = new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL);

        $this->assertTrue($minimumLevel->atMinimumLevel());

        $notMinimumLevel = new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL + 1);

        $this->assertFalse($notMinimumLevel->atMinimumLevel());
    }

    /**
     * TODO : 4
     *
     * @return void
     */
    public function test_higher_level_instance_returned()
    {
        $minimumLevel = new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL);

        $newLevel = $minimumLevel->levelUp();

        $this->assertSame(EnhancementLevel::MINIMUM_LEVEL + 1, $newLevel->getLevel());
    }

    /**
     * TODO : 4
     *
     * @return void
     */
    public function test_maximum_level_no_longer_level_ups()
    {
        $maximumLevel = new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL);

        $newLevel = $maximumLevel->levelUp();

        $this->assertSame(EnhancementLevel::MAXIMUM_LEVEL, $newLevel->getLevel());
    }

    /**
     * TODO : 4
     *
     * @return void
     */
    public function test_lower_level_instance_returned()
    {
        $maximumLevel = new EnhancementLevel(EnhancementLevel::MAXIMUM_LEVEL);

        $newLevel = $maximumLevel->levelDown();

        $this->assertSame(EnhancementLevel::MAXIMUM_LEVEL - 1, $newLevel->getLevel());
    }

    /**
     * TODO : 4
     *
     * @return void
     */
    public function test_minimum_level_no_longer_level_downs()
    {
        $minimumLevel = new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL);

        $newLevel = $minimumLevel->levelUp();

        $this->assertSame(EnhancementLevel::MINIMUM_LEVEL, $newLevel->getLevel());
    }
}
