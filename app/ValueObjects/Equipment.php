<?php

namespace App\ValueObjects;

final class Equipment
{
    /**
     * @var EnhancementLevel
     */
    public readonly EnhancementLevel $currentLevel;

    /**
     * __construct
     *
     * @param  EnhancementLevel $currentLevel
     * @return void
     */
    public function __construct(
        EnhancementLevel $level =
            new EnhancementLevel(EnhancementLevel::MINIMUM_LEVEL)
    ) {
        $this->currentLevel = $level;
    }

    /**
     * enhance
     *
     * @return Equipment
     */
    public function enhancementSucceed(Enhancable $enhancable): Enhancable
    {
        if ($enhancable->getCurrentLevel()->atMaximumLevel()) {
            return $this;
        }

        $newLevel = new EnhancementLevel($enhancable->getCurrentLevel()->level + 1);

        $class = get_class($enhancable);

        return new $class($newLevel);
    }

    /**
     * enhanceFailed
     *
     * @return Equipment
     */
    public function enhancementFailed(Enhancable $enhancable): Enhancable
    {
        if ($enhancable->getCurrentLevel()->level <= $enhancable->getThreshold()->level) {
            return $this;
        }

        $newLevel = new EnhancementLevel($enhancable->getCurrentLevel()->levelDown()->level);

        $class = get_class($enhancable);

        return new $class($newLevel);
    }
}
