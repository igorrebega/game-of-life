<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Tests\Domain;

use IgorRebega\GameOfLife\Domain\Field;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalidValidationCases(array $rawField): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Field($rawField);
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testValidValidationCases(array $rawField): void
    {
        $field = new Field($rawField);

        $this->assertSame($rawField, $field->getRawField());
    }

    public function invalidDataProvider(): array
    {
        return [
            [[]],
            [
                [
                    [1, 1],
                    [1],
                ]
            ],
            [
                [
                    [1],
                    [1, 1],
                ]
            ],
            [
                [
                    ['f', 1],
                    [1, 1],
                ]
            ]
        ];
    }

    public function validDataProvider(): array
    {
        return [

            [
                [
                    [1, 1],
                    [1, 1],
                ]
            ],
            [
                [
                    [1],
                ]
            ],
        ];
    }

}
