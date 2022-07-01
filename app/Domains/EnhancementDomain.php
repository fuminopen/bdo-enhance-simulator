<?php

namespace App\Domains;

use App\ValueObjects\Equipment;
use App\ValueObjects\FailStack;

final class EnhancementDomain
{
    /**
     * @var Equipment
     */
    private readonly Equipment $equipment;

    /**
     * @var FailStack
     */
    private FailStack $failStack;

    /**
     * @param  Equipment $equipment
     * @return void
     */
    public function __construct(Equipment $equipment)
    {
        $this->equipment = $equipment;
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
    public function removeFailStack(): void
    {
        $this->failStack = new FailStack();
    }
}
