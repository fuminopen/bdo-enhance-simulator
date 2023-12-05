<?php

namespace Tests\Feature;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

final class BookingTest extends TestCase
{
/**
 * プランが在庫切れの場合はSlackメッセージが送信されることをテストする
 */
public function testIfSlackMessageIsSentWhenPlanIsOutOfStock(): void
{
    $user = User::factory()->create();
    // プランは在庫切れ
    $plan = Plan::factory()->create([
        'stock' => 0,
    ]);

    $header = [
        'Content-type' => 'application/json',
        'Authorization' => 'Bearer xxxxxxxxxxxxxxxx',
    ];

    $data = [
        'planId' => $plan->id,
        'userId' => $user->id,
    ];

    Http::fake();
    // PendingRequest::post()から返すダミーのレスポンスを作っておく
    $dummyResponse = Http::post('http://localhost/health', []);

    // Http::withHeaderの結果帰ってくるPendingRequestクラスをモック
    $pendingRequest = Mockery::mock(
        PendingRequest::class,
        function (MockInterface $mock) use ($dummyResponse, $data) {
            // post()が必ず一度呼ばれることを検証
            $mock->shouldReceive('post')
                ->once()
                ->with(config('const.slack.url', $data))
                ->andReturn($dummyResponse);
        }
    );

    // post前にwithHeadersを通して、content-typeと認証トークンの設定が行われることを検証
    Http::shouldReceive('withHeaders')
        // 必ず一度呼ばれる
        ->once()
        ->with($header)
        ->andReturn($pendingRequest);

    $response = $this->post(
        '/api/book',
        [
            'user_id' => $user->id,
            'plan_id' => $plan->id,
        ]
    );

    $response->assertBadRequest();
}
}
