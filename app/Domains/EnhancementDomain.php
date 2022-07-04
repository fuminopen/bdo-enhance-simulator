<?php

namespace App\Domains;

use App\ValueObjects\Equipment;
use App\ValueObjects\FailStack;
use App\ValueObjects\SuccessfulRateMapper;

final class EnhancementDomain
{
    /**
     * @var Equipment|null
     */
    private ?Equipment $equipment;

    /**
     * @var FailStack
     */
    private FailStack $failStack;

    /**
     * @param  void
     * @return void
     */
    public function __construct()
    {
        $this->equipment = null;
        $this->failStack = new FailStack();
    }

    /**
     * setFailStack
     *
     * @param  int $stackCount
     * @return void
     */
    public function setFailStack(int $stackCount): void
    {
        $this->failStack = new FailStack($stackCount);
    }

    /**
     * currentStack
     *
     * @return int
     */
    public function currentStack(): int
    {
        return $this->failStack->stack;
    }

    /**
     * removeFailStack
     *
     * @return void
     */
    public function unsetFailStack(): void
    {
        $this->failStack = new FailStack();
    }

    /**
     * setEquipment
     *
     * @param  Equipment
     * @return void
     */
    public function setEquipment(Equipment $equipment): void
    {
        $this->equipment = $equipment;
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
     * @return void
     */
    public function unsetEquipment(): void
    {
        $this->equipment = null;
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
            $this->equipment = $this->equipment->enhancementSucceed();
            return true;
        }

        $this->equipment = $this->equipment->enhancementFailed();
        return false;
    }
}
