<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Domain;

use InvalidArgumentException;

class Field
{
    /**
     * @param int[][] $rawField
     */
    public function __construct(private array $rawField)
    {
        $this->validateField();
    }

    public function getCell(Position $position): int
    {
        $this->validatePosition($position);

        return $this->rawField[$position->y][$position->x];
    }

    public function markCellAsAlive(Position $position): void
    {
        $this->validatePosition($position);

        $this->rawField[$position->y][$position->x] = 1;
    }

    public function markCellAsDead(Position $position): void
    {
        $this->validatePosition($position);

        $this->rawField[$position->y][$position->x] = 0;
    }

    public function getHeight(): int
    {
        return count($this->rawField);
    }

    public function getWeight(): int
    {
        $firstLine = $this->rawField[0] ?? [];

        return count($firstLine);
    }

    public function getRawField(): array
    {
        return $this->rawField;
    }

    private function validateField(): void
    {
        if ($this->getHeight() < 1) {
            throw new InvalidArgumentException('Height of field should be at least 1');
        }

        if ($this->getWeight() < 1) {
            throw new InvalidArgumentException('Weight of field should be at least 1');
        }

        $rowLength = count($this->rawField[0]);
        foreach ($this->rawField as $rows) {
            if (count($rows) !== $rowLength) {
                throw new InvalidArgumentException('All rows should have the same number of elements');
            }

            foreach ($rows as $cell) {
                if ($cell !== 0 && $cell !== 1) {
                    throw new InvalidArgumentException('Value should be 0 or 1');
                }
            }
        }
    }

    private function validatePosition(Position $position): void
    {
        if (! isset($this->rawField[$position->y][$position->x])) {
            throw new InvalidArgumentException('No cell on this position');
        }
    }
}
