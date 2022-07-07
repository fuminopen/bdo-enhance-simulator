<?php

namespace App\ValueObjects;

interface Enhancable
{
    public function getCurrentLevel(): EnhancementLevel;

    public function getThreshold(): EnhancementLevel;
}
