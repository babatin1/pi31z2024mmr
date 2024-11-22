<?php

require_once('IFigure.php');

class Bishop extends Figure {
    protected array $icon = ["\u{265D}", "\u{2657}"];

    public function canMove(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool {
        $diff_row = abs($to_row - $from_row);