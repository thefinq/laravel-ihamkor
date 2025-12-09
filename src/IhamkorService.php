<?php

declare(strict_types=1);

namespace Finq\Ihamkor;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class IhamkorService
{
    protected PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(config('ihamkor.url'))
            ->withBasicAuth(
                config('ihamkor.username'),
                config('ihamkor.password')
            )
            ->withQueryParameters([
                'client_id' => config('ihamkor.client_id'),
            ])
            ->timeout(config('ihamkor.timeout', 30))
            ->retry(
                config('ihamkor.retry.times', 3),
                config('ihamkor.retry.sleep', 100)
            );
    }

    /**
     * Get taxi income data from GNK marketplace.
     */
    public function taxiIncome(string $pinfl, string $signature): PromiseInterface|Response
    {
        return $this->send('gnk/data/marketplace-taxi', [
            'pinfl' => $pinfl,
            'signature' => $signature,
            'lang' => 'uz',
        ]);
    }

    /**
     * Send a POST request to the API.
     */
    protected function send(string $path, array $data): PromiseInterface|Response
    {
        return $this->client->post($path, $data);
    }

    /**
     * Register user verification via MyID.
     */
    public function registerMyId(string $pinfl, string $job_id): PromiseInterface|Response
    {
        return $this->send('api/v1/myid/verification/register', [
            'pinfl' => $pinfl,
            'job_id' => $job_id,
        ]);
    }

    /**
     * Get person info by PINFL.
     */
    public function getPersonInfo(string $pinfl, string $signature): PromiseInterface|Response
    {

        return $this->send('gnk/data/fiznp1', [
            'pinfl' => $pinfl,
            'signature' => $signature,
            "lang" => "uz"
        ]);
    }

    /**
     * Get the underlying HTTP client.
     */
    public function getClient(): PendingRequest
    {
        return $this->client;
    }

    /**
     * Send a GET request to the API.
     */
    protected function get(string $path, array $query = []): PromiseInterface|Response
    {
        return $this->client->get($path, $query);
    }
}
