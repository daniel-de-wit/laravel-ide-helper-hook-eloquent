<?php

declare(strict_types=1);

namespace DanielDeWit\LaravelIdeHelperHookEloquent\Tests\Unit\Hooks;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand;
use DanielDeWit\LaravelIdeHelperHookEloquent\Hooks\EloquentFindHook;
use DanielDeWit\LaravelIdeHelperHookEloquent\Tests\stubs\ExampleModel;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class EloquentFindHookTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function it_writes_the_find_method(): void
    {
        /** @var ExampleModel|MockInterface $model */
        $model = Mockery::mock(ExampleModel::class);

        /** @var ModelsCommand|MockInterface $command */
        $command = Mockery::mock(ModelsCommand::class)
            ->shouldReceive('setMethod')
            ->with(
                'find',
                '\\' . get_class($model) . '|null',
                [
                    '$id',
                ],
            )
            ->getMock();

        (new EloquentFindHook())->run($command, $model);
    }
}
