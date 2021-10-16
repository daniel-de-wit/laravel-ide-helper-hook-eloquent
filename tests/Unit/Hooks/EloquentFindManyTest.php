<?php

declare(strict_types=1);

namespace DanielDeWit\LaravelIdeHelperHookEloquent\Tests\Unit\Hooks;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use DanielDeWit\LaravelIdeHelperHookEloquent\Hooks\EloquentFindManyHook;
use DanielDeWit\LaravelIdeHelperHookEloquent\Hooks\EloquentFindOrNewHook;
use DanielDeWit\LaravelIdeHelperHookEloquent\Tests\stubs\ExampleModel;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class EloquentFindManyTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_writes_the_find_many_method(): void
    {
        /** @var ExampleModel|MockInterface $model */
        $model = Mockery::mock(ExampleModel::class);

        /** @var ModelsCommand|MockInterface $command */
        $command = Mockery::mock(ModelsCommand::class)
            ->shouldReceive('setMethod')
            ->with(
                'findMany',
                '\\' . Collection::class . '|' . (new \ReflectionClass($model))->getShortName(),
                [
                    '$id',
                ],
            )
            ->getMock();

        (new EloquentFindManyHook())->run($command, $model);
    }
}
