<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\User;

final class BookingService
{
    public function __construct(private readonly SlackService $slackService)
    {
    }

    /**
     * 指定されたプランを予約する
     */
    public function book(Plan $plan, User $user): bool
    {
        // プランが在庫切れであれば
        // 当該プランと予約しようとしたユーザーの情報を
        // Slackに通知する
        if ($plan->outOfStock()) {
            $this->slackService->notify([
                'planId' => $plan->id,
                'userId' => $user->id,
            ]);

            return false;
        }

        return $plan->book($user);
    }
}
