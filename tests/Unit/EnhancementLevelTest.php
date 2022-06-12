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
    public function test_minimum_initial_enhancement_level_must_be_0()
    {
        $this->expectException(InvalidArgumentException::class);

        new EnhancementLevel(-1);
    }

    /**
     * test_maximum_initial_enhancement_level_must_be_20
     *
     * @return void
     */
    public function test_maximum_initial_enhancement_level_must_be_20()
    {
        $this->expectException(InvalidArgumentException::class);

        new EnhancementLevel(21);
    }

    /**
     * test_enhancement_level_class_can_output_its_level
     *
     * @return void
     */
    public function test_enhancement_level_class_can_output_its_level()
    {
        $level = new EnhancementLevel(20);

        $this->assertSame(20, $level->getLevel());
    }
}
