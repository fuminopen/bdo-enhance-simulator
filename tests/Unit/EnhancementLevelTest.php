<?php

namespace Tests\Unit;

use App\Exceptions\InvalidInitialLevelException;
use App\ValueObjects\EnhancementLevel;
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
        $this->expectException(InvalidInitialLevelException::class);

        new EnhancementLevel(-1);
    }

    /**
     * TODO : 1
     *
     * @return void
     */
    public function test_can_be_instantiated_with_minimum_level()
    {
        new EnhancementLevel(0);

        $this->assertTrue(true);
    }

    /**
     * TODO : 1
     *
     * @return void
     */
    public function test_enhancement_level_cannot_be_higher_than_its_maximum_limit()
    {
        $this->expectException(InvalidInitialLevelException::class);

        new EnhancementLevel(21);
    }

    /**
     * TODO : 1
     */
    public function test_can_be_instantiated_with_maximum_level()
    {
        new EnhancementLevel(20);

        $this->assertTrue(true);
    }

    /**
     * TODO : 2
     */
    public function test_enhancement_level_class_can_output_its_level()
    {
        $minimumLevel = new EnhancementLevel(0);

        $this->assertSame(0, $minimumLevel->getValue());

        $maximumLevel = new EnhancementLevel(20);

        $this->assertSame(20, $maximumLevel->getValue());
    }

    /**
     * TODO : 3
     */
    public function test_it_knows_if_itself_is_at_maximum_level()
    {
        $maximumLevel = new EnhancementLevel(20);

        $this->assertTrue($maximumLevel->atMaximumLevel());

        $notMaximumLevel = new EnhancementLevel(19);

        $this->assertFalse($notMaximumLevel->atMaximumLevel());
    }

    /**
     * TODO : 3
     */
    public function test_it_knows_if_itself_is_at_minimum_level()
    {
        $minimumLevel = new EnhancementLevel(0);

        $this->assertTrue($minimumLevel->atMinimumLevel());

        $notMinimumLevel = new EnhancementLevel(1);

        $this->assertFalse($notMinimumLevel->atMinimumLevel());
    }

    /**
     * TODO : 4
     */
    public function test_higher_level_instance_returned()
    {
        $minimumLevel = new EnhancementLevel(0);

        $newLevel = $minimumLevel->levelUp();

        $this->assertSame(1, $newLevel->getValue());
    }

    /**
     * TODO : 4
     */
    public function test_maximum_level_no_longer_level_ups()
    {
        $maximumLevel = new EnhancementLevel(20);

        $newLevel = $maximumLevel->levelUp();

        $this->assertSame(20, $newLevel->getValue());
    }

    /**
     * TODO : 4
     */
    public function test_lower_level_instance_returned()
    {
        $maximumLevel = new EnhancementLevel(20);

        $newLevel = $maximumLevel->levelDown();

        $this->assertSame(19, $newLevel->getValue());
    }

    /**
     * TODO : 4
     */
    public function test_minimum_level_no_longer_level_downs()
    {
        $minimumLevel = new EnhancementLevel(0);

        $newLevel = $minimumLevel->levelDown();

        $this->assertSame(0, $newLevel->getValue());
    }

    public function test_minimum_level_instance_can_be_created()
    {
        $this->assertTrue(
            EnhancementLevel::createMinimumLevel()->atMinimumLevel()
        );
    }
}
