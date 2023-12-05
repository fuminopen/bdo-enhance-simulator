<?php

namespace App\Models;

final class Plan
{
    public int $id = 1;

    public function outOfStock(): bool
    {
        return true;
    }

    public function book(User $user): bool
    {
        return true;
    }
}
