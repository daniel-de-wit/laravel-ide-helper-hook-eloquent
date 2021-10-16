<?php

namespace DanielDeWit\LaravelIdeHelperHookEloquent\Providers;

use DanielDeWit\LaravelIdeHelperHookEloquent\Hooks\EloquentFindHook;
use DanielDeWit\LaravelIdeHelperHookEloquent\Hooks\EloquentFindOrFailHook;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\ServiceProvider;

class LaravelIdeHelperHookEloquentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if ($this->app->isProduction()) {
            return;
        }

        /** @var Config $config */
        $config = $this->app->get('config');

        $config->set('ide-helper.model_hooks', array_merge([
            EloquentFindHook::class,
            EloquentFindOrFailHook::class,
        ], $config->get('ide-helper.model_hooks', [])));
    }
}
