<?php

declare(strict_types=1);

namespace DanielDeWit\LaravelIdeHelperHookEloquent\Hooks;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentFindHook implements ModelHookInterface
{
    public function run(ModelsCommand $command, Model $model): void
    {
        $command->setMethod(
            'find',
            '\\' . get_class($model) . '|null',
            [
                '$id',
            ],
        );
    }
}
