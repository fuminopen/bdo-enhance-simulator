<?php

namespace App\Domains;

use App\ValueObjects\Equipment;
use App\ValueObjects\FailStack;

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
}
