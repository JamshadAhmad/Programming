<?php

//Hard pair problem
//https://www.hackerrank.com/challenges/array-pairs/problem

/**
 * Returns count of number of pairs where i < j and a[i] * a[j] < max (a[i] ... a[j])
 * @param array $arr
 * @return int
 */
function countPairs($arr) { //O(n^2)
    $s = count($arr);
    $counter = 0;
    for ($i = 0; $i < $s - 1; $i++) {
        $max = $arr[$i];
        for ($j = $i + 1; $j < $s; $j++) {
            if ($arr[$j] > $max) {
                $max = $arr[$j];
            }
            if ($arr[$i] * $arr[$j] <= $max) {
                $counter++;
            }
        }
    }
    return $counter;
}

$arr = [1, 3, 2, 5, 6, 4, 3, 4, 2, 5]; //should be 12

echo countPairs($arr) . PHP_EOL;
