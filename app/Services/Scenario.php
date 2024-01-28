<?php

namespace App\Services;

class Scenario
{
    public $baseLevel;
    public $targetLevel;
    public $purchaseCost;
    public $salePrice;

    public function __construct($baseLevel, $targetLevel, $purchaseCost, $salePrice) {
        $this->baseLevel = $baseLevel;
        $this->targetLevel = $targetLevel;
        $this->purchaseCost = $purchaseCost;
        $this->salePrice = $salePrice;
    }
}
