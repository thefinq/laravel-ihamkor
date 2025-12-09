<?php

declare(strict_types=1);

namespace Finq\Ihamkor\Facades;

use Finq\Ihamkor\IhamkorService;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PromiseInterface|Response taxiIncome(string $pinfl, string $signature)
 * @method static PromiseInterface|Response registerMyId(string $pinfl, string $job_id)
 * @method static PromiseInterface|Response getPersonInfo(string $pinfl, string $signature)
 * @method static PendingRequest getClient()
 *
 * @see \Finq\Ihamkor\IhamkorService
 */
class Ihamkor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return IhamkorService::class;
    }
}
