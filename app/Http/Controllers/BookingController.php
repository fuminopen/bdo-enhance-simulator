<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;

final class BookingController extends Controller
{
    public function __construct(private readonly BookingService $bookingService)
    {
    }

    public function book()
    {
        $plan = new Plan([
            'id' => 1,
        ]);
        $plan->id = 1;
        $user = new User([
            'id' => 1,
        ]);
        $user->id = 1;

        $result = $this->bookingService->book($plan, $user);

        return response(
            '',
            $result ? 200 : 400
        );
    }
}
