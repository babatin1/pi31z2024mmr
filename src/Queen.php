<?php

require_once('IFigure.php');

class Queen extends Figure {
    protected array $icon = ["\u{265B}", "\u{2655}"];


    public function canMove(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool {
        // Ферзь может ходить как по горизонтали/вертикали, так и по диагонали
        $row_diff = abs($to_row - $from_row);
        $col_diff = abs($to_col - $from_col);

        // Движение по горизонтали или вертикали
        if (($from_col == $to_col && $from_row != $to_row) ||
            ($from_row == $to_row && $from_col != $to_col)) {
            return $this->checkStraightPath($from_row, $from_col, $to_row, $to_col, $board);
        }

        // Движение по диагонали
        if ($row_diff == $col_diff) {
            return $this->checkDiagonalPath($from_row, $from_col, $to_row, $to_col, $board);
        }

        return false;
    }

    /**
     * Проверяет путь по горизонтальной или вертикальной линии
     */
    protected function checkStraightPath(
        int $from_row,
        int $from_col,
        int $to_row,
        int $to_col,
        Board $board
    ): bool {
        if ($from_col == $to_col) {
            $step_col = 0;
            $step_row = $from_row > $to_row ? -1 : 1;
        } else {
            $step_row = 0;
            $step_col = $from_col > $to_col ? -1 : 1;
        }

        $start_col = $from_col;
        $start_row = $from_row;

        while ($start_col != $to_col || $start_row != $to_row) {
            $item = $board->getItem($start_row, $start_col);
            if ($item && $item !== $this) {
                return false;
            }
            $start_col += $step_col;
            $start_row += $step_row;
        }

        return true;
    }

    /**
     * Проверяет путь по диагонали
     */
    protected function checkDiagonalPath(
        int $from_row,
        int $from_col,
        int $to_row,
        int $to_col,
        Board $board
    ): bool {
        $step_row = $from_row > $to_row ? -1 : 1;
        $step_col = $from_col > $to_col ? -1 : 1;

        $start_col = $from_col + $step_col;
        $start_row = $from_row + $step_row;

        while ($start_col != $to_col || $start_row != $to_row) {
            $item = $board->getItem($start_row, $start_col);
            if ($item && $item !== $this) {
                return false;
            }
            $start_col += $step_col;
            $start_row += $step_row;
        }

        return true;
    }
}