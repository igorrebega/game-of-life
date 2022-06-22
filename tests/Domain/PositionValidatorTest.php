<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Tests\Domain;

use IgorRebega\GameOfLife\Domain\Field;
use IgorRebega\GameOfLife\Domain\Position;
use IgorRebega\GameOfLife\Domain\PositionValidator;
use PHPUnit\Framework\TestCase;

class PositionValidatorTest extends TestCase
{
    private PositionValidator $sut;

    public function setUp(): void
    {
        parent::setUp();

        $field = new Field([
            [0, 0],
            [0, 0],
        ]);

        $this->sut = new PositionValidator($field);
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalidPositions(int $x, int $y): void
    {
        $isValid = $this->sut->isValid(new Position($x, $y));

        $this->assertFalse($isValid);
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testValidPositions(int $x, int $y): void
    {
        $isValid = $this->sut->isValid(new Position($x, $y));

        $this->assertTrue($isValid);
    }

    public function invalidDataProvider(): array
    {
        return [
            [2, 3],
            [-1, 0],
            [0, -1],
            [4, 4],
        ];
    }

    public function validDataProvider(): array
    {
        return [
            [0, 0],
            [0, 1],
            [1, 0],
            [1, 1],
        ];
    }
}
