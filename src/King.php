<?php

require_once('IFigure.php');

class King extends Figure {
    protected array $icon = ["\u{265A}", "\u{2654}"];

    public function canMove(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool {
        // Король может ходить максимум на одну клетку в любом направлении
        $row_diff = abs($to_row - $from_row);