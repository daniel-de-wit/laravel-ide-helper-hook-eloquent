<?php

declare(strict_types=1);

namespace DanielDeWit\LaravelIdeHelperHookEloquent\Hooks;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EloquentFindManyHook implements ModelHookInterface
{
    public function run(ModelsCommand $command, Model $model): void
    {
        $command->setMethod(
            'findMany',
            '\\' . Collection::class . '|' . (new \ReflectionClass($model))->getShortName(),
            [
                '$id',
            ],
        );
    }
}
