<?php

namespace App\ValueObjects;

final class Equipment implements Enhanceable
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
     * // TODO
     *
     * @param
     * @return
     */
    public function getCurrentLevel(): EnhancementLevel
    {
        return new EnhancementLevel();
    }

    /**
     * // TODO
     *
     * @param
     * @return
     */
    public function getThreshold(): EnhancementLevel
    {
        return new EnhancementLevel();
    }

    /**
     * enhance
     *
     * @return Equipment
     */
    public function enhancementSucceed(): Enhanceable
    {
        if ($this->getCurrentLevel()->atMaximumLevel()) {
            return $this;
        }

        $newLevel = new EnhancementLevel($this->getCurrentLevel()->level + 1);

        $class = get_class($this);

        return new $class($newLevel);
    }

    /**
     * enhanceFailed
     *
     * @return Equipment
     */
    public function enhancementFailed(): Enhanceable
    {
        if ($this->getCurrentLevel()->level <= $this->getThreshold()->level) {
            return $this;
        }

        $newLevel = new EnhancementLevel($this->getCurrentLevel()->levelDown()->level);

        $class = get_class($this);

        return new $class($newLevel);
    }
}
