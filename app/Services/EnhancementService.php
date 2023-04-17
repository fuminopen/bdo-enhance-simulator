<?php

namespace App\Services;

use App\ValueObjects\Enhanceable;
use App\ValueObjects\FailStack;
use App\ValueObjects\SuccessfulRateMapper;

final class EnhancementService
{
    /**
     * // TODO mutable
     *
     * @var Enhanceable|null
     */
    private ?Enhanceable $equipment;

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
     * @param  Enhanceable
     * @return self
     */
    public function setEquipment(Enhanceable $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    /**
     * currentEquipment
     *
     * @return Enhanceable|null
     */
    public function currentEquipment(): ?Enhanceable
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

        $successfulRateMapper = new SuccessfulRateMapper($this->equipment, $this->failStack);

        $rate = $successfulRateMapper->getRate();

        if ($rate >= $rand) {
            $this->equipment = $this->equipment->enhancementSucceed($this->equipment);
            return true;
        }

        $this->equipment = $this->equipment->enhancementFailed();
        return false;
    }
}
