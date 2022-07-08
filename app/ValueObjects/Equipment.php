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
    public function enhancementSucceed(Enhanceable $enhanceable): Enhanceable
    {
        if ($enhanceable->getCurrentLevel()->atMaximumLevel()) {
            return $enhanceable;
        }

        $newLevel = new EnhancementLevel($enhanceable->getCurrentLevel()->level + 1);

        $class = get_class($enhanceable);

        return new $class($newLevel);
    }

    /**
     * enhanceFailed
     *
     * @return Equipment
     */
    public function enhancementFailed(Enhanceable $enhanceable): Enhanceable
    {
        if ($enhanceable->getCurrentLevel()->level <= $enhanceable->getThreshold()->level) {
            return $enhanceable;
        }

        $newLevel = new EnhancementLevel($enhanceable->getCurrentLevel()->levelDown()->level);

        $class = get_class($enhanceable);

        return new $class($newLevel);
    }
}
