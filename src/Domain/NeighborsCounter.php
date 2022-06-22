<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Domain;

class NeighborsCounter
{
    public function countAlive(Field $field, Position $position): int
    {
        $positionValidator = new PositionValidator($field);

        $neighborsPositions = [
            new Position($position->x - 1, $position->y - 1),
            new Position($position->x, $position->y - 1),
            new Position($position->x + 1, $position->y - 1),
            new Position($position->x - 1, $position->y),
            new Position($position->x + 1, $position->y),
            new Position($position->x - 1, $position->y + 1),
            new Position($position->x, $position->y + 1),
            new Position($position->x + 1, $position->y + 1),
        ];

        $neighborsPositions = array_filter(
            $neighborsPositions,
            static fn(Position $neighborsPosition) => $positionValidator->isValid($neighborsPosition)
        );

        $count = 0;

        foreach ($neighborsPositions as $neighborsPosition) {
            if ($field->getCell($neighborsPosition) === 1) {
                $count++;
            }
        }

        return $count;
    }
}
