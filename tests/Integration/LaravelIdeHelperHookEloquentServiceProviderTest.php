<?php

declare(strict_types=1);

namespace DanielDeWit\LaravelIdeHelperHookEloquent\Tests\Integration;

use DanielDeWit\LaravelIdeHelperHookEloquent\Hooks\EloquentFindHook;
use DanielDeWit\LaravelIdeHelperHookEloquent\Providers\LaravelIdeHelperHookEloquentServiceProvider;
use Orchestra\Testbench\TestCase;
class LaravelIdeHelperHookEloquentServiceProviderTest extends TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelIdeHelperHookEloquentServiceProvider::class,
        ];
    }

    /**
     * @test
     */
    public function it_adds_the_translatable_hook_to_the_config(): void
    {
        static::assertContains(EloquentFindHook::class, config('ide-helper.model_hooks'));
    }
}
