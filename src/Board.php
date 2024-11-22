<?php
require_once('color.php');
require_once('IFigure.php');
require_once('Pawn.php');
require_once('Rook.php');
require_once('Knight.php');
require_once('Bishop.php');
require_once('King.php');
require_once('Queen.php');

class Board {
    private Color $player = Color::White;

    private array $board = [];

    public function __construct() {
        for ($i = 0; $i < 8; $i += 1) {
            $this->board[] = [];
            for ($j = 0; $j < 8; $j += 1) {
                $this->board[$i][] = null;
            }
        }
        foreach ([6, 1] as $row) {
            for ($col = 0; $col < 8; $col += 1) {
                try {
                    $this->setItem(
                        $row,
                        $col,
                        new Pawn(
                            $row === 1 ? Color::White : Color::Black
                        )
                    );
                } catch(Exception $e){
                    print_r([$row, $col]);
                }
            }
        }
        foreach ([7, 0] as $row) {
            foreach ([0, 7] as $col) {
                $this->setItem(
                    $row,
                    $col,
                    new Rook(
                        $row === 0 ? Color::White : Color::Black
                    )
                );
            }
            foreach ([1, 6] as $col) {
                $this->setItem(
                    $row,
                    $col,
                    new Knight(
                        $row === 0 ? Color::White : Color::Black
                    )
                );
            }
            foreach ([2, 5] as $col) {
                $this->setItem(
                    $row,
                    $col,
                    new Bishop(
                        $row === 0 ? Color::White : Color::Black
                    )
                );
            }
            if ($row == 7) {
                $this->setItem($row, 3, new Queen(Color::Black));
                $this->setItem($row, 4, new King(Color::Black));
            } else {
                $this->setItem($row, 4, new Queen(Color::White));
                $this->setItem($row, 3, new King(Color::White));
            }
        }
        $this->setItem(3, 2, $this->getItem(7, 0));
        $this->setItem(7, 0, null);
        $this->setItem(2, 4, $this->getItem(6, 4));
        $this->setItem(6, 4, null);
    }

    public function getItem(int $row, int $col): IFigure | null {
        if (!$this->isCorrectCoordinate($row, $col)) {
            return null;
        }
        return $this->board[$row][$col];
    }

    private function isCorrectCoordinate(int $row, int $col): bool {
        return $row < 8 && $row >= 0 && $col < 8 && $col >= 0;
    }

    private function setItem(int $row, int $col, IFigure | null $item) : void {
        if ($this->isCorrectCoordinate($row, $col)) {
            $this->board[$row][$col] = $item;
        }
    }

    public function printBoard(): void {
        $line = implode('', [
            '   ',
            '+',
            str_repeat('---+', 8),
        ]) . PHP_EOL;
        echo $line;
        for ($i = 7; $i >= 0; $i -= 1) {
            echo $i + 1;
            echo '  |';
            for ($j = 0; $j < 8; $j += 1) {
                echo ' ';
                $item = $this->getItem($i, $j);
                if ($item) {
                    echo $item->getIcon();
                } else {
                    echo ' ';
                }
                echo ' |';
            }
            echo PHP_EOL;
            echo $line;
        }
        echo '   ';
        for ($i = 0; $i < 8; $i += 1) {
            echo '  ';