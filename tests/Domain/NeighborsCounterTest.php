<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Tests\Domain;

use IgorRebega\GameOfLife\Domain\Field;
use IgorRebega\GameOfLife\Domain\NeighborsCounter;
use IgorRebega\GameOfLife\Domain\Position;
use PHPUnit\Framework\TestCase;

class NeighborsCounterTest extends TestCase
{
    private NeighborsCounter $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = new NeighborsCounter();
    }

    /**
     * @dataProvider countDataProvider
     */
    public function testCountAlive(Field $field, int $x, int $y, int $expectedCount): void
    {
        $position = new Position($x, $y);

        $count = $this->sut->countAlive($field, $position);

        $this->assertSame($expectedCount, $count);
    }

    /**
     * @return array[] [base, x, y, expectedCount]
     */
    public function countDataProvider(): array
    {
        $field = new Field([
            [0, 1, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [1, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
        ]);

        return [
            [$field, 2, 3, 2],
            [$field, 0, 0, 1],
            [$field, 0, 0, 1],
            [$field, 1, 1, 5],
        ];
    }
}
