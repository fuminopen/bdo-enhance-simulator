<?php

namespace App\ValueObjects;

use App\Exceptions\NoLongerEnhanceableException;

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
     * @param  EnhancementLevel $threshold
     */
    public function __construct(
        EnhancementLevel $level,
        EnhancementLevel $threshold
    ) {
        $this->currentLevel = $level;
        $this->threshold = $threshold;
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
        if (! $this->enhanceable()) {
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
     * @return self
     */
    public function enhancementFailed(): self
    {
        if (! $this->enhanceable()) {
            throw new NoLongerEnhanceableException();
        }

        if ($this->getCurrentLevel()->getValue() <= $this->getThreshold()->getValue()) {
            return $this;
        }

        return new self(
            $this->getCurrentLevel()->levelDown(),
            $this->threshold
        );
    }

    /**************************************************************
    *
    * private methods
    *
    **************************************************************/

    private function enhanceable(): bool
    {
        return ! $this->getCurrentLevel()->atMaximumLevel();
    }
}
