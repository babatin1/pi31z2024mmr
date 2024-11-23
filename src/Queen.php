<?php

require_once('IFigure.php');

class Queen extends Figure {
    protected array $icon = ["\u{265B}", "\u{2655}"];

    public function canMove(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool {
        // Ферзь может ходить как по горизонтали/вертикали, так и по диагонали
        $row_diff = abs($to_row - $from_row);
        $col_diff = abs($to_col - $from_col);


        return false; // Неправильный ход
    }
}