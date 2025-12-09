<?php

declare(strict_types=1);

namespace Finq\Ihamkor\Tests;

use Finq\Ihamkor\Facades\Ihamkor;
use Finq\Ihamkor\IhamkorService;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class IhamkorServiceTest extends TestCase
{
    public function test_service_can_be_resolved(): void
    {
        $service = app(IhamkorService::class);

        $this->assertInstanceOf(IhamkorService::class, $service);
    }

    public function test_facade_can_be_resolved(): void
    {
        Http::fake();

        $this->assertInstanceOf(IhamkorService::class, Ihamkor::getFacadeRoot());
    }

    public function test_service_is_singleton(): void
    {
        $service1 = app(IhamkorService::class);
        $service2 = app(IhamkorService::class);

        $this->assertSame($service1, $service2);
    }

    public function test_get_client_returns_pending_request(): void
    {
        $service = app(IhamkorService::class);

        $this->assertInstanceOf(PendingRequest::class, $service->getClient());
    }

    public function test_taxi_income_sends_correct_request(): void
    {
        Http::fake([
            '*' => Http::response(['success' => true], 200),
        ]);

        $response = Ihamkor::taxiIncome('12345678901234', 'job-123');

        $this->assertTrue($response->successful());

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'gnk/data/marketplace-taxi')
                && $request['pinfl'] === '12345678901234'
                && $request['signature'] === 'job-123';
        });
    }

    public function test_register_sends_correct_request(): void
    {
        Http::fake([
            '*' => Http::response(['success' => true], 200),
        ]);

        $response = Ihamkor::registerMyId('12345678901234', 'job-123');

        $this->assertTrue($response->successful());

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'api/v1/myid/verification/register')
                && $request['pinfl'] === '12345678901234'
                && $request['job_id'] === 'job-123';
        });
    }

    public function test_config_values_are_loaded(): void
    {
        $this->assertEquals('https://api.i-hamkor.uz/', config('ihamkor.url'));
        $this->assertEquals('test-client-id', config('ihamkor.client_id'));
        $this->assertEquals('test-username', config('ihamkor.username'));
        $this->assertEquals('test-password', config('ihamkor.password'));
    }
}
