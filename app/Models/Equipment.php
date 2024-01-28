<?php

namespace App\Models;

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
}
