<?php
//https://www.geeksforgeeks.org/find-index-maximum-occurring-element-equal-probability/

function getIndex($arr) { //O(n) , space O(m) [m = number of occurrences of max number]

    $max = $arr[0];
    $maxIndexes = [0];

    $s = count($arr);

    for ($i = 1; $i < $s; $i++) {
        if ($arr[$i] > $max) {
            $max = $arr[$i];
            $maxIndexes = [$i];
        } elseif ($arr[$i] === $max) {
            $maxIndexes[] = $i;
        }
    }

    echo 'Element with maximum frequency present at index ' . $maxIndexes[rand(0, count($maxIndexes) - 1)] . PHP_EOL;
}

$arr = [-1, 4, 9, 7, 7, 2, 7, 3, 0, 9, 6, 5, 7, 8, 9];

getIndex($arr);