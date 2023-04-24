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
     * @var SuccessfulRatePattern
     */
    private readonly SuccessfulRatePattern $successfulRatePattern;

    /**
     * __construct
     *
     * @param  EnhancementLevel $currentLevel
     * @param  EnhancementLevel $threshold
     */
    public function __construct(
        EnhancementLevel $level,
        EnhancementLevel $threshold,
        SuccessfulRatePattern $successfulRatePattern
    ) {
        $this->currentLevel = $level;
        $this->threshold = $threshold;
        $this->successfulRatePattern = $successfulRatePattern;
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
     * @return SuccessfulRatePattern
     *
     * @author Fumitada Noshita <fumitada-noshita@se-ec.co.jp>
     */
    public function getSuccessfulRatePattern(): SuccessfulRatePattern
    {
        return $this->successfulRatePattern;
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
            $this->threshold,
            $this->successfulRatePattern
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
            $this->threshold,
            $this->successfulRatePattern
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
