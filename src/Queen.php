<?php

require_once('IFigure.php');

class Queen extends Figure {
    protected array $icon = ["\u{265B}", "\u{2655}"];

    public function canMove(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool {
        $diff_row = abs($to_row - $from_row);
        $diff_col = abs($to_col - $from_col);
        $is_horizontal = $diff_row == 0;
        $is_vertical = $diff_col == 0;
        $is_diagonal = $diff_row == $diff_col;
        if (!$is_diagonal && !$is_vertical && !$is_horizontal)
            return false;
        $step_col = $diff_col == 0
            ? 0
            : ($to_col - $from_col) / $diff_col;
        $step_row = $diff_row == 0
            ? 0
            : ($to_row - $from_row) / $diff_row;
        $start_col = $from_col;
        $start_row = $from_row;
        while ($start_col != $to_col || $start_row != $to_row) {
            // echo 'C: ' . $start_col . ' - ' . $to_col . PHP_EOL;
            // echo 'R: ' . $start_row . ' - ' . $to_row . PHP_EOL;
            // echo 'Steps: C:' . $step_col . ' R: ' . $step_row . PHP_EOL;
            $item = $board->getItem($start_row, $start_col);
            if ($item && $item !== $this) {
                return false;
            }
            // if ($start_col > 8 || $start_col < 0)
            //     return false;
            // if ($start_row > 8 || $start_row < 0)
            //     return false;
            $start_col += $step_col;
            $start_row += $step_row;
        }
        return true;
    }
}