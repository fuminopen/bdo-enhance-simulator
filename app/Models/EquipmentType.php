<?php

namespace App\Models;

use App\ValueObjects\EnhancementLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;

    public function getThreshold(): EnhancementLevel
    {
        return new EnhancementLevel($this->threshold);
    }
}
