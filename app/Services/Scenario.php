<?php

namespace App\Services;

use App\Models\Equipment;

final class Scenario
{
    public function __construct(
        private readonly Equipment $baseEquipment,
        private readonly Equipment $targetEquipment,
    ) {
    }

    public function getBaseLevel(): int
    {
        return $this->baseEquipment->getLevel();
    }

    public function getTargetLevel(): int
    {
        return $this->targetEquipment->getLevel();
    }

    public function getPurchaseCost(): int
    {
        return $this->baseEquipment->getPurchasePrice();
    }

    public function getSalePrice(): int
    {
        return $this->targetEquipment->getSalePrice();
    }
}
