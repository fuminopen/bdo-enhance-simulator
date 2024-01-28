<?php

namespace App\Models;

use App\Exceptions\NoLongerEnhanceableException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    public function getPurchasePrice(): int
    {
        return $this->purchase_price;
    }

    public function getSalePrice(): int
    {
        return $this->sale_price;
    }

    public function getCurrentLevel(): EnhancementLevel
    {
        return $this->current_level;
    }

    public function getThreshold(): EnhancementLevel
    {
        return $this->threshold;
    }

    public function getSuccessfulRatePattern(): SuccessfulRatePattern
    {
        return $this->successfulRatePattern;
    }

    public function enhancementSucceed(): self
    {
        if (! $this->enhanceable()) {
            throw new NoLongerEnhanceableException();
        }

        return new self(
            $this->currentLevel->levelUp(),
            $this->threshold,
            $this->successfulRatePattern
        );
    }

    public function enhancementFailed(): self
    {
        if (! $this->enhanceable()) {
            throw new NoLongerEnhanceableException();
        }

        if ($this->getCurrentLevel()->getValue() <= $this->getThreshold()->getValue()) {
            return $this;
        }

        return new self(
            $this->getCurrentLevel()->levelDown(),
            $this->threshold,
            $this->successfulRatePattern
        );
    }

    /**************************************************************
    *
    * private methods
    *
    **************************************************************/

    private function enhanceable(): bool
    {
        return ! $this->getCurrentLevel()->atMaximumLevel();
    }
}
