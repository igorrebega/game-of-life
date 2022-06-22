<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Tests\Domain;

use IgorRebega\GameOfLife\Domain\Field;
use IgorRebega\GameOfLife\Domain\Game;
use IgorRebega\GameOfLife\Domain\NeighborsCounter;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    private const ITERATIONS = 15;
    private Game $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = new Game(new NeighborsCounter(), self::ITERATIONS);
    }

    /**
     * @dataProvider gamesDataProvider
     */
    public function testPlayWithSlicer(array $field, array $expectedField): void
    {
        $iterations = $this->sut->play(new Field($field));

        $lastIterationField = $iterations[self::ITERATIONS]->getRawField();

        $this->assertSame($expectedField, $lastIterationField);
    }

    /**
     * @return array[] [field, expectedField]
     */
    public function gamesDataProvider(): array
    {
        return [
            'glacier' => [
                [
                    [0, 1, 0, 0, 0],
                    [0, 0, 1, 0, 0],
                    [1, 1, 1, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                ],
                [
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 1, 1],
                    [0, 0, 0, 1, 1],
                ]
            ],
            'glacier in smaller env' => [
                [
                    [0, 1, 0, 0, 0],
                    [0, 0, 1, 0, 0],
                    [1, 1, 1, 0, 0],
                ],
                [
                    [0, 0, 0, 0, 0],
                    [0, 1, 1, 0, 0],
                    [0, 1, 1, 0, 0],
                ]
            ],
            'row' => [
                [
                    [1, 1, 1, 1, 1],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                ],
                [
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                ]
            ],
            'one will die' => [
                [
                    [1, 0, 0 ,0 , 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                ],
                [
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                ]
            ],
        ];
    }
}
