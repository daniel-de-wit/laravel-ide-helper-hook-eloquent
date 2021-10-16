<?php

declare(strict_types=1);

namespace DanielDeWit\LaravelIdeHelperHookEloquent\Hooks;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use Barryvdh\LaravelIdeHelper\Contracts\ModelHookInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentFindOrFailHook implements ModelHookInterface
{
    public function run(ModelsCommand $command, Model $model): void
    {
        $command->setMethod(
            'findOrFail',
            '\\' . get_class($model),
            [
                '$id',
            ],
        );
    }
}
