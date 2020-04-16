<?php

/**
 * @param String[][] $grid
 * @return Integer
 */
function numIslands($grid) { //O(m*n) where m = rows and n = cols
    $rows = count($grid);
    $cols = count($grid[0]);
    $counter = 0;

    for ($i = 0 ; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            if ($grid[$i][$j]) {
                removeAdjacent1s($grid, $rows, $cols, $i, $j);
                $counter++;
            }
        }
    }
    return $counter;
}

/**
 * Removes adjacent 1s recursively
 * @param $grid
 * @param $rows
 * @param $cols
 * @param $i
 * @param $j
 */
function removeAdjacent1s(&$grid, $rows, $cols, $i, $j) { //important point is to pass grid by reference
    //other wise have to return $grid and do $grid = removeAdja... each time it is called
    $grid[$i][$j] = 0;

    if ($i - 1 >= 0 && $grid[$i-1][$j] ) {
        removeAdjacent1s($grid, $rows, $cols, $i-1, $j);
    }
    if ($i + 1 < $rows && $grid[$i+1][$j] ) {
        removeAdjacent1s($grid, $rows, $cols, $i+1, $j);
    }
    if ($j - 1 >= 0 && $grid[$i][$j-1] ) {
        removeAdjacent1s($grid, $rows, $cols, $i, $j-1);
    }
    if ($j + 1 < $cols && $grid[$i][$j+1] ) {
        removeAdjacent1s($grid, $rows, $cols, $i, $j+1);
    }
}

$matrix1 = [
    [1, 1, 1, 0, 0],
    [0, 1, 0, 0, 0],
    [0, 1, 1, 0, 0],
    [0, 0, 0, 0, 0]
];

echo numIslands($matrix1) . PHP_EOL;
