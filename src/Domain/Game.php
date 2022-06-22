<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Domain;

class Game
{
    private NeighborsCounter $neighborsCounter;
    private int $iterationsCount;

    public function __construct(NeighborsCounter $neighborsCounter, int $iterationsCount)
    {
        $this->neighborsCounter = $neighborsCounter;
        $this->iterationsCount = $iterationsCount;
    }

    /**
     * @param Field $field
     * @return Field[]
     */
    public function play(Field $field): array
    {
        $iterations = [];
        $iterations[] = $field;

        foreach (range(1, $this->iterationsCount) as $iteration) {
            $previousIteration = $iterations[$iteration - 1];
            $currentIteration = clone $previousIteration;
            foreach ($previousIteration->getRawField() as $y => $baseLine) {
                foreach ($baseLine as $x => $cell) {
                    $position = new Position($x, $y);
                    $aliveNeighborsCount = $this->neighborsCounter->countAlive($previousIteration, $position);

                    $this->applyGameRules($currentIteration, $position, $aliveNeighborsCount);
                }
            }

            $iterations[$iteration] = $currentIteration;
        }

        return $iterations;
    }

    private function applyGameRules(Field $field, Position $position, int $aliveNeighborsCount): void
    {
        if ($aliveNeighborsCount === 3) {
            $field->markCellAsAlive($position);
            return;
        }

        if ($aliveNeighborsCount < 2 || $aliveNeighborsCount > 3) {
            $field->markCellAsDead($position);
        }
    }
}