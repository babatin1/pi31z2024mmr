<?php

require_once('IFigure.php');

class King extends Figure {
    protected array $icon = ["\u{265A}", "\u{2654}"];
    
     public function canMove(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool {
        $diff_row = abs($to_row - $from_row);
        $diff_col = abs($to_col - $from_col);
        if ($diff_col > 1 || $diff_row > 1)
            return false;
        return true;
    }
}