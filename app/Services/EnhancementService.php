<?php

namespace App\Services;

use App\Models\EnhancementResource;
use App\Models\Equipment;
use App\ValueObjects\FailStack;

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
        $result = $this->equipment->enhance($this->failStack);

        $result
            ? $this->failStack = new FailStack()
            : $this->failStack->add($this->equipment->stackAddedForFailure());

        $this->enhancementResource = null;

        return $result;
    }
}
