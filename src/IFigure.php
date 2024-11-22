<?php
require_once('color.php');
require_once('Board.php');

interface IFigure {
    public function __construct(Color $color);
    public function getColor(): Color;
    public function getIcon(): string;
    public function canMove(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool;
    public function canAttack(int $from_row, int $from_col, int $to_row, int $to_col, Board $board): bool;
}

abstract class Figure implements IFigure {