<?php
//Question asked in Clement's google coding interview
//https://www.youtube.com/watch?v=EuPSibuIKIg&t=141s

/**
 * Returns count of rectangles which are formed by 1 at each corner
 * @param array $arr
 * @return int
 */
function rectCount($arr) { //O(n^2) where n is the number of elements in the grid. Space O(1)
    $rows = count($arr);
    $cols = count($arr[0]);

    $tc = 0; //total count
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $tc += getCount($arr, $rows, $cols, $i, $j);
        }
    }
    return $tc;
}

/**
 * Returns count of rectangles involving arr[i][j] at bottom right end
 */
function getCount($arr, $r, $c, $i, $j) {
    if ($i < 1 || $j < 1 || $i === $r || $j === $c || $arr[$i][$j] === 0) {
        return 0;
    }
    $count = 0;

    for ($x = 1; $x <= $i; $x++) {
        for ($y = 1; $y <= $j; $y++) {
            if ($arr[$i][$j - $y] === 1 && $arr[$i - $x][$j] === 1 && $arr[$i - $x][$j - $y] === 1) {
                $count++;
            }
        }
    }
    return $count;
}

$arr = [ //output should be 2
    [0, 0, 1, 1],
    [1, 1, 1, 1],
    [1, 0, 1, 0]
];

echo rectCount($arr) . PHP_EOL;