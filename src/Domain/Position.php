<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Domain;

class Position
{
    public function __construct(public readonly int $x, public readonly int $y)
    {
    }
}
