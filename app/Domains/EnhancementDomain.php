<?php

namespace App\Domains;

use App\ValueObjects\Enhanceable;
use App\ValueObjects\Equipment;
use App\ValueObjects\FailStack;
use App\ValueObjects\SuccessfulRateMapper;

final class EnhancementDomain
{
    /**
     * @var Enhanceable|null
     */
    private ?Enhanceable $enhanceable;

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
     * @param  Enhanceable
     * @return void
     */
    public function setEquipment(Enhanceable $enhanceable): void
    {
        $this->enhanceable = $enhanceable;
    }

    /**
     * currentEquipment
     *
     * @return Enhanceable|null
     */
    public function currentEquipment(): ?Enhanceable
    {
        return $this->enhanceable;
    }

    /**
     * unsetEquipment
     *
     * @return void
     */
    public function unsetEquipment(): void
    {
        $this->enhanceable = null;
    }

    /**
     * readyToEnhance
     *
     * @return bool
     */
    public function readyToEnhance(): bool
    {
        return !is_null($this->enhanceable);
    }

    /**
     * enhance
     *
     * @return bool
     */
    public function enhance(): bool
    {
        $rand = random_int(1, 10000) / 10000;

        $successfulRateMapper = new SuccessfulRateMapper($this->enhanceable, $this->failStack);

        $rate = $successfulRateMapper->getRate();

        if ($rate >= $rand) {
            $this->enhanceable = $this->enhanceable->enhancementSucceed($this->enhanceable);
            return true;
        }

        $this->enhanceable = $this->enhanceable->enhancementFailed();
        return false;
    }
}
