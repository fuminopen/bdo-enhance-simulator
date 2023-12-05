<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

final class SlackService
{
    public function notify(array $data): bool
    {
        $response = Http::withHeaders([
            'Content-type' => 'application/json',
            'Authorization' => 'Bearer xxxxxxxxxxxxxxxx',
        ])
            ->post(
                // config('const.slack.url'),
                'http://localhost/api/health',
                $data
            );

        return $response->successful();
    }
}
