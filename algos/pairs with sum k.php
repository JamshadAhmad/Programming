<?php

//Number of pairs which will sum to k

function getPairCount($arr, $k) { // O(n^2) solution
    $pairs = 0;
    $s = count($arr);

    for ($i = 0; $i<$s - 1; $i++) {
        for ($j = $i + 1; $j<$s; $j++) {
            if ($i !== $j && $arr[$i] + $arr[$j] === $k) {
                $pairs++;
            }
        }
    }
    return $pairs;
}

function pairCount($arr, $k) { // O(n) solution. Also work on negative numbers
    $pairs = 0;
    $counts = []; //to store count of each number

    foreach ($arr as $v) {
        if (array_key_exists($v, $counts)) {
            $counts[$v]++;
        } else {
            $counts[$v] = 1;
        }
    }

    foreach ($counts as $key => $val) {
        if (array_key_exists($k - $key, $counts)) { // lets say 2 is the p1 and k = 8, then 8 - 2 should be in array
            $pairs += $counts[$key] * $counts[$k - $key];
        }
    }
    return $pairs / 2; //because every pair will be counted twice
}


$input = [1, 5, 7, -1, 5];

echo getPairCount($input, 6) . PHP_EOL;
echo pairCount($input, 6) . PHP_EOL;