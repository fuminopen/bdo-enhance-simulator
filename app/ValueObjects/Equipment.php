<?php

namespace App\ValueObjects;

final class Equipment
{
    /**
     * @var EnhancementLevel
     */
    private readonly EnhancementLevel $currentLevel;

    /**
     * @var EnhancementLevel
     */
    private readonly EnhancementLevel $threshold;

    /**
     * __construct
     *
     * @param  EnhancementLevel $currentLevel
     */
    public function __construct(
        EnhancementLevel $level,
        EnhancementLevel $threshold
    ) {
        $this->currentLevel = $level;
    }

    /**
     * @return EnhancementLevel
     */
    public function getCurrentLevel(): EnhancementLevel
    {
        return $this->currentLevel;
    }

    /**
     * @return EnhancementLevel
     */
    public function getThreshold(): EnhancementLevel
    {
        return $this->threshold;
    }

    /**
     * enhance
     *
     * @return self
     */
    public function enhancementSucceed(): self
    {
        if ($this->getCurrentLevel()->atMaximumLevel()) {
            throw new NoLongerEnhanceableException();
        }

        return new self(
            $this->currentLevel->levelUp(),
            $this->threshold
        );
    }

    /**
     * enhanceFailed
     *
     * @return Equipment
     */
    public function enhancementFailed(): Enhanceable
    {
        if (
            $this->getCurrentLevel()->level <= $this->getThreshold()->level) {
            return $this;
        }

        $newLevel = new EnhancementLevel($this->getCurrentLevel()->levelDown()->level);

        $class = get_class($this);

        return new $class($newLevel);
    }
}
