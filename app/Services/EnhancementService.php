<?php

namespace App\Services;

use App\Models\EnhancementResource;
use App\Models\Equipment;
use App\ValueObjects\FailStack;
use App\ValueObjects\Rate;

final class EnhancementService
{
    private ?Equipment $equipment;

    private FailStack $failStack;

    private ?EnhancementResource $enhancementResource;

    public function __construct()
    {
        $this->failStack = new FailStack();
    }

    public function setFailStack(FailStack $stack): self
    {
        $this->failStack = $stack;

        return $this;
    }

    public function currentStack(): FailStack
    {
        return $this->failStack;
    }

    public function unsetFailStack(): self
    {
        $this->failStack = new FailStack();

        return $this;
    }

    public function setEquipment(Equipment $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function currentEquipment(): ?Equipment
    {
        return $this->equipment;
    }

    public function unsetEquipment(): self
    {
        $this->equipment = null;

        return $this;
    }

    public function setEnhancementResource(EnhancementResource $resource): self
    {
        $this->enhancementResource = $resource;

        return $this;
    }

    public function currentEnhancementResource(): EnhancementResource
    {
        return $this->enhancementResource;
    }

    public function unsetEnhancementResource(): self
    {
        $this->enhancementResource = null;

        return $this;
    }

    public function readyToEnhance(): bool
    {
        return !is_null($this->equipment);
    }

    public function enhance(): bool
    {
        $random = Rate::generateRandomRate();

        $successfulRate = $this->equipment->getSuccessfulRatePattern();

        if ($successfulRate->getRate($this->failStack)->lte($random)) {
            $this->equipment = $this->equipment->enhancementSucceed($this->equipment);
            $this->failStack = new FailStack();
            return true;
        }

        $this->equipment = $this->equipment->enhancementFailed();

        // TODO: add fail stack

        return false;
    }
}
