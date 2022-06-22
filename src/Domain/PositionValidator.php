<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Domain;

class PositionValidator
{
    public function __construct(private readonly Field $field)
    {
    }

    public function isValid(Position $position): bool
    {
        if ($position->x < 0) {
            return false;
        }

        if ($position->y < 0) {
            return false;
        }

        if ($position->y > $this->getMaxY()) {
            return false;
        }

        if ($position->x > $this->getMaxX()) {
            return false;
        }

        return true;
    }

    private function getMaxY(): int
    {
        return $this->field->getHeight() - 1;
    }

    private function getMaxX(): int
    {
        return $this->field->getWeight() - 1;
    }
}