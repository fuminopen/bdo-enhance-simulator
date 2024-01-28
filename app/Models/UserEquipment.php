<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class UserEquipment extends Model
{
    use HasFactory;

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class)
            ->where('level', $this->current_level);
    }

    public function getPurchasePrice(): int
    {
        return $this->equipment->getPurchasePrice();
    }

    public function getSalePrice(): int
    {
        return $this->equipment->getSalePrice();
    }
}
