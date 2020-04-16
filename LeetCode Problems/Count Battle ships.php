<?php

//https://leetcode.com/problems/battleships-in-a-board/

/**
 * @param String[][] $board
 * @return Integer
 */
function countBattleships($board) {
    $rows = count($board);
    $cols = count($board[0]);

    $counter = 0;

    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            if ($board[$i][$j] == 'X') {
                $counter++;
                removeShip($board, $rows, $cols, $i, $j);
            }
        }
    }
    return $counter;
}

function removeShip(&$board, $rows, $cols, $i, $j) {
    $board[$i][$j] = '.';

    if ($i + 1 < $rows && $board[$i+1][$j] == 'X') {
        removeShip($board, $rows, $cols, $i + 1, $j);
    } elseif ($j + 1 < $cols && $board[$i][$j+1] == 'X') {
        removeShip($board, $rows, $cols, $i, $j + 1);
    }
}





//Now the most optimized solution which does not change original $board
/**
 * @param String[][] $board
 * @return Integer
 */
function countBattleshipsOptimized($board) {
    $rows = count($board);
    $cols = count($board[0]);

    $counter = 0;

    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            if ($board[$i][$j] == 'X') {
                $shouldThisCounted = true;

                if ($i > 0 && $board[$i-1][$j] == 'X') {
                    //as it has appeared before
                    $shouldThisCounted = false;
                }

                if ($j > 0 && $board[$i][$j-1] == 'X') {
                    $shouldThisCounted = false;
                }

                if ($shouldThisCounted) {
                    $counter++;
                }
            }
        }
    }
    return $counter;
}

$board = [
    ["X", ".", ".", "X"],
    [".", ".", ".", "X"],
    [".", ".", ".", "X"]
];

echo countBattleships($board) . PHP_EOL;
echo countBattleshipsOptimized($board) . PHP_EOL;
