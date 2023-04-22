<?php

namespace App\Services;

use App\ValueObjects\Equipment;
use App\ValueObjects\FailStack;
use App\ValueObjects\SuccessfulRateMapper;
use App\ValueObjects\SuccessfulRatePattern;

final class EnhancementService
{
    /**
     * // TODO mutable
     *
     * @var Equipment|null
     */
    private ?Equipment $equipment;

    /**
     * // TODO mutable
     *
     * @var FailStack
     */
    private FailStack $failStack;

    /**
     * Enhancement always starts with no equipment and fail stack count at 0
     */
    public function __construct()
    {
        $this->equipment = null;
        $this->failStack = new FailStack();
    }

    /**
     * setFailStack
     *
     * @param  FailStack $stackCount
     * @return self
     */
    public function setFailStack(FailStack $stack): self
    {
        $this->failStack = $stack;

        return $this;
    }

    /**
     * currentStack
     *
     * @return FailStack
     */
    public function getCurrentStack(): FailStack
    {
        return $this->failStack;
    }

    /**
     * removeFailStack
     *
     * @return self
     */
    public function unsetFailStack(): self
    {
        $this->failStack = new FailStack();

        return $this;
    }

    /**
     * setEquipment
     *
     * @param  Equipment
     * @return self
     */
    public function setEquipment(Equipment $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    /**
     * currentEquipment
     *
     * @return Equipment|null
     */
    public function currentEquipment(): ?Equipment
    {
        return $this->equipment;
    }

    /**
     * unsetEquipment
     *
     * @return self
     */
    public function unsetEquipment(): self
    {
        $this->equipment = null;

        return $this;
    }

    /**
     * readyToEnhance
     *
     * @return bool
     */
    public function readyToEnhance(): bool
    {
        return !is_null($this->equipment);
    }

    /**
     * enhance
     *
     * @return bool
     */
    public function enhance(): bool
    {
        $rand = random_int(1, 10000) / 10000;

        $successfulRate = $this->equipment->getSuccessfulRatePattern();

        if ($successfulRate->getRate($this->failStack) >= $rand) {
            $this->equipment = $this->equipment->enhancementSucceed($this->equipment);
            return true;
        }

        $this->equipment = $this->equipment->enhancementFailed();
        return false;
    }
}
