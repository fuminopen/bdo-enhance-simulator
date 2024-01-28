<?php

namespace App\Models;

use App\Exceptions\NoLongerEnhanceableException;
use App\ValueObjects\EnhancementLevel;
use App\ValueObjects\SuccessfulRatePattern;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    use HasFactory;

    /**************************
     *
     * relations
     *
     **************************/

    public function equipmentType(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class);
    }

    public function enhancementResourceCombinations(): BelongsTo
    {
        return $this->belongsTo(EnhancementResourceCombination::class);
    }

    /**************************
     *
     * methods
     *
     **************************/

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
        return new EnhancementLevel($this->current_level);
    }

    public function getThreshold(): EnhancementLevel
    {
        return $this->equipmentType->getThreshold();
    }

    public function getSuccessfulRatePattern(): SuccessfulRatePattern
    {
        return $this->equipmentType->getSuccessfulRatePattern();
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
            [
                'level' => $this->getCurrentLevel()->levelDown()->getValue(),
            ]
        );
    }

    /**************************************************************
    *
    * private methods
    *
    **************************************************************/

    private function enhanceable(): bool
    {
        return ! $this->getCurrentLevel()->atMaximumLevel() && !is_null($this->enhancementResourceCombination);
    }
}
