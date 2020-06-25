<?php

/**
 * Returns max sum that we can have from following most fruitful path.
 * It handles negative numbers as well and input can be rectangular as well
 *
 * Time complexity O(rows * cols)
 * Space complexity O(rows * cols)
 *
 * @param array $mat A 2D rectangular matrix (array of array)
 * @return int
 */
function getMax($mat) {
    //Assuming it will be a valid matrix with atleast 1 element
    $rows = count($mat);
    $cols = count($mat[0]);

    //this is to store running sum. dp is usually written by developers as short for dynamic programming
    $dp = [];
    $dp[0][0] = $mat[0][0];

    //setting up first row
    for ($i = 1 ; $i < $cols; $i++) {
        $dp[0][$i] = $dp[0][$i-1] + $mat[0][$i];
    }

    //setting up first column
    for ($i = 1 ; $i < $rows; $i++) {
        $dp[$i][0] = $dp[$i-1][0] + $mat[$i][0];
    }

    for ($i = 1; $i < $rows; $i++) {
        for ($j = 1; $j < $cols; $j++) {
            $dp[$i][$j] = $mat[$i][$j] + max($dp[$i-1][$j], $dp[$i][$j-1]);
        }
    }
    return $dp[$rows-1][$cols-1];
}

//testing
$matrix = [
    [2, 4, 8],
    [9, 5, 1],
    [4, 6, 7] //Answer should be 29, why? 2 -> 9 -> 5 -> 6 -> 7
];

echo getMax($matrix) . PHP_EOL;