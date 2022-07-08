<?php

namespace App\ValueObjects;

interface Enhanceable
{
    public function getCurrentLevel(): EnhancementLevel;

    public function getThreshold(): EnhancementLevel;
}
