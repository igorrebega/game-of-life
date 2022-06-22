<?php

declare(strict_types=1);

namespace IgorRebega\GameOfLife\Infrastructure;

use IgorRebega\GameOfLife\Domain\Field;

class FieldPresenter
{
    public function present(Field $field): void
    {
        $grid = $field->getRawField();
        foreach ($grid as $rows) {
            echo "|";
            foreach ($rows as $cell) {
                echo ($cell ? "+" : " ") . "|";
            }
            echo PHP_EOL;
        }
    }
}
