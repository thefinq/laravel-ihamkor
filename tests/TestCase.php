<?php

declare(strict_types=1);

namespace Finq\Ihamkor\Tests;

use Finq\Ihamkor\IhamkorServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            IhamkorServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Ihamkor' => \Finq\Ihamkor\Facades\Ihamkor::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('ihamkor.url', 'https://api.i-hamkor.uz/');
        $app['config']->set('ihamkor.client_id', 'test-client-id');
        $app['config']->set('ihamkor.username', 'test-username');
        $app['config']->set('ihamkor.password', 'test-password');
        $app['config']->set('ihamkor.timeout', 30);
        $app['config']->set('ihamkor.retry.times', 3);
        $app['config']->set('ihamkor.retry.sleep', 100);
    }
}
