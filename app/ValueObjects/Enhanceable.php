<?php

namespace App\ValueObjects;

interface Enhanceable
{
    /**
     * @return EnhancementLevel
     */
    public function getCurrentLevel(): EnhancementLevel;

    /**
     * @return EnhancementLevel
     */
    public function getThreshold(): EnhancementLevel;

    /**
     * @return Enhanceable
     */
    public function enhancementSucceed(): Enhanceable;

    /**
     * @return Enhanceable
     */
    public function enhancementFailed(): Enhanceable;
}
